<?php
declare(strict_types=1);

namespace Chikeet\HorsePath;

use Chikeet\HorsePath\Model\TreeNode;

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

    public function addChildNode(TreeNode $child, TreeNode $parent)
    {
        if ($parent->isLeaf()) {
            $rawParentId = $parent->getId()->getRaw();
            unset($this->leaves[$rawParentId]);
        }

        $parent->addChild($child);
        if ($child->isLeaf()) {
            $rawChildId = $child->getId()->getRaw();
            $this->leaves[$rawChildId] = $child;
        }
    }

    public function getLeaves()
    {
        return $this->leaves;
    }
}
