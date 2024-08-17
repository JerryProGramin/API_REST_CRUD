<?php

declare(strict_types=1);

namespace Src\Model;

use DateTime;

class Orders
{
    public function __construct(
        private int $Id,
        private User $UserId,
        private ?DateTime $DateOrder,
        private PaymentMethod $PaymentMethodId,
        private float $OrderTotal
    ){ 
    }

    public function getId(): int {
        return $this->Id;
    }

    public function getUserId(): User {
        return $this->UserId;
    }

    public function getDateOrder(): ?DateTime {
        return $this->DateOrder;
    }

    public function getPaymentMethodId(): PaymentMethod {
        return $this->PaymentMethodId;
    }

    public function getOrderTotal(): float {
        return $this->OrderTotal;
    }
    
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->Id,
            'user_id' => $this->UserId->jsonSerialize(),
            'date_order' => $this->DateOrder->format('Y-m-d H:i:s'),
            'payment_method_id' => $this->PaymentMethodId->jsonSerialize(),
            'order_total' => $this->OrderTotal
        ];
    }
}
