<?php

namespace Console\Services;

abstract class AbstractDayService
{
    private string|array $inputsValues;
    private string|array $calibrationInputsValues;

    public function __construct()
    {
        $this->getInputsFiles();
    }

    abstract protected function getInputsFiles(): void;

    protected function getInputsValues(): array|string
    {
        return $this->inputsValues;
    }

    protected function setInputsValues(array|string $inputsValues): void
    {
        $this->inputsValues = $inputsValues;
    }

    protected function getCalibrationInputsValues(): array|string
    {
        return $this->calibrationInputsValues;
    }

    protected function setCalibrationInputsValues(array|string $calibrationInputsValues): void
    {
        $this->calibrationInputsValues = $calibrationInputsValues;
    }
}