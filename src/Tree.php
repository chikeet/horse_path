<?php
declare(strict_types=1);

namespace Chikeet\HorsePath;

use Chikeet\HorsePath\Model\TreeNode;

use function array_key_exists;

/**
 * Tree for easier work with nodes, e. g. access to leaves.
 */
class Tree
{
    /** @var array<int, TreeNode> */
    private array $leaves;

    private TreeNode $root;

    public function __construct(TreeNode $root)
    {
        $this->root = $root;
        $rawRootId = $root->getId()->getRaw();
        $this->leaves[$rawRootId] = $root;
    }

    /**
     * Adds child node to existing node and remove it from leaves.
     * @param TreeNode $child
     * @param TreeNode $parent
     */
    public function addChildNode(TreeNode $child, TreeNode $parent)
    {
        if ($parent->isLeaf()) {
            $rawParentId = $parent->getId()->getRaw();
            if (array_key_exists($rawParentId, $this->leaves)) {
                unset($this->leaves[$rawParentId]);
            }
        }

        $parent->addChild($child);
        if ($child->isLeaf()) {
            $rawChildId = $child->getId()->getRaw();
            $this->leaves[$rawChildId] = $child;
        }
    }

    /**
     * @return array<string, TreeNode>
     */
    public function getLeaves(): array
    {
        return $this->leaves;
    }
}
