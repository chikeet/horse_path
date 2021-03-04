<?php
declare(strict_types=1);
/**
 * @testCase
 * @phpVersion >= 7.4
 */

namespace Chikeet\HorsePath\Tests;

require __DIR__ . '/../../../bootstrap.php';
require __DIR__ . '/../../../../src/PathFinder.php';

use Chikeet\HorsePath\Model\ValueObjects\ChessCoordinate;
use Chikeet\HorsePath\Model\ValueObjects\ChessPosition;
use Chikeet\HorsePath\PathFinder;
use Tester\Assert;
use Tester\TestCase;
use function array_key_first;
use function array_key_last;

/**
 * @coversDefaultClass \Chikeet\HorsePath\PathFinder
 */
class PathFinderTest extends TestCase
{

    /**
     * Horse stays in the same position.
     * @covers ::findShortestHorsePath
     */
	public function testFindShortestHorsePathSamePosition()
	{
        $startPosition = new ChessPosition(
            ChessCoordinate::createFromLetter('a'),
            ChessCoordinate::createFromHumanReadableInt(1),
        );
        $endPosition = new ChessPosition(
            ChessCoordinate::createFromLetter('a'),
            ChessCoordinate::createFromHumanReadableInt(1),
        );

        $pathPositions = PathFinder::findShortestHorsePath($startPosition, $endPosition);
        $firstPosition = $pathPositions[array_key_first($pathPositions)];

        Assert::equal(1, count($pathPositions));
        Assert::true($firstPosition->equals($startPosition));
        Assert::true($firstPosition->equals($endPosition));
    }

    /**
     * Horse makes one move from start to end.
     * @covers ::findShortestHorsePath
     */
	public function testFindShortestHorsePathOneMove()
	{
        $startPosition = new ChessPosition(
            ChessCoordinate::createFromLetter('a'),
            ChessCoordinate::createFromHumanReadableInt(1),
        );
        $endPosition = new ChessPosition(
            ChessCoordinate::createFromLetter('c'),
            ChessCoordinate::createFromHumanReadableInt(2),
        );

        $pathPositions = PathFinder::findShortestHorsePath($startPosition, $endPosition);
        $firstPosition = $pathPositions[array_key_first($pathPositions)];
        $lastPosition = $pathPositions[array_key_last($pathPositions)];

        Assert::equal(2, count($pathPositions));
        Assert::true($firstPosition->equals($startPosition));
        Assert::true($lastPosition->equals($endPosition));
    }

    /**
     * Horse makes two moves, first from start to b3 and second to end.
     * @covers ::findShortestHorsePath
     */
	public function testFindShortestHorsePathTwoMoves()
	{
        $startPosition = new ChessPosition(
            ChessCoordinate::createFromLetter('a'),
            ChessCoordinate::createFromHumanReadableInt(1),
        );
        $endPosition = new ChessPosition(
            ChessCoordinate::createFromLetter('c'),
            ChessCoordinate::createFromHumanReadableInt(1),
        );
        $anotherPosition = new ChessPosition(
            ChessCoordinate::createFromLetter('b'),
            ChessCoordinate::createFromHumanReadableInt(3),
        );

        $pathPositions = PathFinder::findShortestHorsePath($startPosition, $endPosition);
        $firstPosition = $pathPositions[0];
        $middlePosition = $pathPositions[1];
        $lastPosition = $pathPositions[2];

        Assert::equal(3, count($pathPositions));
        Assert::true($firstPosition->equals($startPosition));
        Assert::true($middlePosition->equals($anotherPosition));
        Assert::true($lastPosition->equals($endPosition));
    }
}

$test = new PathFinderTest;
$test->run();
