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
    public function index(): void {
        $Order = $this->orderRepository->getAll();
        echo json_encode($Order);
    }
    // public function show(int $id): void {
    //     $Order = $this->orderRepository->getById($id);
    //     echo json_encode($Order->jsonSerialize());
    // }
}