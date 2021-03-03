<?php
declare(strict_types=1);

namespace Chikeet\HorsePath;

use Chikeet\HorsePath\Model\TreeNode;
use Chikeet\HorsePath\Utils\ArrayValidator;
use Chikeet\HorsePath\Utils\HorseMovesFinder;
use Chikeet\HorsePath\Utils\TreeToPathConverter;
use Chikeet\HorsePath\ValueObjects\ChessPosition;

# TODO: add comments where needed
class PathFinder
{
    private const MAX_ITERATIONS = 10;

    /**
     * @param ChessPosition $start
     * @param ChessPosition $end
     * @return array<int, ChessPosition>
     */
    public function findShortestHorsePath(ChessPosition $start, ChessPosition $end): array
    {
        // return start position if start and end are the same
        if ($start->equals($end)) {
            return [$start];
        }

        // init trees for star and end path
        $startTreeRoot = new TreeNode(null, $start);
        $startTree = new Tree($startTreeRoot);

        $endTreeRoot = new TreeNode(null, $start);
        $endTree = new Tree($endTreeRoot);

        $iterations = 0; # TODO: remove after test that all paths are possible to find
        while (!isset($horsePath) && $iterations <= self::MAX_ITERATIONS) {
            // find all possible next steps for start path and check if there is match with end path
            $horsePath = $this->processPossibleNextMoves($startTree, $endTree, true);
            if ($horsePath !== null) {
                break;
            }
            // find all possible next steps for end path and check if there is match with start path
            $horsePath = $this->processPossibleNextMoves($endTree, $startTree, false);
            if ($horsePath !== null) {
                break;
            }
            $iterations++;
        }
        return $horsePath;
    }

    private function processPossibleNextMoves(Tree $tree, Tree $otherTree, bool $isStartTree): ?array
    {
        foreach ($tree->getLeaves() as $leaf) {
            /** @var ChessPosition $currentPosition */
            $currentPosition = $leaf->getPayload();
            $newPositions = HorseMovesFinder::findAllowedPositions($currentPosition);

            foreach ($newPositions as $newPosition) {
                $newNode = new TreeNode($leaf, $newPosition);
                $tree->addChildNode($newNode, $leaf);

                $matchingOtherTreeLeaf = $this->findMatchingTreeNodeInArray($newNode, $otherTree->getLeaves());
                if ($matchingOtherTreeLeaf instanceof TreeNode) {
                    return TreeToPathConverter::createPathFromTreeNodes($newNode, $matchingOtherTreeLeaf, $isStartTree);
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
    private function findMatchingTreeNodeInArray(TreeNode $treeNode, array $otherNodes): ?TreeNode
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
