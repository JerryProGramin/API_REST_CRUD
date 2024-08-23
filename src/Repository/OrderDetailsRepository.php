<?php

declare(strict_types = 1);

namespace Src\Repository;

use DateTime;
use PDO;
use Src\Database\Conexion;
use Src\Model\Laptop;
use Src\Model\Orders;
use Src\Model\OrdersDetails;
use Exception;
use Src\Model\PaymentMethod;
use Src\Model\Products;
use Src\Model\Suppliers;
use Src\Model\User;

class OrderDetailsRepository
{
    private PDO $pdo;
    public function __construct()
    {
        $conexion = new Conexion();
        $this->pdo = $conexion->getConexion();
    }
    
    
    public function getAll(): array
    {

        $query = 'SELECT od.*, o.* , p.id, p.brand, p.model, p.price, u.id as user_id, pm.id as payment_method_id, pm.name, pm.details
                FROM order_details od
                INNER JOIN orders o ON od.order_id = o.id
                INNER JOIN products p ON od.laptop_id = p.id
                INNER JOIN users u ON o.user_id = u.id
                INNER JOIN payment_methods pm ON o.payment_method_id = pm.id';

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        
        $ordersDetails = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $dateOrder = new DateTime($fila['date_order']);

            $user = new User(
                id: (int)$fila['user_id'],
            );

            $payment = new PaymentMethod(
                id: (int)$fila['payment_method_id'],
                name: $fila['name_method'],
                details: $fila['details'],
            );

            $orders = new Orders(
                id: (int)$fila['id'],
                userId: $user,
                date: $dateOrder,
                paymentMethodId: $payment,
                total: (float)$fila['order_total'],
            );

            $laptops = new Products(
                id: (int)$fila['id'],
                brand: $fila['brand'],
                model: $fila['model'],
                price: isset($fila['price']) ? (float)$fila['price'] : 0.0,
            );

            $ordersDetails[] = [
                'id' => (int)$fila['id'],
                'order_id' => $orders->jsonSerialize(),
                'laptop_id' => $laptops->jsonSerialize(),
                'price_unit' => (float)$fila['price_unit'],
            ];
        }

        return $ordersDetails;
    }

    public function getById(int $OrdersDetailsId)
    {
        $Conexion = new Conexion();
        $pdo = $Conexion->getConexion();

        $stmt = $pdo->prepare(' SELECT od.*, o.* , l.*, s.*, u.*, pm.*
                            FROM order_details od
                            INNER JOIN orders o ON od.order_id = o.id
                            INNER JOIN laptops l ON od.laptop_id = l.id
                            INNER JOIN users u ON o.user_id = u.id
                            INNER JOIN payment_method pm ON o.payment_method_id = pm.id
                            INNER JOIN suppliers s ON l.supplier_id = s.id
                            WHERE od.id = :id ');
        $stmt->bindParam(':id', $OrdersDetailsId, PDO::PARAM_INT);
        $stmt->execute();

        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila === false) {
            throw new Exception('No se encontraron detalles del pedido.');
        }

        $dateOrder = new DateTime($fila['date']);
        $releaseDate = new DateTime($fila['release_date']);

        $user = new User(
            id: (int)$fila['user_id'],
            email: $fila['email'],
        );

        $payment = new PaymentMethod(
            id: (int)$fila['id'],
            name: $fila['name'],
            details: $fila['details'],
        );

        $orders = new Orders(
            id: (int)$fila['order_id'],
            userId: $user,
            date: $dateOrder,
            paymentMethodId: $payment,
            total: (float)$fila['total']
        );

        $supplier = new Suppliers(
            id: (int)$fila['id'],
            name: $fila['name'],
            contactInfo: $fila['contact_info'],
            phone: $fila['phone'],
            email: $fila['email'],
        );

        $laptops = new Products(
            id: (int)$fila['laptop_id'],
            brand: $fila['brand'],
            model: $fila['model'],
            price: isset($fila['price']) ? (float)$fila['price'] : 0.0,
            specifications: $fila['specifications'],
            description: $fila['description'],
            releaseDate: $releaseDate,
            supplierId: $supplier,
        );

        return [
            'id' => (int)$fila['id'],
            'order_id' => $orders->jsonSerialize(),
            'laptop_id' => $laptops->jsonSerialize(),
            'price_unit' => isset($fila['price_unit']) ? (float)$fila['price_unit'] : 0.0
        ];
    }

}
