<?php 
declare (strict_types = 1);

namespace Src\Repository;

use PDO;
use Src\Database\Conexion;
use Src\Model\Suppliers;

class SuppliersRepository{

    public function __construct(){
    }

    public function getAll(): array
    {
        $Conexion = new Conexion();
        $PDO = $Conexion->getConexion();
        foreach ($PDO->query('SELECT * from suppliers') as $fila) {
            $Suppliers[] = $fila;
        }

        return $Suppliers;
    }

    public function getById(int $SuppliersId): Suppliers
    {
        $Conexion = new Conexion();
        $pdo = $Conexion->getConexion();

        $stmt = $pdo->prepare('SELECT * FROM suppliers WHERE id = :id');
        $stmt->bindParam(':id', $SuppliersId, PDO::PARAM_INT);
        $stmt->execute();

        $Suppliers = $stmt->fetchAll();
        return new Suppliers(
            Id: $Suppliers[0]['id'],
            Name: $Suppliers[0]['name'],
            ContactInfo: $Suppliers[0]['contact_info'],
            Phone: $Suppliers[0]['phone'],
            Email: $Suppliers[0]['email'],
        );
    }

    public function register(string $Names, string $ContactInfo, int $Phone, string $Email): void
    {
        $Conexion = new Conexion();
        $PDO = $Conexion->getConexion();
        $stmt = $PDO->prepare('INSERT INTO suppliers (name, contact_info, phone, email) VALUES (:name, :contact_info, :phone, :email)');
        $stmt->bindParam(':name', $Names, PDO::PARAM_STR);
        $stmt->bindParam(':contact_info', $ContactInfo, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $Phone, PDO::PARAM_INT);
        $stmt->bindParam(':email', $Email, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function update(int $id, string $Names, string $ContactInfo, int $Phone, string $Email): void
    {
        $Conexion = new Conexion();
        $PDO = $Conexion->getConexion();
        $stmt = $PDO->prepare('UPDATE suppliers SET name = :name, contact_info = :contact_info, phone = :phone, email = :email WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $Names, PDO::PARAM_STR);
        $stmt->bindParam(':contact_info', $ContactInfo, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $Phone, PDO::PARAM_INT);
        $stmt->bindParam(':email', $Email, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function delete(int $SuppliersId): void
    {
        $Conexion = new Conexion();
        $PDO = $Conexion->getConexion();
        $stmt = $PDO->prepare('DELETE FROM suppliers WHERE id = :id');
        $stmt->bindParam(':id', $SuppliersId, PDO::PARAM_INT);
        $stmt->execute();
    }

}