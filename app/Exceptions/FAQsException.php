<?php

namespace App\Exceptions;

use Exception;

class FAQsException extends Exception
{
    public static function notFound($message = "FAQs not found")
    {
        return new self($message, 404);
    }

    public static function serverError($message = "Server Error")
    {
        return new self($message, 500);
    }
}
