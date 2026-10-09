<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class DuplicateContactException extends Exception
{
    public function __construct(string $email, ?Throwable $previous = null)
    {
        parent::__construct("A contact with email {$email} already exists.", 0, $previous);
    }
}
