<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Test\Exception\InvalidArgument;

use BackEndTea\ArrayMeta\Exception\InvalidArgument\WrongTypeException;

class WrongTypeExceptionTest extends \PHPUnit\Framework\TestCase
{
    public function testExtendsInvalidArgumentException()
    {
        $exception = new WrongTypeException();

        $this->assertInstanceOf(\InvalidArgumentException::class, $exception);
    }

    public function testWorksCorrectlyWithOneAllowedValue()
    {
        $exception = WrongTypeException::fromType(3, 'string');

        $this->assertSame('Only string allowed, integer supplied.', $exception->getMessage());
    }

    public function testWorksCorrectlyWhenMultipleTypesAllowed()
    {
        $exception = WrongTypeException::fromType(3, ['string', 'integer']);

        $this->assertSame('Only string, integer allowed, integer supplied.', $exception->getMessage());
    }
}
