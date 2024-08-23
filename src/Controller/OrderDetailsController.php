<?php

declare(strict_types=1);
namespace Src\Controller;

use Src\Repository\OrderDetailsRepository;

class OrderDetailsController 
{
    public function __construct(
        private OrderDetailsRepository $orderDetailsRepository
    ){
        $this->orderDetailsRepository = $orderDetailsRepository;
    }
    public function indexOrderDetails(): void {
        $OrderDetails = $this->orderDetailsRepository->getAll();
        echo json_encode($OrderDetails);
    }
    public function showOrderDetails(int $id): void {
        $OrderDetails = $this->orderDetailsRepository->getById($id);
        echo json_encode($OrderDetails);
    }

    public function storeOrderDetails(): void {
        // Implement the logic to create a new OrderDetails record
    }

    public function updateOrderDetails(): void {
        // Implement the logic to update an existing OrderDetails record
    }

    public function deleteOrderDetails(): void {
        // Implement the logic to delete an existing OrderDetails record
    }
}