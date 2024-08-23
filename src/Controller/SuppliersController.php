<?php

declare(strict_types=1);
namespace Src\Controller;

use Src\Repository\SuppliersRepository;
use Src\Model\Suppliers;

class SuppliersController {
    public function __construct(
        private SuppliersRepository $suppliersRepository
    ){
        //$this->suppliersRepository = $suppliersRepository;
    }

    public function indexSuppliers(): void {
        $suppliers = $this->suppliersRepository->getAll();
        echo json_encode($suppliers);
    }

    public function showSuppliers(int $id): void {
        $supplier = $this->suppliersRepository->getById($id);
        echo json_encode($supplier->jsonSerialize());
    }

    public function storeSuppliers(): void {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $this->suppliersRepository->Register($data['name'], $data['contact_info'], $data['phone'], $data['email']);
        echo json_encode(['message' => 'Proveedor creado exitosamente']);
    }

    public function updateSuppliers(int $id): void {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);

        $this->suppliersRepository->update($id, $data['name'], $data['contact_info'], $data['phone'], $data['email']);
        echo json_encode(['message' => 'Proveedor actualizado exitosamente']);
    }

    public function deleteSuppliers(int $id): void {
        $this->suppliersRepository->delete($id);
        echo json_encode(['message' => 'Proveedor eliminado exitosamente']);
    }
}
