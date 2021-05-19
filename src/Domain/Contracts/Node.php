<?php

namespace App\Domain\Contracts;

interface Node
{
    public function isLeaf(): bool;

    public function getValue(): string;

    public function setValue(string $value): void;

    public function getLeftChild(): ?Node;

    public function setLeftChild(?Node $leftChild): void;

    public function getRightChild(): ?Node;

    public function setRightChild(?Node $rightChild): void;
}