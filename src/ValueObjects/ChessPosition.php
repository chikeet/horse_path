<?php
declare(strict_types=1);

namespace Chikeet\HorsePath\ValueObjects;

/**
 * Represents chess position. Consists of two @see ChessCoordinate.
 */
class ChessPosition
{
    private ChessCoordinate $xCoordinate;

    private ChessCoordinate $yCoordinate;

    /**
     * ChessPosition constructor.
     * @param ChessCoordinate $xCoordinate (usually alphabetic)
     * @param ChessCoordinate $yCoordinate (usually numeric)
     */
    public function __construct(ChessCoordinate $xCoordinate, ChessCoordinate $yCoordinate)
    {
        $this->xCoordinate = $xCoordinate;
        $this->yCoordinate = $yCoordinate;
    }

    /**
     * Returns position coordinates as an array of two numeric coordinates.
     * @return array<int, int>
     */
    public function getRaw(): array
    {
        return [$this->xCoordinate->getRaw(), $this->yCoordinate->getRaw()];
    }

    /**
     * Returns position coordinates as a string consisting of an alphabetic and numeric coordinate.
     * @return string
     */
    public function getHumanReadable(): string
    {
        return sprintf("%s%d", $this->xCoordinate->toLetter(), $this->yCoordinate->toHumanReadableInt());
    }

    /**
     * Compares equality of two chess positions.
     * @param ChessPosition $other
     * @return bool
     */
    public function equals(ChessPosition $other)
    {
        return $this->getRaw() === $other->getRaw();
    }
}
