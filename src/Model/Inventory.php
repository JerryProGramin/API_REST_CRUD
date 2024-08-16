<?php

declare(strict_types = 1);

namespace Src\Model;

class Inventory
{   
    public function __construct(
        private int $Id,
        private int $LaptopId,
        private int $Stock
    ){
    }

    public function getId(): int
    {
        return $this->Id;
    }
    
    public function getLaptopId(): int
    {
        return $this->LaptopId;
    }
    
    public function getStock(): int
    {
        return $this->Stock;
    }
    
    public function jsonSerialize(): array
    {
        return [
            'Id' => $this->Id,
            'LaptopId' => $this->LaptopId,
            'Stock' => $this->Stock
        ];
    }

}