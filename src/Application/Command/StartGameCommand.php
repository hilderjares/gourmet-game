<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Infrastructure\Responder\ConsoleResponder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StartGameCommand extends Command
{
    private ConsoleResponder $responder;

    public function __construct(ConsoleResponder $responder)
    {
        parent::__construct();

        $this->responder = $responder;
    }

    protected function configure()
    {
        $this->setName('game:start')
            ->setAliases(['g:s'])
            ->setDescription('This command run the gourmet game');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->responder->__invoke($input, $output);

        return Command::SUCCESS;
    }
}