<?php
namespace Console;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

abstract class AbstractCommand extends SymfonyCommand
{
    protected function displayNoteBeforeExecute(InputInterface $input, OutputInterface $output): void
    {
        $output->writeln([
            '====**** AOC 2023 ****====',
            '==========================================',
            '',
        ]);
    }
}