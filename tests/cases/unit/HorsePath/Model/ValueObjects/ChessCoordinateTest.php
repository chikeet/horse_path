<?php
declare(strict_types=1);
/**
 * @testCase
 * @phpVersion >= 7.4
 */

namespace Chikeet\HorsePath\Tests;

require __DIR__ . '/../../../../../bootstrap.php';
require __DIR__ . '/../../../../../../src/Model/ValueObjects/ChessCoordinate.php';

use Chikeet\HorsePath\Model\ValueObjects\ChessCoordinate;
use Tester\Assert;
use Tester\TestCase;

/**
 * @coversDefaultClass \Chikeet\HorsePath\Model\ValueObjects\ChessCoordinate
 */
class ChessCoordinateTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::getRaw
     * @covers ::toHumanReadableInt
     * @covers ::toLetter
     */
    public function testConstructAndFormattersMinValue(): void
	{
	    $coordinate = new ChessCoordinate(0);

		Assert::equal(0, $coordinate->getRaw());
		Assert::equal(1, $coordinate->toHumanReadableInt());
		Assert::equal('a', $coordinate->toLetter());
	}

    /**
     * @covers ::__construct
     * @covers ::getRaw
     * @covers ::toHumanReadableInt
     * @covers ::toLetter
     */
    public function testConstructAndFormattersMaxValue(): void
	{
	    $coordinate = new ChessCoordinate(7);

		Assert::equal(7, $coordinate->getRaw());
		Assert::equal(8, $coordinate->toHumanReadableInt());
		Assert::equal('h', $coordinate->toLetter());
	}

    /**
     * @covers ::__construct
     */
    public function testConstructInvalidValueTooLow(): void
	{
        Assert::exception(function(){
            new ChessCoordinate(-1);
        }, \Chikeet\HorsePath\Model\ValueObjects\Exceptions\ChessCoordinateOutOfAllowedRangeException::class, 'Chess coordinate value -1 is out of allowed range 0 to 7.');
	}

    /**
     * @covers ::__construct
     */
    public function testConstructInvalidValueTooHigh(): void
	{
        Assert::exception(function(){
            new ChessCoordinate(8);
        }, \Chikeet\HorsePath\Model\ValueObjects\Exceptions\ChessCoordinateOutOfAllowedRangeException::class, 'Chess coordinate value 8 is out of allowed range 0 to 7.');
	}

    /**
     * @covers ::createFromLetter
     * @covers ::toLetter
     */
    public function testCreateFromLetter(): void
    {
        $coordinate = ChessCoordinate::createFromLetter('c');
        Assert::equal('c', $coordinate->toLetter());
    }

    /**
     * @covers ::createFromLetter
     */
    public function testCreateFromLetterInvalid(): void
    {
        Assert::exception(function(){
            ChessCoordinate::createFromLetter('x');
        }, \Chikeet\HorsePath\Model\ValueObjects\Exceptions\InvalidChessCoordinateLetterException::class, "Letter 'x' is not allowed chess coordinate.");
    }

    /**
     * @covers ::createFromHumanReadableInt
     * @covers ::toHumanReadableInt
     */
    public function testCreateFromHumanReadableInt(): void
    {
        $coordinate = ChessCoordinate::createFromHumanReadableInt(8);
        Assert::equal(8, $coordinate->toHumanReadableInt());
    }

    /**
     * @covers ::createFromLetter
     * @covers ::getRaw
     * @covers ::toHumanReadableInt
     * @covers ::toLetter
     */
    public function testCreateFromHumanReadableIntInvalid(): void
    {
        Assert::exception(function(){
            ChessCoordinate::createFromHumanReadableInt(9);
        }, \Chikeet\HorsePath\Model\ValueObjects\Exceptions\ChessCoordinateOutOfAllowedRangeException::class, 'Chess coordinate value 8 is out of allowed range 0 to 7.');
    }
}

$test = new ChessCoordinateTest;
$test->run();
