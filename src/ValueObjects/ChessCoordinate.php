<?php
declare(strict_types=1);

namespace Chikeet\HorsePath\ValueObjects;

use App\Model\ValueObject\Exceptions\InvalidChessCoordinateLetterException;
use function array_key_exists;
use function array_search;
use function in_array;

class ChessCoordinate
{
    private const MIN_VALUE = 0;
    private const MAX_VALUE = 7;

    private const LETTERS = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];

    private int $rawValue;

    public function __construct(int $rawValue)
    {
        if ($rawValue < self::MIN_VALUE || $rawValue > self::MAX_VALUE) {
            throw new \App\Model\ValueObject\Exceptions\ChessCoordinateOutOfAllowedRangeException($rawValue, self::MIN_VALUE, self::MAX_VALUE);
        }
        $this->rawValue = $rawValue;
    }

    public function getRaw(): int
    {
        return $this->rawValue;
    }

    public function toLetter(): string
    {
        return self::LETTERS[$this->rawValue];
    }

    public static function createFromLetter(string $letter): ChessCoordinate
    {
        if (!in_array($letter, self::LETTERS)) {
            throw new InvalidChessCoordinateLetterException($letter);
        }
        $intValue = array_search($letter, self::LETTERS);
        return new self ($intValue);
    }
}
