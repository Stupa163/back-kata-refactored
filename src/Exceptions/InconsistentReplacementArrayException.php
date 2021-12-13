<?php

namespace src\Exceptions;

use Exception;
use Throwable;

class InconsistentReplacementArrayException extends Exception
{
    public const MESSAGE = 'Size of the replacements array doesn\'t match size of the searches array';

    public function __construct(int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct(self::MESSAGE, $code, $previous);
    }
}