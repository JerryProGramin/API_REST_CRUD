<?php

declare(strict_types=1);

namespace Src\Database;

use PDO;
use PDOException;

class Conexion
{
    private string $host;
    private string $database;
    private string $user;
    private string $password;

    public function __construct()
    {
        $config = require 'config.php';
        $this->host = $config['host'];
        $this->database = $config['database'];
        $this->user = $config['user'];
        $this->password = $config['password'];
    }

    public function getConexion(): PDO
    {
        try {
            $conexion = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->user, $this->password);
            $conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            return $conexion;
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage();
            die();
        }
    }
}