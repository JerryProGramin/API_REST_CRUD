<?php 

declare(strict_types = 1);

namespace Src\Repository;

use PDO;
use Src\Database\Conexion;
use Src\Model\PaymentMethod;

class PaymentMethodsRepository 
{
    private PDO $pdo;
    public function __construct(
    ){
        $conexion = new Conexion();
        $this->pdo = $conexion->getConexion();
    }

    public function getAll(): array
    {
        $pdo = $this->pdo;
        foreach ($pdo->query('SELECT * From payment_methods') as $fila) {
            $PaymentMethods[] = $fila;
        }
        return $PaymentMethods;
    }

    public function getById(int $paymentMethodId): PaymentMethod
    {
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('SELECT * FROM payment_methods WHERE id = :id');
        $stmt->bindParam(':id', $paymentMethodId, PDO::PARAM_INT);
        $stmt->execute();

        $paymentMethod = $stmt->fetchAll();
        return new PaymentMethod(
            id: $paymentMethod[0]['id'],
            name: $paymentMethod[0]['name'],
            details: $paymentMethod[0]['details']
        );
    }

    public function register(string $name, string $details): void 
    {
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('INSERT INTO payment_methods (name, details) VALUES (:name, :details)');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':details', $details, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function update(int $paymentMethodId, string $name, string $details): void 
    {
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('UPDATE payment_methods SET name = :name, details = :details WHERE id = :id');
        $stmt->bindParam(':id', $paymentMethodId, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':details', $details, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function delete(int $paymentMethodId): void 
    {
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('DELETE FROM payment_methods WHERE id = :id');
        $stmt->bindParam(':id', $paymentMethodId, PDO::PARAM_INT);
        $stmt->execute();
    }
}