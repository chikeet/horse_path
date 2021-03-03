<?php
declare(strict_types=1);

namespace Chikeet\HorsePath\ValueObjects;

class ChessPosition
{
    private ChessCoordinate $xCoordinate;

    private ChessCoordinate $yCoordinate;

    public function __construct(ChessCoordinate $xCoordinate, ChessCoordinate $yCoordinate)
    {
        $this->xCoordinate = $xCoordinate;
        $this->yCoordinate = $yCoordinate;
    }

    /**
     * @return array<int, int>
     */
    public function getRaw(): array
    {
        return [$this->xCoordinate->getRaw(), $this->yCoordinate->getRaw()];
    }

    /**
     * @return array<int, string|int>
     */
    public function getHumanReadable(): array
    {
        return [$this->xCoordinate->toLetter(), $this->yCoordinate->getRaw() + 1];
    }

    public function equals(ChessPosition $other)
    {
        return $this->getRaw() === $other->getRaw();
    }
}
