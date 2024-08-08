<?php

declare(strict_types=1);

use Src\Database\Conexion;
use Src\Repository\UserRepository;
use Src\Repository\SuppliersRepository;

require 'vendor/autoload.php';

header('Content-Type: application/json; charset=utf-8');

$repository = new SuppliersRepository();
$suppliers = $repository->getAll();
echo json_encode($suppliers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

// $repository = new SuppliersRepository();
// $suppliers = $repository->getById(2);
// echo json_encode($suppliers->jsonSerialize());

// $repository = new SuppliersRepository();
// $suppliers = $repository->register("Proveedor Asus","Información",984464841,"asus@gmail.com");

// $repository = new SuppliersRepository();
// $suppliers = $repository->update(1,"JerryProveedor","InformaciónJErry",957546546,"jerryproveer@gmail.com");

// $repository = new SuppliersRepository();
// $suppliers = $repository->delete(4);