<?php
declare(strict_types=1);
/**
 * @testCase
 * @phpVersion >= 7.4
 */

namespace Chikeet\HorsePath\Tests;

require __DIR__ . '/../../../bootstrap.php';
require __DIR__ . '/../../../../src/Tree.php';

use Chikeet\HorsePath\Model\TreeNode;
use Chikeet\HorsePath\Tree;
use Tester\Assert;
use Tester\TestCase;

use function array_key_first;

/**
 * @coversDefaultClass \Chikeet\HorsePath\Tree
 */
class TreeTest extends TestCase
{

    /**
     * @covers ::__construct
     * @covers ::getLeaves
     */
	public function testConstruct()
	{
	    $root = new TreeNode(null, new \stdClass);
		$tree = new Tree($root);

		$leaves = $tree->getLeaves();
        $firstLeaf = $leaves[array_key_first($leaves)];

        Assert::equal(1, count($leaves));
        Assert::true($root->equals($firstLeaf));
        Assert::true($root->isLeaf());
    }

    /**
     * @covers ::addChildNode
     */
	public function testAddChildNode()
	{
	    $root = new TreeNode(null, new \stdClass);
	    $child = new TreeNode(null, new \stdClass);

		$tree = new Tree($root);
		$tree->addChildNode($child, $root);

		$leaves = $tree->getLeaves();
		$firstLeaf = $leaves[array_key_first($leaves)];

        Assert::equal(1, count($leaves));
        Assert::true($child->equals($firstLeaf));
        Assert::false($root->isLeaf());
        Assert::true($child->isLeaf());
        Assert::true($child->getParent()->equals($root));
    }
}

$test = new TreeTest;
$test->run();
