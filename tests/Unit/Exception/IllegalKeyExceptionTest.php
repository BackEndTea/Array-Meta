<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Test\Exception;

use BackEndTea\ArrayMeta\Exception\IllegalKeyException;
use BackEndTea\ArrayMeta\Test\Fixture\KeyExceptionFixture;
use InvalidArgumentException;

/**
 * @covers \BackEndTea\ArrayMeta\Exception\IllegalKeyException
 */
class IllegalKeyExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testExtendsInvalidArgumentException()
    {
        $exception = new IllegalKeyException();

        $this->assertInstanceOf(InvalidArgumentException::class, $exception);
    }

    public function testItCorrectlyParsesType()
    {
        $exception = IllegalKeyException::wrongType(5.3);

        $this->assertSame(
            'Only strings or integers allowed as keys, double supplied',
            $exception->getMessage()
        );
    }

    public function testItCorrectlyParsesClassName()
    {
        $exception = IllegalKeyException::wrongType(new KeyExceptionFixture());

        $this->assertSame(
            'Only strings or integers allowed as keys, ' . KeyExceptionFixture::class . ' supplied',
            $exception->getMessage()
        );
    }
}
