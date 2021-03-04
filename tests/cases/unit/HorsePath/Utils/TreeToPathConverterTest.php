<?php
declare(strict_types=1);
/**
 * @testCase
 * @phpVersion >= 7.4
 */

namespace Chikeet\HorsePath\Tests;

require __DIR__ . '/../../../../bootstrap.php';
require __DIR__ . '/../../../../../src/Utils/HorseMovesFinder.php';

use Chikeet\HorsePath\Model\TreeNode;
use Chikeet\HorsePath\Utils\TreeToPathConverter;
use Chikeet\HorsePath\Model\ValueObjects\ChessCoordinate;
use Chikeet\HorsePath\Model\ValueObjects\ChessPosition;
use Tester\Assert;
use Tester\TestCase;

/**
 * @coversDefaultClass \Chikeet\HorsePath\Utils\TreeToPathConverter
 */
class TreeToPathConverterTest extends TestCase
{

    /**
     * @covers ::createPathFromTreeNodes
     */
	public function testCreatePathFromTreeNodes()
	{
		$position1 = new ChessPosition(
		    ChessCoordinate::createFromLetter('a'),
            ChessCoordinate::createFromHumanReadableInt(1),
        );
		$treeNode1 = new TreeNode(null, $position1); // root of tree 1

		$position2 = new ChessPosition(
		    ChessCoordinate::createFromLetter('b'),
            ChessCoordinate::createFromHumanReadableInt(2),
        );
        $treeNode2 = new TreeNode($treeNode1, $position2);

		$position3 = new ChessPosition(
		    ChessCoordinate::createFromLetter('c'),
            ChessCoordinate::createFromHumanReadableInt(3),
        );
        $treeNode3 = new TreeNode($treeNode2, $position3);

		$position4 = new ChessPosition(
		    ChessCoordinate::createFromLetter('e'),
            ChessCoordinate::createFromHumanReadableInt(5),
        );
        $treeNode4 = new TreeNode(null, $position4); // root of tree 2

        $position5 = new ChessPosition(
		    ChessCoordinate::createFromLetter('d'),
            ChessCoordinate::createFromHumanReadableInt(4),
        );
        $treeNode5 = new TreeNode($treeNode4, $position5);

        $position6 = new ChessPosition( // equal to position3
            ChessCoordinate::createFromLetter('c'),
            ChessCoordinate::createFromHumanReadableInt(3),
        );
        $treeNode6 = new TreeNode($treeNode5, $position6);

		$correctPath = [
            new ChessPosition(
                ChessCoordinate::createFromLetter('a'),
                ChessCoordinate::createFromHumanReadableInt(1),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('b'),
                ChessCoordinate::createFromHumanReadableInt(2),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('c'),
                ChessCoordinate::createFromHumanReadableInt(3),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('d'),
                ChessCoordinate::createFromHumanReadableInt(4),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('e'),
                ChessCoordinate::createFromHumanReadableInt(5),
            ),
        ];

		$testedPath = TreeToPathConverter::createPathFromTreeNodes($treeNode3, $treeNode6, false);

        Assert::equal(5, count($correctPath));
        Assert::true($testedPath[0]->equals($testedPath[0]));
        Assert::true($testedPath[1]->equals($testedPath[1]));
        Assert::true($testedPath[2]->equals($testedPath[2]));
        Assert::true($testedPath[3]->equals($testedPath[3]));
        Assert::true($testedPath[4]->equals($testedPath[4]));
	}

    /**
     * @covers ::createPathFromTreeNodes
     */
	public function testCreatePathFromTreeNodesReversed()
	{
		$position1 = new ChessPosition(
		    ChessCoordinate::createFromLetter('a'),
            ChessCoordinate::createFromHumanReadableInt(1),
        );
		$treeNode1 = new TreeNode(null, $position1); // root of tree 1

		$position2 = new ChessPosition(
		    ChessCoordinate::createFromLetter('b'),
            ChessCoordinate::createFromHumanReadableInt(2),
        );
        $treeNode2 = new TreeNode($treeNode1, $position2);

		$position3 = new ChessPosition(
		    ChessCoordinate::createFromLetter('c'),
            ChessCoordinate::createFromHumanReadableInt(3),
        );
        $treeNode3 = new TreeNode($treeNode2, $position3);

		$position4 = new ChessPosition(
		    ChessCoordinate::createFromLetter('e'),
            ChessCoordinate::createFromHumanReadableInt(5),
        );
        $treeNode4 = new TreeNode(null, $position4); // root of tree 2

        $position5 = new ChessPosition(
		    ChessCoordinate::createFromLetter('d'),
            ChessCoordinate::createFromHumanReadableInt(4),
        );
        $treeNode5 = new TreeNode($treeNode4, $position5);

        $position6 = new ChessPosition( // equal to position3
            ChessCoordinate::createFromLetter('c'),
            ChessCoordinate::createFromHumanReadableInt(3),
        );
        $treeNode6 = new TreeNode($treeNode5, $position6);

		$correctPath = [
            new ChessPosition(
                ChessCoordinate::createFromLetter('a'),
                ChessCoordinate::createFromHumanReadableInt(1),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('b'),
                ChessCoordinate::createFromHumanReadableInt(2),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('c'),
                ChessCoordinate::createFromHumanReadableInt(3),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('d'),
                ChessCoordinate::createFromHumanReadableInt(4),
            ),
            new ChessPosition(
                ChessCoordinate::createFromLetter('e'),
                ChessCoordinate::createFromHumanReadableInt(5),
            ),
        ];

		$testedPath = TreeToPathConverter::createPathFromTreeNodes($treeNode6, $treeNode3, true); // reversed order of nodes

        Assert::equal(5, count($correctPath));
        Assert::true($testedPath[0]->equals($testedPath[0]));
        Assert::true($testedPath[1]->equals($testedPath[1]));
        Assert::true($testedPath[2]->equals($testedPath[2]));
        Assert::true($testedPath[3]->equals($testedPath[3]));
        Assert::true($testedPath[4]->equals($testedPath[4]));
	}
}

$test = new TreeToPathConverterTest;
$test->run();
