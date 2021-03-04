<?php
declare(strict_types=1);

namespace App\Model\ValueObject\Exceptions;

use InvalidArgumentException;
use Throwable;

use function sprintf;

class InvalidChessCoordinateLetterException extends InvalidArgumentException
{

    public function __construct(string $letter, $code = 0, Throwable $previous = null)
    {
        $message = sprintf("Letter '%s' is not allowed chess coordinate.", $letter);
        parent::__construct($message, $code, $previous);
    }
}
