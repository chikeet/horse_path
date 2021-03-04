<?php
declare(strict_types=1);

namespace Chikeet\HorsePath\Model;

use Chikeet\HorsePath\Utils\UuidGenerator;
use Chikeet\HorsePath\ValueObjects\Uuid4;

class TreeNode
{
    /** @var Uuid4 unique id for easy leaves management within a tree */
    private Uuid4 $id;

    private ?TreeNode $parent;

    /** @var array<string, TreeNode> */
    private array $children = [];

    private object $payload;

    /**
     * TreeNode constructor.
     * @param TreeNode|null $parent parent node, null if current node is root or should be added as child to another node later
     * @param object $payload node payload - whatever you need
     */
    public function __construct(?TreeNode $parent, object $payload)
    {
        $this->generateId();
        $this->payload = $payload;

        if ($parent instanceof TreeNode) {
            $this->parent = $parent;
        }
    }

    public function addChild(TreeNode $child): void
    {
        $this->children[$child->getId()->getRaw()] = $child;
    }

    public function isLeaf(): bool
    {
        return $this->children === [];
    }

    public function getParent(): ?TreeNode
    {
        return $this->parent;
    }

    public function getId(): Uuid4
    {
        return $this->id;
    }

    public function getPayload(): object
    {
        return $this->payload;
    }

    private function generateId(): void
    {
        $rawUuid = UuidGenerator::generateUuid4();
        $this->id = new Uuid4($rawUuid);
    }
}
