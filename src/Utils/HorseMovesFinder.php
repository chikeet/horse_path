<?php
declare(strict_types=1);

namespace Chikeet\HorsePath\Utils;

use Chikeet\HorsePath\ValueObjects\ChessCoordinate;
use Chikeet\HorsePath\ValueObjects\ChessPosition;

class HorseMovesFinder
{
    /** @var array<int, array<int, int>> allowed horse moves by fields number in X and Y coordinate */
    private const ALLOWED_MOVES = [
        [1, 2],
        [2, 1],
        [2, -1],
        [1, -2],
        [-1, -2],
        [-2, -1],
        [-2, 1],
        [-1, 2],
    ];

    /**
     * Returns array of all positions available from current position by allowed horse moves.
     * @param ChessPosition $position
     * @return array<int, ChessPosition>
     */
    public static function findAllowedPositions(ChessPosition $position): array
    {
        list($rawX, $rawY) = $position->getRaw();

        $newPositions = [];
        foreach (self::ALLOWED_MOVES as $move) {
            list($xDifference, $yDifference) = $move;

            $newRawX = $rawX + $xDifference;
            $newRawY = $rawY + $yDifference;

            try {
                $newXCoordinate = new ChessCoordinate($newRawX);
                $newYCoordinate = new ChessCoordinate($newRawY);
            	$newPositions[] = new ChessPosition($newXCoordinate, $newYCoordinate);
            } catch (\App\Model\ValueObject\Exceptions\ChessCoordinateOutOfAllowedRangeException $e) {
            	// invalid coordinate, ignore
            }
        }

        return $newPositions;
    }

}
