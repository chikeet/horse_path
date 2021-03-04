<?php
declare(strict_types=1);
/**
 * @testCase
 * @phpVersion >= 7.4
 */

namespace Chikeet\HorsePath\Tests;

require __DIR__ . '/../../../../bootstrap.php';
require __DIR__ . '/../../../../../src/Utils/UuidGenerator.php';

use Chikeet\HorsePath\Utils\UuidGenerator;
use Tester\Assert;
use Tester\TestCase;

/**
 * @coversDefaultClass \Chikeet\HorsePath\Utils\UuidGenerator
 */
class UuidGeneratorTest extends TestCase
{

    /**
     * @covers ::isValidUuid4
     */
	public function testIsValidUuid4()
	{
		$validUuid4 = '11405ad1-b16e-46a7-813e-565ac9935344';
		$invalidUuid4 = 'x1405ad1-b16e-46a7-813e-565ac9935344';

        Assert::true(UuidGenerator::isValidUuid4($validUuid4));
        Assert::false(UuidGenerator::isValidUuid4($invalidUuid4));
        Assert::false(UuidGenerator::isValidUuid4('ahoj'));
	}

    /**
     * @covers ::generateUuid4
     */
	public function testGenerateUuid4()
	{
		$generatedUuid = UuidGenerator::generateUuid4();

        Assert::true(UuidGenerator::isValidUuid4($generatedUuid));
	}
}

$test = new UuidGeneratorTest;
$test->run();
