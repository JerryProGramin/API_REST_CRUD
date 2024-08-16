<?php

declare(strict_types=1);
namespace Src\Controller;

use Src\Repository\SuppliersRepository;
//use Src\Model\Suppliers;

class SuppliersController {
    public function __construct(
        private SuppliersRepository $suppliersRepository
    ){
        //$this->suppliersRepository = $suppliersRepository;
    }

    public function index(): void {
        $suppliers = $this->suppliersRepository->getAll();
        echo json_encode($suppliers);
    }

    public function show(int $id): void {
        $supplier = $this->suppliersRepository->getById($id);
        echo json_encode($supplier->jsonSerialize());
    }

    public function store(): void {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $this->suppliersRepository->Register($data['name'], $data['contact_info'], $data['phone'], $data['email']);
        echo json_encode(['message' => 'supplier created successfully']);
    }

    public function update(int $id): void {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $this->suppliersRepository->update($id, $data['name'], $data['contact_info'], $data['phone'], $data['email']);
        echo json_encode(['message' => 'supplier updated successfully']);
    }

    public function delete(int $id): void {
        $this->suppliersRepository->delete($id);
        echo json_encode(['message' => 'supplier deleted successfully']);
    }
}
