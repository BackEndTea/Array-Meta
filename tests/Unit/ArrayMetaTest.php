<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Test\Unit;

use BackEndTea\ArrayMeta\ArrayMeta;
use OutOfBoundsException;

/**
 * @covers \BackEndTea\ArrayMeta\ArrayMeta
 */
final class ArrayMetaTest extends \PHPUnit\Framework\TestCase
{
    //region Array Aliases
    public function testHasReturnsTrueIfKeyExists()
    {
        $array = ['key' => 'value'];
        $meta = new ArrayMeta($array);

        $this->assertTrue($meta->has('key'));
    }

    public function testHasReturnsFalseIfKeyDoesNotExists()
    {
        $array = ['key' => 'value'];
        $meta = new ArrayMeta($array);

        $this->assertFalse($meta->has('bread'));
    }

    public function testGetReturnsValueOfKey()
    {
        $array = ['key' => 'value'];
        $meta = new ArrayMeta($array);

        $this->assertSame('value', $meta->get('key'));
    }

    public function testGetThrowsOutOfBoundExceptionIfKeyDoesNotExist()
    {
        $array = ['key' => 'value'];
        $meta = new ArrayMeta($array);

        $this->expectException(OutOfBoundsException::class);

        $meta->get('bread');
    }

    public function testSetWillAddNewValueToEndIfKeyIsNotSupplied()
    {
        $meta = new ArrayMeta();
        $meta->set('value');

        $this->assertSame('value', $meta[0]);
    }

    public function testSetWillSetKeyValueCombination()
    {
        $meta = new ArrayMeta();
        $meta->set('key', 'value');

        $this->assertSame('value', $meta['key']);
    }

    public function testSetWillAddNewValueToEndIfKeyIsNull()
    {
        $meta = new ArrayMeta();
        $meta->set(null, 'value');

        $this->assertSame('value', $meta[0]);
    }

    public function testRemoveRemovesKeyFromArray()
    {
        $array = ['key' => 'value', 'key2' => 'value2'];
        $meta = new ArrayMeta($array);

        $this->assertSame('value', $meta['key']);
        $this->assertSame('value2', $meta['key2']);

        $meta->remove('key');

        $this->assertSame('value2', $meta['key2']);
        $this->assertFalse(isset($meta['key']));
    }

    //endregion
}
