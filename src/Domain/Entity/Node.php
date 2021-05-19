<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\Contracts\Node as NodeInterface;

class Node implements NodeInterface
{
    private string $value;
    private ?NodeInterface $leftChild;
    private ?NodeInterface $rightChild;

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

    public function getLeftChild(): ?NodeInterface
    {
        return $this->leftChild;
    }

    public function setLeftChild(?NodeInterface $leftChild): void
    {
        $this->leftChild = $leftChild;
    }

    public function getRightChild(): ?NodeInterface
    {
        return $this->rightChild;
    }

    public function setRightChild(?NodeInterface $rightChild): void
    {
        $this->rightChild = $rightChild;
    }
}