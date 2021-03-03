<?php
declare(strict_types=1);

namespace Chikeet\HorsePath\Utils;

use Chikeet\HorsePath\Model\TreeNode;
use Chikeet\HorsePath\ValueObjects\ChessPosition;

use function array_merge;
use function array_reverse;

class TreeToPathConverter
{
    /**
     * @param TreeNode $startTreeNode
     * @param TreeNode $endTreeNode
     * @param bool $reversePath
     * @return array<int, ChessPosition>
     */
    public static function createPathFromTreeNodes(TreeNode $startTreeNode, TreeNode $endTreeNode, bool $reversePath): array
    {
        $startPositions = self::getPositionsFromTreeNodePath($startTreeNode);
        $endPositions = self::getPositionsFromTreeNodePath($endTreeNode);
        $reversedEndPositions = array_reverse($endPositions); // since end tree goes from end to start and therefore positions in it are in reversed order

        $path = array_merge($startPositions, $reversedEndPositions);

        return $reversePath ? array_reverse($path) : $path;
    }

    /**
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