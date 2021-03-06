<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class BinarySearch
{
    private Node $root;

    public function add(?Node $parent, string $value, bool $answer)
    {
        $this->root = $this->changeStructure($parent, $value, $answer);
    }

    public function changeStructure(?Node $parent, string $value, bool $answer): Node
    {
        if ($parent === null) {
            return new Node($value);
        }

        if ($answer) {
            $parent->setRightChild($this->changeStructure($parent->getRightChild(), $value, $answer));
        }

        if (!$answer) {
            $parent->setLeftChild($this->changeStructure($parent->getLeftChild(), $value, $answer));
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