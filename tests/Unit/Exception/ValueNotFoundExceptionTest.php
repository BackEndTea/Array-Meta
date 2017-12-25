<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Test\Exception;

use BackEndTea\ArrayMeta\Exception\ValueNotFoundException;
use BackEndTea\ArrayMeta\Test\Fixture\NoToString;
use BackEndTea\ArrayMeta\Test\Fixture\WithToString;

/**
 * @covers \BackEndTea\ArrayMeta\Exception\ValueNotFoundException
 */
class ValueNotFoundExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testIsInstanceOfRuntimeException()
    {
        $exception = new ValueNotFoundException();

        $this->assertInstanceOf(\RuntimeException::class, $exception);
    }

    public function testKeyNotFoundReturnsHasCorrectMessage()
    {
        $exception = ValueNotFoundException::valueNotFound('VALUE');

        $this->assertInstanceOf(ValueNotFoundException::class, $exception);
        $this->assertSame('Value "VALUE" not set.', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
    }

    public function testValueExceptionFormatsCorrectlyWhenEntryIsNotString()
    {
        $exception = ValueNotFoundException::valueNotFound([]);

        $this->assertSame('Value not set.', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
    }

    public function testValueExceptionWorksWithClassThatHasNoToString()
    {
        $exception = ValueNotFoundException::valueNotFound(new NoToString());

        $this->assertSame('Value not set.', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
    }

    public function testValueExceptionWorksWithClassThatHasToString()
    {
        $exception = ValueNotFoundException::valueNotFound(new WithToString());

        $this->assertSame('Value "Class with to String" not set.', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
    }

    public function testValueExceptionThrowsCorrectlyWithANumber()
    {
        $exception = ValueNotFoundException::valueNotFound(123);

        $this->assertInstanceOf(ValueNotFoundException::class, $exception);
        $this->assertSame('Value "123" not set.', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
    }
}
