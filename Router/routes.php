<?php

use Src\Controller\UserController;
use Src\Model\Suppliers;
use Src\Repository\SuppliersRepository;
use Src\Controller\SuppliersController;
use Src\Repository\UserRepository;
use Src\Controller\OrdersController;
use Src\Repository\OrderRepository;
use Src\Repository\OrderDetailsRepository;
use Src\Controller\OrderDetailsController;
// Cargar el autoloading si estás usando Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Crear instancias necesarias
$OrderDetailsRepository = new OrderDetailsRepository();
$OrderDetailsController = new OrderDetailsController($OrderDetailsRepository);

return [
  'GET' => [
    'order_details' => function () use ($OrderDetailsController) {
      $OrderDetailsController->index();
    },
    'order_details/{id}' => function ($OrderDetailsId) use ($OrderDetailsController) {
      $OrderDetailsController->show((int)$OrderDetailsId);
    }
  ],
  // 'POST' => [
  //   'suppliers' => function () use ($SuppliersController) {
  //     $SuppliersController->store();
  //   },
  // ],
  // 'PUT' => [
  //   'suppliers/{id}' => function ($id) use ($SuppliersController) {
  //     $SuppliersController->update((int)$id);
  //   },
  // ],
  // 'DELETE' => [
  //   'suppliers/{id}' => function ($id) use ($SuppliersController) {
  //     $SuppliersController->delete((int)$id);
  //   },
  // ],
];