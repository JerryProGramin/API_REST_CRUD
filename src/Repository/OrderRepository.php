<?php 

declare(strict_types=1);

namespace Src\Repository;

use PDO;
use Src\Database\Conexion;
use Src\Model\Orders;
use Src\Model\PaymentMethod;
use Src\Model\User;

class OrderRepository 
{
    public function __construct()
    {
    }

    public function getAll(): array
    {
        $conexion = new Conexion();
        $pdo = $conexion->getConexion();

        $query = 'SELECT o.*, u.id, u.email, p.id, p.name_method, p.details
                FROM orders o
                INNER JOIN users u ON o.user_id = u.id
                INNER JOIN payment_method p ON o.payment_method_id = p.id';
        
        $stmt = $pdo->query($query);
        
        $orders = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = new User(
                Id: (int)$fila['id'],
                Email: $fila['email'],
                //Password: ''
            );

            $paymentMethod = new PaymentMethod(
                Id: (int)$fila['id'],
                NameMethod: $fila['name_method'],
                Details: $fila['details']
            );

            $orders[] = [
                'id' => $fila['id'],
                'date_order' => $fila['date_order'],
                'order_total' => $fila['order_total'],
                'user' => $user->jsonSerialize(),
                'payment_method' => $paymentMethod->jsonSerialize()
            ];
        }

        return $orders;
    }
}
