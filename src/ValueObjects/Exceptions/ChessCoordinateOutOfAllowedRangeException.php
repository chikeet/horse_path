<?php
declare(strict_types=1);

namespace App\Model\ValueObject\Exceptions;

use InvalidArgumentException;
use Throwable;

class ChessCoordinateOutOfAllowedRangeException extends InvalidArgumentException
{

    public function __construct(int $coordinate, int $maxValue, int $minValue, $code = 0, Throwable $previous = null)
    {
        $message = sprintf("Chess coordinate value %d is out of allowed range %d to %d.", $coordinate, $minValue, $maxValue);
        parent::__construct($message, $code, $previous);
    }
}
