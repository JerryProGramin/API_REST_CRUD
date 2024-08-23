<?php

declare(strict_types=1);
namespace Src\Controller;

use Src\Repository\OrderRepository;

class OrdersController 
{
    public function __construct(
        private OrderRepository $orderRepository
    ){
        $this->orderRepository = $orderRepository;
    }
    public function indexOrders(): void {
        $Order = $this->orderRepository->getAll();
        echo json_encode($Order);
    }
    public function showOrders(int $id): void {
        $Order = $this->orderRepository->getById($id);
        echo json_encode($Order);
    }

    public function storeOrders(): void {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        $this->orderRepository->register($data['user_id'], $data['date'], $data['payment_method_id'], $data['total']);
        echo json_encode(['message' => 'Orden registrada exitosamente']);
    }

    public function updateOrders(int $id): void {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        $this->orderRepository->update($id, $data['user_id'], $data['date'], $data['payment_method_id'], $data['total']);
        echo json_encode(['message' => 'Orden actualizada exitosamente']);
    }

    public function deleteOrders(int $id): void {
        $this->orderRepository->delete($id);
        echo json_encode(['message' => 'Orden eliminada exitosamente']);
    }
}