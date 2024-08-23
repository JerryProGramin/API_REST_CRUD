<?php

declare(strict_types=1);

namespace Src\Repository;

use PDO;
use Src\Database\Conexion;
use Src\Model\User;

class UserRepository
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
        foreach ($pdo->query('SELECT u.id, u.email from users u') as $fila) {
            $users[] = $fila;
        }

        return $users;
    }

    public function getById(int $userId): User
    {
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetchAll();
        return new User(
            id: $user[0]['id'],
            email: $user[0]['email'],
            password: $user[0]['password']
        );
    }

    public function register(string $email, string $password): void
    {
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function update(int $userId, string $email, string $password): void
    {
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('UPDATE users SET email = :email, password = :password WHERE id = :id');
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function delete(int $userId): void
    {
        $pdo = $this->pdo;
        $stmt = $pdo->prepare('DELETE FROM users WHERE id = :id');
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();
    }
}