<?php

declare(strict_types=1);

namespace App\Domain\Entity;

class Node
{
    private string $value;
    private ?Node $leftChild;
    private ?Node $rightChild;

    public function __construct(string $value)
    {
        $this->value = $value;
        $this->leftChild = null;
        $this->rightChild = null;
    }

    public function isLeaf(): bool
    {
        return $this->leftChild == null && $this->rightChild == null;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    public function getLeftChild(): ?Node
    {
        return $this->leftChild;
    }

    public function setLeftChild(?Node $leftChild): void
    {
        $this->leftChild = $leftChild;
    }

    public function getRightChild(): ?Node
    {
        return $this->rightChild;
    }

    public function setRightChild(?Node $rightChild): void
    {
        $this->rightChild = $rightChild;
    }
}