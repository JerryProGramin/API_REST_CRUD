<?php 

declare(strict_types = 1);

namespace Src\Model;

class OrdersDetails 
{
    public function __construct(
        private int $id,
        private Orders $orderId,
        private Products $productsId,
        private float $priceUnit
    ) {
    }

    // public function getId(): int
    // {
    //     return $this->id;
    // }
    
    // public function getOrderId(): Orders
    // {
    //     return $this->orderId;
    // }
    
    // public function getLaptopId(): Products
    // {
    //     return $this->productsId;
    // }

    // public function getPriceUnit(): float
    // {
    //     return $this->priceUnit;
    // }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'order_id' => $this->orderId->jsonSerialize(),
            'laptop_id' => $this->productsId->jsonSerialize(),
            'price_unit' => $this->priceUnit
        ];
    }
}