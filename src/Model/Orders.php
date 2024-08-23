<?php

declare(strict_types=1);

namespace Src\Model;

use DateTime;

class Orders
{
    public function __construct(
        private int $id,
        private User $userId,
        private ?DateTime $date,
        private PaymentMethod $paymentMethodId,
        private float $total
    ){ 
    }

    // public function getId(): int {
    //     return $this->Id;
    // }

    // public function getUserId(): User {
    //     return $this->UserId;
    // }

    // public function getDateOrder(): ?DateTime {
    //     return $this->DateOrder;
    // }

    // public function getPaymentMethodId(): PaymentMethod {
    //     return $this->PaymentMethodId;
    // }

    // public function getOrderTotal(): float {
    //     return $this->OrderTotal;
    // }
    
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->userId->jsonSerialize(),
            'date_order' => $this->date->format('Y-m-d H:i:s'),
            'payment_method_id' => $this->paymentMethodId->jsonSerialize(),
            'order_total' => $this->total
        ];
    }
}
