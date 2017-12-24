<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Test\Exception;

use BackEndTea\ArrayMeta\Exception\ValueNotFoundException;

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
}
