<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Domain\Entity\Node;

class NodeService
{
    public function create(Node $node, string $property, string $food): void
    {
        $oldFood = $node->getValue();

        $node->setValue($property);
        $node->setLeftChild(new Node($oldFood));
        $node->setRightChild(new Node($food));
    }
}