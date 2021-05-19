<?php

declare(strict_types=1);

namespace App\Infrastructure\Responder;

use App\Domain\Entity\BinarySearch;
use App\Domain\Entity\Node;
use App\Infrastructure\Service\NodeService;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;
use Symfony\Component\Console\Question\Question;

class GameConsoleResponder implements ConsoleResponder
{
    private const YES = "SIM";

    private const NO = "NÃO";

    private const ASSERT_SIZE = 1;

    private int $assert = 0;

    private QuestionHelper $helper;

    private BinarySearch $binarySearch;

    private NodeService $nodeService;

    public function __construct(
        QuestionHelper $helper,
        BinarySearch $binarySearch,
        NodeService $nodeService
    ) {
        $this->helper = $helper;
        $this->binarySearch = $binarySearch;
        $this->nodeService = $nodeService;

        $this->binarySearch->add(null, "Massa", true);
        $this->binarySearch->add($this->binarySearch->root(), "Lasanha", true);
        $this->binarySearch->add($this->binarySearch->root(), "Bolo de Chocolate", false);
    }

    protected function changeAssertion(): void
    {
        $this->assert += self::ASSERT_SIZE;
    }

    protected function askIfCorrectFood(Node $node, InputInterface $input, OutputInterface $output): string
    {
        $question = new ChoiceQuestion("O parato que você pensou é {$node->getValue()} ?", ['SIM', 'NÃO']);
        $question->setErrorMessage('Resposta Inválida');

        return $this->helper->ask($input, $output, $question);
    }

    protected function askForNewFood(Node $node, InputInterface $input, OutputInterface $output): void
    {
        $questionFoodName = new Question("Qual prato voce pensou ? ");
        $foodName = $this->helper->ask($input, $output, $questionFoodName);

        $questionAttributeName = new Question("{$foodName} é ___, mas {$node->getValue()} ? ");
        $attributeName = $this->helper->ask($input, $output, $questionAttributeName);

        $this->nodeService->create($node, $attributeName, $foodName);
        $this->bootGame($input, $output);
    }

    protected function wins(InputInterface $input, OutputInterface $output): void
    {
        $this->changeAssertion();
        $output->writeln("Eba! acertei {$this->assert}");
        $this->bootGame($input, $output);
    }

    protected function findCorrectAnswer(Node $node, InputInterface $input, OutputInterface $output): void
    {
        $answer = $this->askIfCorrectFood($node, $input, $output);

        if (self::YES === $answer) {
            if ($node->isLeaf()) {
                $this->wins($input, $output);
            }

            if (!$node->isLeaf()) {
                $this->findCorrectAnswer($node->getRightChild(), $input, $output);
            }
        }

        if (self::NO === $answer) {
            if (null === $node->getRightChild()) {
                $this->askForNewFood($node, $input, $output);
            }

            if (null !== $node->getRightChild()) {
                $this->findCorrectAnswer($node->getLeftChild(), $input, $output);
            }
        }
    }

    protected function bootGame(InputInterface $input, OutputInterface $output): void
    {
        while (true) {
            $this->findCorrectAnswer($this->binarySearch->root(), $input, $output);
        }
    }

    public function __invoke(InputInterface $input, OutputInterface $output)
    {
        $this->bootGame($input, $output);
    }
}
