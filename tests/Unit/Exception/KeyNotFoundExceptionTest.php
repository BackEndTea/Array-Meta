<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Test\Exception;

use BackEndTea\ArrayMeta\Exception\KeyNotFoundException;

/**
 * @covers \BackEndTea\ArrayMeta\Exception\KeyNotFoundException
 */
class KeyNotFoundExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testIsInstanceOfRuntimeException()
    {
        $exception = new KeyNotFoundException();

        $this->assertInstanceOf(\RuntimeException::class, $exception);
    }

    public function testKeyNotFoundReturnsHasCorrectMessage()
    {
        $exception = KeyNotFoundException::keyNotFound('KEY');

        $this->assertInstanceOf(KeyNotFoundException::class, $exception);
        $this->assertSame('Key "KEY" not set.', $exception->getMessage());
        $this->assertSame(0, $exception->getCode());
    }
}
