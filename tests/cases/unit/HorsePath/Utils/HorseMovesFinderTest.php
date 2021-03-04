<?php
declare(strict_types=1);
/**
 * @testCase
 * @phpVersion >= 7.4
 */

namespace Chikeet\HorsePath\Tests;

require __DIR__ . '/../../../../bootstrap.php';
require __DIR__ . '/../../../../../src/Utils/HorseMovesFinder.php';

use Chikeet\HorsePath\Utils\HorseMovesFinder;
use Chikeet\HorsePath\Model\ValueObjects\ChessCoordinate;
use Chikeet\HorsePath\Model\ValueObjects\ChessPosition;
use Tester\Assert;
use Tester\TestCase;

/**
 * @coversDefaultClass \Chikeet\HorsePath\Utils\HorseMovesFinder
 */
class HorseMovesFinderTest extends TestCase
{

    /**
     * @covers ::findAllowedPositions
     */
	public function testFindAllowedPositionsCorner()
	{
		$startPosition = new ChessPosition(
		    ChessCoordinate::createFromLetter('a'),
            ChessCoordinate::createFromHumanReadableInt(1),
        );

		$correctPositions = [
            new ChessPosition(
                ChessCoordinate::createFromLetter('b'),
                ChessCoordinate::createFromHumanReadableInt(3),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('c'),
                ChessCoordinate::createFromHumanReadableInt(2),
            ),
        ];

		$allowedPositions = HorseMovesFinder::findAllowedPositions($startPosition);

        Assert::equal(2, count($allowedPositions));
        Assert::true($correctPositions[0]->equals($allowedPositions[0]));
        Assert::true($correctPositions[1]->equals($allowedPositions[1]));
	}

    /**
     * @covers ::findAllowedPositions
     */
	public function testFindAllowedPositionsSide()
	{
		$startPosition = new ChessPosition(
		    ChessCoordinate::createFromLetter('a'),
            ChessCoordinate::createFromHumanReadableInt(4),
        );

		$correctPositions = [
            new ChessPosition(
                ChessCoordinate::createFromLetter('b'),
                ChessCoordinate::createFromHumanReadableInt(6),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('c'),
                ChessCoordinate::createFromHumanReadableInt(5),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('c'),
                ChessCoordinate::createFromHumanReadableInt(3),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('b'),
                ChessCoordinate::createFromHumanReadableInt(2),
            ),
        ];

		$allowedPositions = HorseMovesFinder::findAllowedPositions($startPosition);

        Assert::equal(4, count($allowedPositions));
        Assert::true($correctPositions[0]->equals($allowedPositions[0]));
        Assert::true($correctPositions[1]->equals($allowedPositions[1]));
        Assert::true($correctPositions[2]->equals($allowedPositions[2]));
        Assert::true($correctPositions[3]->equals($allowedPositions[3]));
	}

    /**
     * @covers ::findAllowedPositions
     */
	public function testFindAllowedPositionsMiddle()
	{
		$startPosition = new ChessPosition(
		    ChessCoordinate::createFromLetter('e'),
            ChessCoordinate::createFromHumanReadableInt(5),
        );

		$correctPositions = [
            new ChessPosition(
                ChessCoordinate::createFromLetter('f'),
                ChessCoordinate::createFromHumanReadableInt(7),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('g'),
                ChessCoordinate::createFromHumanReadableInt(6),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('g'),
                ChessCoordinate::createFromHumanReadableInt(4),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('f'),
                ChessCoordinate::createFromHumanReadableInt(3),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('d'),
                ChessCoordinate::createFromHumanReadableInt(3),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('c'),
                ChessCoordinate::createFromHumanReadableInt(4),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('c'),
                ChessCoordinate::createFromHumanReadableInt(6),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('d'),
                ChessCoordinate::createFromHumanReadableInt(7),
            ),
        ];

		$allowedPositions = HorseMovesFinder::findAllowedPositions($startPosition);

        Assert::equal(8, count($allowedPositions));
        Assert::true($correctPositions[0]->equals($allowedPositions[0]));
        Assert::true($correctPositions[1]->equals($allowedPositions[1]));
        Assert::true($correctPositions[2]->equals($allowedPositions[2]));
        Assert::true($correctPositions[3]->equals($allowedPositions[3]));
        Assert::true($correctPositions[4]->equals($allowedPositions[4]));
        Assert::true($correctPositions[5]->equals($allowedPositions[5]));
        Assert::true($correctPositions[6]->equals($allowedPositions[6]));
        Assert::true($correctPositions[7]->equals($allowedPositions[7]));
	}
}

$test = new HorseMovesFinderTest;
$test->run();
