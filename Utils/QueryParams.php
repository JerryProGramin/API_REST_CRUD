<?php 

declare (strict_types = 1);

class QueryParams
{
    public static function query(string $parameter, ?string $default = null): ?string
    {
        if(isset($_GET[$parameter])){
            $param = $_GET[$parameter];
            return $param;
        } else {
            return $default;
        }
    }
}