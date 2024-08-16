<?php 

declare(strict_types = 1);

namespace Src\Model;

class OrdersDetails 
{
    public function __construct(
        private int $Id,
        private int $OrderId,
        private int $LaptopId,
        private float $PriceUnit
    ) {
    }

    public function getId(): int
    {
        return $this->Id;
    }
    
    public function getOrderId(): int
    {
        return $this->OrderId;
    }
    
    public function getLaptopId(): int
    {
        return $this->LaptopId;
    }

    public function getPriceUnit(): float
    {
        return $this->PriceUnit;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->Id,
            'order_id' => $this->OrderId,
            'laptop_id' => $this->LaptopId,
            'price_unit' => $this->PriceUnit
        ];
    }
}