<?php

namespace Agilicode\PhpUnitTestFactory;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use RuntimeException;

interface TestMockFactoryInterface
{
    /**
     * @throws ReflectionException
     */
    public static function create(string $className, array $arguments = [], ?TestCase $testCase = null, $byPassFinal = false): TestMockFactory;
    /**
     * @throws ReflectionException
     * @throws RuntimeException
     *
     */
    public function getObject(): MockObject;

}
