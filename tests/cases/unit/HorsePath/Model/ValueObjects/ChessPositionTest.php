<?php
declare(strict_types=1);
/**
 * @testCase
 * @phpVersion >= 7.4
 */

namespace Chikeet\HorsePath\Tests;

require __DIR__ . '/../../../../../bootstrap.php';
require __DIR__ . '/../../../../../../src/Model/ValueObjects/ChessPosition.php';

use Chikeet\HorsePath\Model\ValueObjects\ChessCoordinate;
use Chikeet\HorsePath\Model\ValueObjects\ChessPosition;
use Tester\Assert;
use Tester\TestCase;

/**
 * @coversDefaultClass \Chikeet\HorsePath\Model\ValueObjects\ChessPosition
 */
class ChessPositionTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::getRaw
     * @covers ::toHumanReadableString
     */
    public function testConstructAndFormatters(): void
	{
	    $xCoordinate = ChessCoordinate::createFromLetter('a');
	    $yCoordinate = ChessCoordinate::createFromHumanReadableInt(1);

	    $position1 = new ChessPosition($xCoordinate, $yCoordinate);

		Assert::equal([0, 0], $position1->getRaw());
		Assert::equal('a1', $position1->toHumanReadableString());
	}

    /**
     * @covers ::equals
     */
    public function testEquals(): void
	{
	    $xCoordinate = ChessCoordinate::createFromLetter('a');
	    $yCoordinate = ChessCoordinate::createFromHumanReadableInt(1);

        $xCoordinate2 = ChessCoordinate::createFromLetter('a');
        $yCoordinate2 = ChessCoordinate::createFromHumanReadableInt(1);

        $xCoordinate3 = ChessCoordinate::createFromLetter('b');
        $yCoordinate3 = ChessCoordinate::createFromHumanReadableInt(1);

	    $position1 = new ChessPosition($xCoordinate, $yCoordinate);
	    $position2 = new ChessPosition($xCoordinate2, $yCoordinate2);
	    $position3 = new ChessPosition($xCoordinate3, $yCoordinate3);

		Assert::true($position1->equals($position2));
		Assert::false($position1->equals($position3));
	}
}

$test = new ChessPositionTest;
$test->run();
