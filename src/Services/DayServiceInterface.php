<?php

namespace Console\Services;

use Symfony\Component\Console\Output\OutputInterface;

interface DayServiceInterface
{
    public function execute(OutputInterface $output): int;
}