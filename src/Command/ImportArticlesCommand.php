<?php

namespace App\Command;

use App\Contract\ImporterInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

#[AsCommand(
    name: 'app:import-articles',
    description: 'Imports articles.',
    hidden: false,
)]
class ImportArticlesCommand extends Command
{
    public function __construct(private readonly ImporterInterface $importer)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command allows you to import articles...')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Importing articles');

        $this->importer->importArticles();

        $output->writeln('Import done!');

        return Command::SUCCESS;
    }
}