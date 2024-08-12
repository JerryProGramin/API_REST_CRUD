<?php

use Src\Controller\UserController;
use Src\Model\Suppliers;
use Src\Repository\SuppliersRepository;
use Src\Controller\SuppliersController;
use Src\Repository\UserRepository;

// Cargar el autoloading si estás usando Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Crear instancias necesarias
$SuppliersRepository = new SuppliersRepository();
$SuppliersController = new SuppliersController($SuppliersRepository);

return [
  'GET' => [
    'suppliers' => function () use ($SuppliersController) {
      $SuppliersController->index();
    },
    'suppliers/{id}' => function ($userId) use ($SuppliersController) {
      $SuppliersController->show((int)$userId);
    }
  ],
  'POST' => [
    'suppliers' => function () use ($SuppliersController) {
      $SuppliersController->store();
      },
  ],
  'PUT' => [
    'posts' => function () {
      require __DIR__ . '/../src/controllers/updatePostController.php';
      },
  ],
  'DELETE' => [
    'posts' => function () {
      require __DIR__ . '/../src/controllers/deletePostController.php';
    },
  ],
];