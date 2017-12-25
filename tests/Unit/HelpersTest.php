<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Test\Unit;

use BackEndTea\ArrayMeta\Exception\IllegalKeyException;
use BackEndTea\ArrayMeta\Test\Fixture\KeyExceptionFixture;

class HelpersTest extends \PHPUnit\Framework\TestCase
{
    //region Array key checker

    /**
     * @param $key
     *
     * @dataProvider provideValidKeys
     */
    public function testIsValidArrayKeyReturnsTrueWhenSuppliedWithInteger($key)
    {
        $this->assertTrue(\isValidArrayKey($key));
    }

    /**
     * @param $key
     *
     * @dataProvider provideInvalidKeys
     */
    public function testIsValidArrayKeyReturnsFalseWhenSuppliedWithInvalidKey($key)
    {
        $this->assertFalse(\isValidArrayKey($key));
    }

    /**
     * @param $key
     *
     * @dataProvider provideValidKeys
     */
    public function testAssertValidArrayKeyDoesNothingIfSuppliedWithCorrectKey($key)
    {
        $this->assertNull(\assertValidArrayKey($key));
    }

    /**
     * @param $key
     *
     * @dataProvider provideInvalidKeys
     */
    public function testAssertValidArrayKeyThrowsCorrectErrorWhenSuppliedWithWrongKey($key)
    {
        $this->expectException(IllegalKeyException::class);

        \assertValidArrayKey($key);
    }

    public function provideValidKeys(): array
    {
        return [
            [0],
            [1],
            [10],
            [''],
            ['string'],
            [self::class],
        ];
    }

    public function provideInvalidKeys(): array
    {
        return [
            [new \stdClass()],
            [2.5],
            [new KeyExceptionFixture()],
            [array()],
            [null],
        ];
    }

    //endregion
}
