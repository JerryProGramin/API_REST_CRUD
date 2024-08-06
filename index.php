<?php

declare(strict_types=1);

use Src\Database\Conexion;
use Src\Repository\UserRepository;

require 'vendor/autoload.php';

header('Content-Type: application/json; charset=utf-8');

$repository = new UserRepository();
$user = $repository->getById(2);
echo json_encode($user->jsonSerialize());