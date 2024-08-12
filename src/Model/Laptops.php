<?php 

declare(strict_types=1);

use Src\Model\Suppliers;
//namespace Src\Model;

use DateTime;

class Laptops
{
    public function __construct(
        private int $Id,
        private string $Brand,
        private string $Model,
        private string $Specifications,
        private float $Price,
        private string $Description,
        private DateTime $Release_date,
        private Suppliers $SupplierId
    ){ 
    }

    public function getId(): int {
        return $this->Id;
    }

    public function getBrand(): string {
        return $this->Brand;
    }

    public function getModel(): string {
        return $this->Model;
    }

    public function getSpecifications(): string {
        return $this->Specifications;
    }

    public function getPrice(): float {
        return $this->Price;
    }

    public function getDescription(): string {
        return $this->Description;
    }

    public function getRelease_date(): DateTime {
        return $this->Release_date;
    }

    public function getSuppliersId(): Suppliers {
        return $this->SupplierId;
    }
}