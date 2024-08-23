<?php 

declare(strict_types = 1);

namespace Src\Repository;

use PDO;
use Src\Database\Conexion;

class ProductRepository 
{
    private PDO $pdo;
    public function __construct(){
        $conexion = new Conexion();
        $this->pdo = $conexion->getConexion();
    }

    
}