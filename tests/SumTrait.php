<?php

namespace Tests\Agilicode\PhpUnitTestFactory;

trait SumTrait
{
    public function sayHello(): string
    {
        return 'hello';
    }

    public function sum(): int
    {
        return $this->firstValue + $this->secondValue;
    }
}
