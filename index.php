<?php

declare(strict_types=1);

use Src\Database\Conexion;

require 'vendor/autoload.php';

header('Content-Type: application/json; charset=utf-8');

$conexion = new Conexion();

// $users = [
//     'id' => '1',
//     'email' => 'test@gmail.com',
//     'password' => '12341234'
// ];

// echo json_encode($users);
echo json_encode($conexion->getConexion());