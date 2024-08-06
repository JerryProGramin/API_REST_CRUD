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

    }

    public function update(int $userId, string $email, string $password): void
    {

    }

    public function delete(int $userId): void
    {

    }
}