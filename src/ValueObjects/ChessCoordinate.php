<?php
declare(strict_types=1);

namespace Chikeet\HorsePath\ValueObjects;

use function array_search;
use function in_array;

/**
 * Represents single chess coordinate. Used in @see ChessPosition.
 */
class ChessCoordinate
{
    /* limits for range of allowed numeric coordinate values */
    private const MIN_VALUE = 0;
    private const MAX_VALUE = 7;

    /* allowed alphabetic coordinate values */
    private const LETTERS = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h'];

    private int $rawValue;

    /**
     * @param int $rawValue in range 0 to 7.
     */
    public function __construct(int $rawValue)
    {
        if ($rawValue < self::MIN_VALUE || $rawValue > self::MAX_VALUE) {
            throw new \App\Model\ValueObject\Exceptions\ChessCoordinateOutOfAllowedRangeException($rawValue, self::MIN_VALUE, self::MAX_VALUE);
        }
        $this->rawValue = $rawValue;
    }

    /**
     * Returns numeric value of the coordinate.
     * @return int
     */
    public function getRaw(): int
    {
        return $this->rawValue;
    }

    /**
     * Returns numeric value of the coordinate in range 1 to 8.
     * @return int
     */
    public function toHumanReadableInt(): int
    {
        return $this->rawValue + 1;
    }

    /**
     * Returns alphabetic value of the coordinate.
     * @return string
     */
    public function toLetter(): string
    {
        return self::LETTERS[$this->rawValue];
    }

    /**
     * Creates the coordinate from a letter if valid.
     * @param string $letter
     * @return ChessCoordinate
     *
     * @throws \App\Model\ValueObject\Exceptions\InvalidChessCoordinateLetterException
     */
    public static function createFromLetter(string $letter): ChessCoordinate
    {
        if (!in_array($letter, self::LETTERS)) {
            throw new \App\Model\ValueObject\Exceptions\InvalidChessCoordinateLetterException($letter);
        }
        $intValue = array_search($letter, self::LETTERS);
        return new self ($intValue);
    }

    /**
     * Creates the coordinate from integer in range 1 to 8.
     * @param int $humanReadableInt
     * @return ChessCoordinate
     *
     * @throws \App\Model\ValueObject\Exceptions\InvalidChessCoordinateLetterException
     */
    public static function createFromInt(int $humanReadableInt): ChessCoordinate
    {
        $intValue = $humanReadableInt - 1;
        return new self ($intValue);
    }
}
