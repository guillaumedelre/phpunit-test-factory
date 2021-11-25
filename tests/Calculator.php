<?php

namespace Tests\Agilicode\PhpUnitTestFactory;

final class Calculator implements CalculatorInterface
{
    use SumTrait;

    private int $firstValue;
    private int $secondValue;

    public function __construct(int $firstValue, int $secondValue)
    {
        $this->firstValue = $firstValue;
        $this->secondValue = $secondValue;
    }
}
