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
use Src\Model\Suppliers;
use Src\Model\User;

class OrderDetailsRepository
{
    public function __construct()
    {
    }
    
    
    public function getAll(): array
    {
        $conexion = new Conexion();
        $pdo = $conexion->getConexion();

        $query = 'SELECT od.*, o.* , l.id, l.brand, l.model, l.price
                FROM order_details od
                INNER JOIN orders o ON od.order_id = o.id
                INNER JOIN laptops l ON od.laptop_id = l.id';
        $stmt = $pdo->query($query);
        
        $ordersDetails = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $dateOrder = new DateTime($fila['date_order']);

            $orders = new Orders(
                Id: (int)$fila['id'],
                UserId: $fila['user_id'],
                DateOrder: $dateOrder,
                PaymentMethodId: $fila['payment_method_id'],
                OrderTotal: (float)$fila['order_total'],
            );

            $laptops = new Laptop(
                Id: (int)$fila['id'],
                Brand: $fila['brand'],
                Model: $fila['model'],
                Price: isset($fila['price']) ? (float)$fila['price'] : 0.0,
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

        // if (!isset($fila['date_order']) || empty($fila['date_order'])) {
        //     throw new Exception('Date order is missing or invalid.');
        // }

        $dateOrder = new DateTime($fila['date_order']);
        $releaseDate = new DateTime($fila['release_date']);

        $user = new User(
            Id: (int)$fila['user_id'],
            Email: $fila['email'],
        );

        $payment = new PaymentMethod(
            Id: (int)$fila['id'],
            NameMethod: $fila['name_method'],
            Details: $fila['details'],
        );

        $orders = new Orders(
            Id: (int)$fila['order_id'],
            UserId: $user,
            DateOrder: $dateOrder,
            PaymentMethodId: $payment,
            OrderTotal: (float)$fila['order_total']
        );

        $supplier = new Suppliers(
            Id: (int)$fila['id'],
            Name: $fila['name'],
            ContactInfo: $fila['contact_info'],
            Phone: $fila['phone'],
            Email: $fila['email'],
        );

        $laptops = new Laptop(
            Id: (int)$fila['laptop_id'],
            Brand: $fila['brand'],
            Model: $fila['model'],
            Price: isset($fila['price']) ? (float)$fila['price'] : 0.0,
            Specifications: $fila['specifications'],
            Description: $fila['description'],
            ReleaseDate: $releaseDate,
            SupplierId: $supplier,
        );

        return [
            'id' => (int)$fila['id'],
            'order_id' => $orders->jsonSerialize(),
            'laptop_id' => $laptops->jsonSerialize(),
            'price_unit' => isset($fila['price_unit']) ? (float)$fila['price_unit'] : 0.0
        ];
    }

}
