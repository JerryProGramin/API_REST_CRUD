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

class OrderDetailsRepository
{
    public function __construct()
    {
    }
    
    
    public function getAll(): array
    {
        $conexion = new Conexion();
        $pdo = $conexion->getConexion();

        $query = 'SELECT od.*, o.id as order_id, o.user_id, o.date_order, o.payment_method_id, o.order_total, l.id as laptop_id, l.brand, l.model, l.price
                FROM order_details od
                INNER JOIN orders o ON od.order_id = o.id
                INNER JOIN laptops l ON od.laptop_id = l.id';
        $stmt = $pdo->query($query);
        
        $ordersDetails = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $dateOrder = new DateTime($fila['date_order']);

            $orders = new Orders(
                Id: (int)$fila['order_id'],
                UserId: (int)$fila['user_id'],
                DateOrder: $dateOrder,
                PaymentMethodId: (int)$fila['payment_method_id'],
                OrderTotal: (float)$fila['order_total'],
            );

            $laptops = new Laptop(
                Id: (int)$fila['laptop_id'],
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

    // public function getById(int $OrdersDetailsId): OrdersDetails
    // {
    //     $Conexion = new Conexion();
    //     $pdo = $Conexion->getConexion();

    //     $stmt = $pdo->prepare('SELECT * FROM order_details WHERE id = :id');
    //     $stmt->bindParam(':id', $OrdersDetailsId, PDO::PARAM_INT);
    //     $stmt->execute();

    //     $fila = $stmt->fetch(PDO::FETCH_ASSOC);

    //     if ($fila === false) {
    //         throw new Exception('Order details not found.');
    //     }

    //     if (!isset($fila['date_order']) || empty($fila['date_order'])) {
    //         throw new Exception('Date order is missing or invalid.');
    //     }

    //     $dateOrder = new DateTime($fila['date_order']);

    //     $orders = new Orders(
    //         Id: (int)$fila['order_id'],
    //         UserId: (int)$fila['user_id'],
    //         DateOrder: $dateOrder,
    //         PaymentMethodId: (int)$fila['payment_method_id'],
    //         OrderTotal: (float)$fila['order_total']
    //     );

    //     $laptops = new Laptop(
    //         Id: (int)$fila['laptop_id'],
    //         Brand: $fila['brand'],
    //         Model: $fila['model'],
    //         Price: isset($fila['price']) ? (float)$fila['price'] : 0.0
    //     );

    //     return [
    //         'id' => (int)$fila['id'],
    //         'order_id' => $orders->jsonSerialize(),
    //         'laptop_id' => $laptops->jsonSerialize(),
    //         'price_unit' => isset($fila['price_unit']) ? (float)$fila['price_unit'] : 0.0
    //     ];
    // }

}
