<?php
declare(strict_types=1);

namespace Chikeet\HorsePath;

use Chikeet\HorsePath\Model\TreeNode;
use Chikeet\HorsePath\Utils\ArrayValidator;
use Chikeet\HorsePath\Utils\HorseMovesFinder;
use Chikeet\HorsePath\Utils\TreeToPathConverter;
use Chikeet\HorsePath\Model\ValueObjects\ChessPosition;

class PathFinder
{

    /**
     * Method to find optimal chess horse path from start to end position.
     * @param ChessPosition $startPosition
     * @param ChessPosition $endPosition
     * @return array<int, ChessPosition>
     */
    public static function findShortestHorsePath(ChessPosition $startPosition, ChessPosition $endPosition): array
    {
        // return start position if start and end are the same
        if ($startPosition->equals($endPosition)) {
            return [$startPosition];
        }

        // init trees for star and end path
        $startTreeRoot = new TreeNode(null, $startPosition);
        $startTree = new Tree($startTreeRoot);

        $endTreeRoot = new TreeNode(null, $endPosition);
        $endTree = new Tree($endTreeRoot);

        while (!isset($horsePath)) {
            // find all possible next steps for start path and check if there is match with end path
            $horsePath = self::processPossibleNextMoves($startTree, $endTree, true);
            if ($horsePath !== null) {
                break;
            }
            // find all possible next steps for end path and check if there is match with start path
            $horsePath = self::processPossibleNextMoves($endTree, $startTree, false);
            if ($horsePath !== null) {
                break;
            }
        }
        return $horsePath;
    }

    /**
     * @param Tree $tree tree where new nodes are added
     * @param Tree $otherTree the other tree to compare for leaves position match
     * @param bool $isStartTree true if $tree is startTree (a tree with root on start position)
     * @return array|null
     */
    private static function processPossibleNextMoves(Tree $tree, Tree $otherTree, bool $isStartTree): ?array
    {
        foreach ($tree->getLeaves() as $leaf) {
            /** @var ChessPosition $currentPosition */
            $currentPosition = $leaf->getPayload();
            $newPositions = HorseMovesFinder::findAllowedPositions($currentPosition);

            foreach ($newPositions as $newPosition) {
                $newNode = new TreeNode($leaf, $newPosition);
                $tree->addChildNode($newNode, $leaf);

                $matchingOtherTreeLeaf = self::findMatchingTreeNodeInArray($newNode, $otherTree->getLeaves());
                if ($matchingOtherTreeLeaf instanceof TreeNode) {
                    $reversePath = !$isStartTree;
                    return TreeToPathConverter::createPathFromTreeNodes($newNode, $matchingOtherTreeLeaf, $reversePath);
                }
            }
        }
        return null;
    }

    /**
     * @param TreeNode $treeNode
     * @param array<string, TreeNode> $otherNodes
     * @return ?TreeNode
     */
    private static function findMatchingTreeNodeInArray(TreeNode $treeNode, array $otherNodes): ?TreeNode
    {
        ArrayValidator::validateEveryIsInstanceOf($otherNodes, TreeNode::class, 'otherNodes');

        /** @var ChessPosition $chessPosition */
        $chessPosition = $treeNode->getPayload();

        foreach ($otherNodes as $node) {
            /** @var ChessPosition $otherPosition */
            $otherPosition = $node->getPayload();
            if ($chessPosition->equals($otherPosition)) {
                return $node;
            }
        }
        return null;
    }
}
