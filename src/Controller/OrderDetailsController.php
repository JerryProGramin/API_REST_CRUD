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
    public function index(): void {
        $OrderDetails = $this->orderDetailsRepository->getAll();
        echo json_encode($OrderDetails);
    }
    // public function show(int $id): void {
    //     $OrderDetails = $this->orderDetailsRepository->getById($id);
    //     echo json_encode($OrderDetails);
    // }
}