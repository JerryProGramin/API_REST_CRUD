<?php 

declare(strict_types = 1);

namespace Src\Controller;
use Src\Repository\PaymentMethodsRepository;
class PaymentMethodsController 
{
    public function __construct(
        private PaymentMethodsRepository $paymentMethodsRepository
    ){
    }

    public function indexPaymentMethods(): void {
        $paymentMethods = $this->paymentMethodsRepository->getAll();
        echo json_encode($paymentMethods);
    }

    public function showPaymentMethods(int $id): void {
        $paymentMethod = $this->paymentMethodsRepository->getById($id);
        echo json_encode($paymentMethod->jsonSerialize());
    }

    public function storePaymentMethods(): void {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        $this->paymentMethodsRepository->register($data['name'], $data['details']);
        echo json_encode(['message' => 'Método de pago creado exitosamente']);
    }  

    public function updatePaymentMethods(int $id): void 
    {
        $input = file_get_contents('php://input');
        $data = json_decode($input, true);
        $this->paymentMethodsRepository->update($id, $data['name'], $data['details']);
        echo json_encode(['message' => 'Método de pago actualizado exitosamente']);
    }

    public function deletePaymentMethods(int $id): void
    {
        $this->paymentMethodsRepository->delete($id);
        echo json_encode(['message' => 'Método de pago eliminado exitosamente']);
    }
}