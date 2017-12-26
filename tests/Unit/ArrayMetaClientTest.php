<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Test\Unit;

use BackEndTea\ArrayMeta\ArrayMetaClient;
use BackEndTea\ArrayMeta\Exception\InvalidArgument\WrongTypeException;
use InvalidArgumentException;

class ArrayMetaClientTest extends \PHPUnit\Framework\TestCase
{
    public function testFillThrowsErrorWhenNumIsBelowZero()
    {
        $this->expectException(InvalidArgumentException::class);

        ArrayMetaClient::fill(0, -1, '');
    }

    public function testFillReturnsAnArrayMetaFilledWithTheCorrectValues()
    {
        $meta = ArrayMetaClient::fill(0, 5, 'Hello');

        $this->assertCount(5, $meta);
        foreach ($meta as $m) {
            $this->assertSame('Hello', $m);
        }
    }

    public function testFillReturnsAnEmptyArrayMetaWhenNumIsZero()
    {
        $meta = ArrayMetaClient::fill(0, 0, 'Hello');

        $this->assertEmpty($meta);
    }

    public function testFillBuildsAnArrayMetaStartingAtTheCorrectKey()
    {
        $meta = ArrayMetaClient::fill(10, 3, 'Hello');
        for ($i = 0; $i < 10; ++$i) {
            $this->assertFalse(isset($meta[$i]));
        }
        $this->assertSame('Hello', $meta[10]);
        $this->assertSame('Hello', $meta[11]);
        $this->assertSame('Hello', $meta[12]);
        $this->assertFalse(isset($meta[13]));
    }

    /**
     * @param $key
     *
     * @dataProvider provideInvalidKeys
     */
    public function testFillWithKeysWillThrowErrorIfKeysAreInvalid($key)
    {
        $this->expectException(WrongTypeException::class);

        ArrayMetaClient::fillWithKeys($key, 'value');
    }

    public function provideInvalidKeys(): array
    {
        return [
            [new \stdClass()],
            [5.6],
            [null],
        ];
    }

    public function testFillWithKeysFillsAnArrayMetaWithTheKeyValueCombination()
    {
        $meta = ArrayMetaClient::fillWithKeys(0, 'value');

        $this->assertSame('value', $meta[0]);

        //Other keys should not be set so we check a few
        $this->assertFalse(isset($meta[1]));
        $this->assertFalse(isset($meta[-1]));
        $this->assertFalse(isset($meta[2]));
        $this->assertFalse(isset($meta[10]));
    }

    public function testFillWithKeysFillsAnArrayMetaWithTheKeyValueCombinationWhenKeyIsAString()
    {
        $meta = ArrayMetaClient::fillWithKeys('haha', 'value');

        $this->assertSame('value', $meta['haha']);

        //Other keys should not be set so we check a few
        $this->assertFalse(isset($meta[0]));
        $this->assertFalse(isset($meta[1]));
        $this->assertFalse(isset($meta[-1]));
        $this->assertFalse(isset($meta[2]));
        $this->assertFalse(isset($meta[10]));
    }

    public function testFillWithKeysWorksWhenSuppliedWithAnArrayOfKeys()
    {
        $arrayOfKeys = ['key', 'another key', 1,2,3,4,5];
        $meta = ArrayMetaClient::fillWithKeys($arrayOfKeys, 'hello');
        foreach ($arrayOfKeys as $key) {
            $this->assertSame('hello', $meta[$key]);
        }
    }

    public function testFillWithKeysThrowsTheCorrectErrorWhenArrayOfKeysHasAnInvalidVAlue()
    {
        $arrayOfKeys = ['key', new \stdClass(), 1,2,3,4,5];

        $this->expectException(InvalidArgumentException::class);

        ArrayMetaClient::fillWithKeys($arrayOfKeys, 'hello');
    }

    public function testRangeCanProduceARangeOfOneToTen()
    {
        $meta = ArrayMetaClient::range(1, 10);

        $this->assertCount(10, $meta);

        $this->assertSame(1, $meta[0]);
        $this->assertSame(2, $meta[1]);
        $this->assertSame(3, $meta[2]);
        $this->assertSame(4, $meta[3]);
        $this->assertSame(5, $meta[4]);
        $this->assertSame(6, $meta[5]);
        $this->assertSame(7, $meta[6]);
        $this->assertSame(8, $meta[7]);
        $this->assertSame(9, $meta[8]);
        $this->assertSame(10, $meta[9]);
    }

    public function testRangeThrowsInvalidArgumentErrorWhenStepIsNotNumeric()
    {
        $this->expectException(WrongTypeException::class);

        ArrayMetaClient::range(1, 10, 'b');
    }

    public function testRangeDoesTheCorrectSteps()
    {
        $meta = ArrayMetaClient::range(1, 10, 2);

        $this->assertCount(5, $meta);

        $this->assertSame(1, $meta[0]);
        $this->assertSame(3, $meta[1]);
        $this->assertSame(5, $meta[2]);
        $this->assertSame(7, $meta[3]);
        $this->assertSame(9, $meta[4]);
    }

    public function testRangeCanProduceARangeOfLetters()
    {
        $meta = ArrayMetaClient::range('a', 'z');

        $this->assertCount(26, $meta);
    }

    public function testRangeThrowsExceptionWhenStepIsZero()
    {
        $this->expectException(InvalidArgumentException::class);

        ArrayMetaClient::range(1, 10, 0);
    }

    public function testRangeThrowsExceptionWhenStepIsStringZero()
    {
        $this->expectException(InvalidArgumentException::class);

        ArrayMetaClient::range(1, 10, '0');
    }
}
