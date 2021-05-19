<?php

use App\Domain\Entity\BinarySearch;
use App\Infrastructure\Responder\GameConsoleResponder;
use App\Infrastructure\Service\NodeService;
use Symfony\Component\Console\Helper\QuestionHelper;
use function DI\create;
use function DI\autowire;
use function DI\get;

return [
    GameConsoleResponder::class => create()->constructor(
        get(QuestionHelper::class), get(BinarySearch::class), get(NodeService::class)
    ),
];