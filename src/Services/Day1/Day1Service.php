<?php

namespace Console\Services\Day1;

use Console\Services\AbstractDayService;
use Console\Services\DayServiceInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Day1Service extends AbstractDayService implements DayServiceInterface
{
    private array $integerStrings = [
        1 => 'one',
        2 => 'two',
        3 => 'three',
        4 => 'four',
        5 => 'five',
        6 => 'six',
        7 => 'seven',
        8 => 'eight',
        9 => 'nine',
    ];

    protected function getInputsFiles(): void
    {
        $data = file_get_contents('inputsData/01InputsData.txt');
        $this->setInputsValues(explode("\n", $data));

        $calibrationData = file_get_contents('inputsData/01CalibrationValuesInputsData.txt');
        $this->setCalibrationInputsValues(explode("\n", $calibrationData));
    }

    public function execute(OutputInterface $output): int
    {
        $numbers = $this->getNumbersFromInputs();
        $output->writeln('1. solving the puzzle is:' . array_sum($numbers));
        $numbers2 = $this->getNumbersFromInputsString();
        $output->writeln('2. solving the puzzle is:' . array_sum($numbers2));

        return 0;
    }

    private function getNumbersFromInputs(): array
    {
        $inputs = $this->getInputsValues();
        $numbers = $this->removeLetters($inputs);
        $this->extractNumbers($numbers);

        return $numbers;
    }

    private function removeLetters(array $inputsWithLetters): array
    {
        return array_map(
            fn($value): int => preg_replace("/[^0-9]/", '', $value),
            $inputsWithLetters
        );
    }

    private function extractNumbers(array &$numbers): void
    {
        foreach ($numbers as $key => $number) {
            $replaceValue = null;
            $numberLen = strlen($number);

            if (1 == $numberLen) {
                $replaceValue = $number . $number;
            } if ($numberLen > 2) {
                $firstNumber = substr($number, 0, 1);
                $lastNumber = substr($number, -1);
                $replaceValue = $firstNumber . $lastNumber;
            }

            if (!empty($replaceValue)) {
                $numbers[$key] = (int) $replaceValue;
            }
        }
    }

    private function getNumbersFromInputsString(): array
    {
        $inputs = $this->getInputsValues();
        $integerStrings = $this->integerStrings;

        foreach ($inputs as $key => $input) {
            $numbersFromString = [];

            foreach (str_split($input) as $offset => $char) {
                if (is_numeric($char)) {
                    $numbersFromString[$offset] = (int) $char;
                }
            }

            foreach ($integerStrings as $integer => $string) {
                $lengthOfInputString = strlen($input);
                $lengthOfNumberString = strlen($string);
                $iterationMaxNumber = $lengthOfInputString - $lengthOfNumberString;

                for ($i = 0; $i <= $iterationMaxNumber; $i++) {
                    $searchedResult = substr($input, $i, $lengthOfNumberString);

                    if ($searchedResult == $string) {
                        $numbersFromString[$i] = $integer;
                    }
                }
            }

            ksort($numbersFromString);
            $inputs[$key] = implode('', $numbersFromString);
        }

        $numbers = $this->removeLetters($inputs);
        $this->extractNumbers($numbers);

        return $numbers;
    }
}