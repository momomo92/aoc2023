<?php

namespace Console;

use Console\Services\Day1\Day1Service;
use Console\Services\DayServiceInterface;
use Symfony\Component\Console\Exception\LogicException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class AocCommand extends AbstractCommand
{
    private const DAY_NUMBER_INPUT_KEY = 'dayNumber';
    public function configure(): void
    {
        $this -> setName('aoc2023')
            -> setDescription('Comand to resolved AOC2023 riddles')
            -> setHelp('This command allows you to resolved AOC2023 riddles')
            -> addArgument(
                self::DAY_NUMBER_INPUT_KEY,
                InputArgument::REQUIRED,
                'The day of the riddle'
            );
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->displayNoteBeforeExecute($input, $output);
        $dayNumber = (int) $input->getArgument(self::DAY_NUMBER_INPUT_KEY);
        $output->writeln("Selected Day:" . $dayNumber);

        $service = $this->buildDayService($dayNumber);
        $service->execute($output);

        return 0;
    }

    private function buildDayService(int $dayNumber): DayServiceInterface
    {
        if (1 == $dayNumber) {
            $service = new Day1Service();
        } else {
            throw new LogicException('Can`t find any services to selected day');
        }

        return $service;
    }
}