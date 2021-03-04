<?php
declare(strict_types=1);

namespace Chikeet\HorsePath\Utils;

use Chikeet\HorsePath\Model\TreeNode;
use Chikeet\HorsePath\Model\ValueObjects\ChessPosition;

use function array_merge;
use function array_reverse;
use function array_shift;

class TreeToPathConverter
{
    /**
     * Converts two tree nodes to resulting path represented by an array of @see ChessPosition instances.
     * @param TreeNode $startTreeNode
     * @param TreeNode $endTreeNode
     * @param bool $reversePath
     * @return array<int, ChessPosition>
     */
    public static function createPathFromTreeNodes(TreeNode $startTreeNode, TreeNode $endTreeNode, bool $reversePath): array
    {
        $startPositions = self::getPositionsFromTreeNodePath($startTreeNode);
        $reversedStartPositions = array_reverse($startPositions); // since start tree goes from matching position to start and therefore positions in it are in reversed order

        $endPositions = self::getPositionsFromTreeNodePath($endTreeNode);
        array_shift($endPositions); // remove first position since it's included in startPositions as well

        $path = array_merge($reversedStartPositions, $endPositions);

        return $reversePath ? array_reverse($path) : $path;
    }

    /**
     * Converts single tree node path to array of @see ChessPosition instances.
     * @param TreeNode $node
     * @return array<int, ChessPosition>
     */
    private static function getPositionsFromTreeNodePath(TreeNode $node): array
    {
        $positions = [];

        while ($node instanceof TreeNode) {
            $positions[] = $node->getPayload();
            $node = $node->getParent();
        }

        return $positions;
    }
}
