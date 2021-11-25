<?php

namespace Tests\Agilicode\PhpUnitTestFactory;

use Agilicode\PhpUnitTestFactory\TestMockFactory;
use Agilicode\PhpUnitTestFactory\TestMockFactoryInterface;
use PHPUnit\Framework\TestCase;

class TestMockFactoryTest extends TestCase
{
    /**
     * @covers \Agilicode\PhpUnitTestFactory\TestMockFactory
     */
    public function testCreateClassMock()
    {
        $mockFactory = TestMockFactory::create(Calculator::class, [1, 1], $this, true);
        $mock = $mockFactory->getObject();
        $this->assertInstanceOf(TestMockFactoryInterface::class, $mockFactory);
        $this->assertInstanceOf(Calculator::class, $mock);
    }

    /**
     * @covers \Agilicode\PhpUnitTestFactory\TestMockFactory
     */
    public function testCreateInterfaceMock()
    {
        $mockFactory = TestMockFactory::create(CalculatorInterface::class, [1, 1], $this);
        $mock = $mockFactory->getObject();
        $this->assertInstanceOf(TestMockFactoryInterface::class, $mockFactory);
        $this->assertInstanceOf(CalculatorInterface::class, $mock);
    }

    /**
     * @covers \Agilicode\PhpUnitTestFactory\TestMockFactory
     */
    public function testCreateTraitMock()
    {
        $mockFactory = TestMockFactory::create(SumTrait::class, [], $this);
        $mock = $mockFactory->getObject();
        $this->assertEquals('hello', $mock->sayHello());
    }

    /**
     * @covers \Agilicode\PhpUnitTestFactory\TestMockFactory
     */
    public function testCreateWillThrowsReflectionException()
    {
        $this->expectException(\ReflectionException::class);
        $this->expectExceptionCode(-1);
        $this->expectExceptionMessage('Class className does not exist');
        TestMockFactory::create('className', [], $this);
    }
}
