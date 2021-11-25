<?php

namespace Agilicode\PhpUnitTestFactory;

use DG\BypassFinals;
use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionException;

class TestMockFactory implements TestMockFactoryInterface
{
    private string $className;
    private array $arguments;
    private ?TestCase $testCase;
    private \ReflectionClass $classReflection;
    private array $values = [];

    /**
     * @throws ReflectionException
     */
    private function __construct(string $className, array $arguments = [], ?TestCase $testCase = null)
    {
        $this->className       = $className;
        $this->arguments       = $arguments;
        $this->testCase        = $testCase;
        $this->classReflection = new \ReflectionClass($className);
    }

    /**
     * @throws ReflectionException
     */
    public static function create(string $className, array $arguments = [], ?TestCase $testCase = null, $byPassFinal = false): TestMockFactory
    {
        if ($byPassFinal) {
            BypassFinals::enable();
        }

        return new self($className, $arguments, $testCase);
    }

    /**
     * @throws ReflectionException
     */
    public function getObject(): MockObject
    {
        $mockBuilder = (new MockBuilder($this->testCase, $this->className))->disableOriginalConstructor();
        if ($this->isInterface()) {
            $mockBuilder->onlyMethods($this->getMethodsToBeStubbed());
        }
        if ($this->isAbstract()) {
            $mock = $mockBuilder->getMockForAbstractClass();
        } elseif ($this->isTrait()) {
            $mock = $mockBuilder->getMockForTrait();
        } else {
            $mock = $mockBuilder->getMock();
        }

        return $mock;
    }

    protected function isAbstract(): bool
    {
        return $this->classReflection->isAbstract();
    }

    protected function isTrait(): bool
    {
        return $this->classReflection->isTrait();
    }

    protected function isInterface(): bool
    {
        return $this->classReflection->isInterface();
    }

    protected function getMethods(?int $filter = null): array
    {
        return $this->classReflection->getMethods($filter);
    }

    protected function getMethodsToBeStubbed(): array
    {
        return array_map(function (\ReflectionMethod $method) {
            return $method->getName();
        }, $this->getMethods(\ReflectionMethod::IS_PUBLIC));
    }
}
