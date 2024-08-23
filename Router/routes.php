<?php

use Src\Repository\SuppliersRepository;
use Src\Controller\SuppliersController;
use Src\Repository\UserRepository;
use Src\Controller\UsersController;
use Src\Repository\PaymentMethodsRepository;
use Src\Controller\PaymentMethodsController;
use Src\Controller\OrdersController;
use Src\Repository\OrderRepository;
use Src\Repository\OrderDetailsRepository;
use Src\Controller\OrderDetailsController;

// Cargar el autoloading si estás usando Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Crear instancias necesarias
$suppliersRepository = new SuppliersRepository();
$suppliersController = new SuppliersController($suppliersRepository);

$orderRepository = new OrderRepository();
$ordersController = new OrdersController($orderRepository);

$OrderDetailsRepository = new OrderDetailsRepository();
$OrderDetailsController = new OrderDetailsController($OrderDetailsRepository);

$usersRepository = new UserRepository();
$usersController = new UsersController($usersRepository);

$paymentMethodsRepository = new PaymentMethodsRepository();
$paymentMethodsController = new PaymentMethodsController($paymentMethodsRepository);

return [
  'GET' => [
    'suppliers' => function() use ($suppliersController){
      $suppliersController->indexSuppliers();
    },
    'suppliers/{id}' => function ($suppliersId) use ($suppliersController) {
      $suppliersController->showSuppliers((int)$suppliersId);
    },

    'users' => function () use ($usersController) {
      $usersController->indexUsers();
    },
    'users/{id}' => function ($usersId) use ($usersController) {
      $usersController->showUsers((int)$usersId);
    },

    'payment_methods' => function () use ($paymentMethodsController) {
      $paymentMethodsController->indexPaymentMethods();
    },
    'payment_methods/{id}' => function ($paymentMethodId) use ($paymentMethodsController) {
      $paymentMethodsController->showPaymentMethods((int)$paymentMethodId);
    },

    'orders' => function () use ($ordersController) {
      $ordersController->indexOrders();
    },
    'orders/{id}' => function ($orderId) use ($ordersController) {
      $ordersController->showOrders((int)$orderId);
    },

    'order_details' => function () use ($OrderDetailsController) {
      $OrderDetailsController->indexOrderDetails();
    },
    'order_details/{id}' => function ($OrderDetailsId) use ($OrderDetailsController) {
      $OrderDetailsController->showOrderDetails((int)$OrderDetailsId);
    },


  ],

  'POST' => [
    'suppliers' => function () use ($suppliersController) {
      $suppliersController->storeSuppliers();
    },

    'users' => function () use ($usersController) {
      $usersController->storeUsers();
    },

    'payment_methods' => function () use ($paymentMethodsController) {
      $paymentMethodsController->storePaymentMethods();
    },

    'orders' => function () use ($ordersController) {
      $ordersController->storeOrders();
    },

    'order_details' => function () use ($OrderDetailsController) {
      $OrderDetailsController->storeOrderDetails();
    },


  ],

  'PUT' => [
    'suppliers/{id}' => function ($id) use ($suppliersController) {
      $suppliersController->updateSuppliers((int)$id);
    },

    'users/{id}' => function ($id) use ($usersController) {
      $usersController->updateUsers((int)$id);
    },

    'payment_methods/{id}' => function ($id) use ($paymentMethodsController) {
      $paymentMethodsController->updatePaymentMethods((int)$id);
    },

    'orders/{id}' => function ($id) use ($ordersController) {
      $ordersController->updateOrders((int)$id);
    },

    'order_details/{id}' => function ($id) use ($OrderDetailsController) {
      $OrderDetailsController->updateOrderDetails((int)$id);
    },
  ],

  'DELETE' => [
    'suppliers/{id}' => function ($id) use ($suppliersController) {
      $suppliersController->deleteSuppliers((int)$id);
    },

    'users/{id}' => function ($id) use ($usersController) {
      $usersController->deleteUsers((int)$id);
    },

    'payment_methods/{id}' => function ($id) use ($paymentMethodsController) {
      $paymentMethodsController->deletePaymentMethods((int)$id);
    },

    'orders/{id}' => function ($id) use ($ordersController){
      $ordersController->deleteOrders((int)$id);
    },

    'order_details/{id}' => function ($id) use ($OrderDetailsController) {
      $OrderDetailsController->deleteOrderDetails((int)$id);
    },
  ],
];