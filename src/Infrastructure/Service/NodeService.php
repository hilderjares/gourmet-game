<?php

declare(strict_types=1);

namespace App\Infrastructure\Service;

use App\Domain\Entity\Node;

class NodeService
{
    public function create(Node $node, string $attribute, string $plate): void
    {
        $node->setValue($attribute);
        $node->setLeftChild(new Node($node->getValue()));
        $node->setRightChild(new Node($plate));
    }
}