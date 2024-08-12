<?php

declare(strict_types=1);

namespace Src\Repository;

use PDO;
use Src\Database\Conexion;
use Src\Model\User;

class UserRepository
{
    public function __construct()
    {
    }

    public function getAll(): array
    {
        $conexion = new Conexion();
        $PDO = $conexion->getConexion();
        foreach ($PDO->query('SELECT * from users') as $fila) {
            $users[] = $fila;
        }

        return $users;
    }

    public function getById(int $userId): User
    {
        $conexion = new Conexion();
        $pdo = $conexion->getConexion();

        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetchAll();
        return new User(
            id: $user[0]['id'],
            email: $user[0]['email'],
            password: $user[0]['password'],
        );
    }

    public function register(string $email, string $password): void
    {
        $Conexion = new Conexion();
        $PDO = $Conexion->getConexion();
        $stmt = $PDO->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function update(int $userId, string $email, string $password): void
    {
        $Conexion = new Conexion();
        $PDO = $Conexion->getConexion();
        $stmt = $PDO->prepare('UPDATE users SET email = :email, password = :password WHERE id = :id');
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function delete(int $userId): void
    {
        $Conexion = new Conexion();
        $PDO = $Conexion->getConexion();
        $stmt = $PDO->prepare('DELETE FROM users WHERE id = :id');
        $stmt->bindParam(':id', $UsersId, PDO::PARAM_INT);
        $stmt->execute();
    }
}