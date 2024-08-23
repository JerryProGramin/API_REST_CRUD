<?php 

declare(strict_types=1);

namespace Src\Repository;

use PDOException;
use PDO;
use Src\Database\Conexion;
use Src\Model\Orders;
use Src\Model\PaymentMethod;
use Src\Model\User;

class OrderRepository 
{
    private PDO $pdo;
    public function __construct()
    {
        $conexion = new Conexion();
        $this->pdo = $conexion->getConexion();
    }

    public function getAll(): array
    {
        $query = 'SELECT DISTINCT o.*, u.id as user_id, u.email, p.id as payment_method_id, p.name
                FROM orders o
                INNER JOIN users u ON o.user_id = u.id
                INNER JOIN payment_methods p ON o.payment_method_id = p.id';
        
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        $orders = [];
        while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $user = new User(
                id: (int)$fila['user_id'],
                email: $fila['email'],
            );

            $paymentMethod = new PaymentMethod(
                id: (int)$fila['payment_method_id'],
                name: $fila['name']
            );

            $orders[] = [
                'id' => $fila['id'],
                'user' => $user->jsonSerialize(),
                'date' => $fila['date'],
                'payment_method' => $paymentMethod->jsonSerialize(),
                'order_total' => $fila['total']
            ];
        }

        return $orders;
    }

    public function getById(int $id): array
    {
        $query = 'SELECT DISTINCT o.*, u.id as user_id, u.email, p.id as payment_method_id, p.name, p.details
                FROM orders o
                INNER JOIN users u ON o.user_id = u.id
                INNER JOIN payment_methods p ON o.payment_method_id = p.id
                WHERE o.id = :id';
                
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $order = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($order === false) {            
            return null;
        }    

        $user = new User(
            id: (int)$order['user_id'],
            email: $order['email'],
        );
        $paymentMethod = new PaymentMethod(
            id: (int)$order['payment_method_id'],
            name: $order['name'],
            details: $order['details']
        );
        return [
            'id' => (int)$order['id'],
            'user' => $user->jsonSerialize(),
            'date' => $order['date'],
            'payment_method' => $paymentMethod->jsonSerialize(),
            'total' => $order['total']
        ];
    } 

    public function register(int $userId, string $date, int $paymentMethodId, float $total){
        $stmt = $this->pdo->prepare('INSERT INTO orders (user_id, date, payment_method_id, total) VALUES (:user_id, :date, :payment_method_id, :total)');
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':payment_method_id', $paymentMethodId, PDO::PARAM_INT);
        $stmt->bindParam(':total', $total, PDO::PARAM_STR);
        $stmt->execute();
        
    }

    public function update(int $orderId, int $userId, string $date, int $paymentMethodId, float $total): void{
        $stmt = $this->pdo->prepare('UPDATE orders SET user_id = :user_id, date = :date, payment_method_id = :payment_method_id, total = :total WHERE id = :id');
        $stmt->bindParam(':id', $orderId, PDO::PARAM_INT);
        $stmt->bindParam(':user_id',$userId, PDO::PARAM_INT);
        $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        $stmt->bindParam(':payment_method_id', $paymentMethodId, PDO::PARAM_INT);
        $stmt->bindParam(':total', $total, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function delete(int $id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM orders WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
