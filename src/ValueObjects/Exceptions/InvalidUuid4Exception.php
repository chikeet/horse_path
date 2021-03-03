<?php
declare(strict_types=1);

namespace App\Model\ValueObject\Exceptions;

use InvalidArgumentException;
use Throwable;

class InvalidUuid4Exception extends InvalidArgumentException
{

    public function __construct(string $invalidUuid4, $code = 0, Throwable $previous = null)
    {
        $message = sprintf("String '%s' is not a valid UUID4.", $invalidUuid4);
        parent::__construct($message, $code, $previous);
    }
}
