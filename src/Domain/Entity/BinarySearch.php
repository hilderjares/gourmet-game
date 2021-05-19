<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Contracts\Node as NodeInterface;

class BinarySearch
{
    private NodeInterface  $root;

    public function add(?Node $parent, string $value, bool $answer)
    {
        $this->root = $this->changeStructure($parent, $value, $answer);
    }

    public function changeStructure(?Node $parent, string $value, bool $answer)
    {
        if ($parent === null) {
            return new Node($value);
        }

        if ($parent !== null) {
            if ($answer) {
                $parent->setRightChild($this->changeStructure($parent->getRightChild(), $value, $answer));
            }

            if (!$answer) {
                $parent->setLeftChild($this->changeStructure($parent->getLeftChild(), $value, $answer));
            }
        }

        return $parent;
    }

    public function root(): ?Node
    {
        return $this->root;
    }

    public function isEmpty(): bool
    {
        return $this->root == null;
    }
}