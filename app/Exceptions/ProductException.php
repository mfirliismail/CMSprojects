<?php

namespace App\Exceptions;

use Exception;

class ProductException extends Exception
{
    public static function notFound($message = "Product not found")
    {
        return new self($message, 404);
    }

    public static function serverError($message = "Server Error")
    {
        return new self($message, 500);
    }
}
