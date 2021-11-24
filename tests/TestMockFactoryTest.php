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
    public function testCreate()
    {
        $mockFactory = TestMockFactory::create(TestMockFactoryInterface::class, [], $this);
        $this->assertInstanceOf(TestMockFactoryInterface::class, $mockFactory);
        $this->assertInstanceOf(TestMockFactoryInterface::class, $mockFactory->getObject());
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
