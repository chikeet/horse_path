<?php
declare(strict_types=1);
/**
 * @testCase
 * @phpVersion >= 7.4
 */

namespace Chikeet\HorsePath\Tests;

require __DIR__ . '/../../../../bootstrap.php';
require __DIR__ . '/../../../../../src/Utils/ArrayValidator.php';

use Chikeet\HorsePath\Utils\ArrayValidator;
use Tester\Assert;
use Tester\TestCase;

/**
 * @coversDefaultClass \Chikeet\HorsePath\Utils\ArrayValidator
 */
class ArrayValidatorTest extends TestCase
{

    /**
     * @covers ::validateEveryIsInstanceOf
     */
	public function testValidateEveryIsInstanceOf()
	{
		$arrayToCheck = [
			'tomato' => new \stdClass,
			'potato' => new \stdClass,
			5 => new \stdClass,
		];

        ArrayValidator::validateEveryIsInstanceOf($arrayToCheck, \stdClass::class, 'myParameter');
        Assert::true(true); // since Nette\Tester has no configuration option allowing test without assertions - see https://tester.nette.org/cs/writing-tests#toc-specialni-situace
	}

    /**
     * @covers ::validateEveryIsInstanceOf
     */
	public function testValidateEveryIsInstanceOfFail()
	{
		$arrayToCheck = [
			1 => 'afds',
			'tomato' => FALSE,
			'potato' => NULL,
			0 => [],
			5 => new \stdClass,
		];
		Assert::exception(function() use($arrayToCheck){
			ArrayValidator::validateEveryIsInstanceOf($arrayToCheck, \stdClass::class, 'myParameter');
		}, \InvalidArgumentException::class, 'Array $myParameter must contain only instances of stdClass, string given.');
	}
}

$test = new ArrayValidatorTest;
$test->run();
