<?php
declare(strict_types=1);
/**
 * @testCase
 * @phpVersion >= 7.4
 */

namespace Chikeet\HorsePath\Tests;

require __DIR__ . '/../../../../bootstrap.php';
require __DIR__ . '/../../../../../src/Model/TreeNode.php';

use Chikeet\HorsePath\Model\TreeNode;
use stdClass;
use Tester\Assert;
use Tester\TestCase;

/**
 * @coversDefaultClass \Chikeet\HorsePath\Model\TreeNode
 */
class TreeNodeTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::getPayload
     * @covers ::isLeaf
     */
    public function testRoot(): void
	{
	    $payload = new stdClass;
		$treeNode = new TreeNode(null, $payload);

		Assert::equal($payload, $treeNode->getPayload());
		Assert::true($treeNode->isLeaf());
	}

    /**
     * @covers ::__construct
     * @covers ::getParent
     * @covers ::isLeaf
     */
    public function testLeafWithParent(): void
	{
	    $payload = new stdClass;
		$parent = new TreeNode(null, $payload);

		$payload2 = new stdClass;
		$treeNode = new TreeNode($parent, $payload2);

		Assert::equal($parent, $treeNode->getParent());
		Assert::true($treeNode->isLeaf());
		Assert::false($parent->isLeaf());
	}

    /**
     * @covers ::__construct
     * @covers ::addChild
     * @covers ::getParent
     * @covers ::isLeaf
     */
    public function testAddChild(): void
	{
	    $payload = new stdClass;
		$parent = new TreeNode(null, $payload);

		$payload2 = new stdClass;
		$child = new TreeNode(null, $payload2);

		$parent->addChild($child);

		Assert::equal($parent, $child->getParent());
		Assert::true($child->isLeaf());
		Assert::false($parent->isLeaf());
	}
}

$test = new TreeNodeTest;
$test->run();
