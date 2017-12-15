<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Test\Unit;

use BackEndTea\ArrayMeta\ArrayMeta;
use BackEndTea\ArrayMeta\Exception\KeyNotFoundException;

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

    public function testGetThrowsKeyNotFoundExceptionIfKeyDoesNotExist()
    {
        $array = ['key' => 'value'];
        $meta = new ArrayMeta($array);

        $this->expectException(KeyNotFoundException::class);

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

    public function testChangeKeyCaseReturnsANewInstance()
    {
        $array = ['keY' => 'value', 'bLa' => 'value2'];
        $meta = new ArrayMeta($array);
        $new = $meta->changeKeyCase(CASE_LOWER);
        $this->assertInstanceOf(ArrayMeta::class, $new);
        $this->assertNotSame($meta, $new);
    }

    public function testChangeKeyCaseWithCaseLowerReturnsLowerCasedVersion()
    {
        $array = ['keY' => 'value', 'bLa' => 'value2'];
        $meta = new ArrayMeta($array);
        $meta = $meta->changeKeyCase(CASE_LOWER);

        $this->assertSame('value', $meta['key']);
        $this->assertSame('value2', $meta['bla']);
        $this->assertFalse(isset($meta['keY']));
    }

    public function testChangeKeyCaseWithCaseUpperReturnsLowerCasedVersion()
    {
        $array = ['keY' => 'value', 'bLa' => 'value2'];
        $meta = new ArrayMeta($array);
        $meta = $meta->changeKeyCase(CASE_UPPER);

        $this->assertSame('value', $meta['KEY']);
        $this->assertSame('value2', $meta['BLA']);
        $this->assertFalse(isset($meta['keY']));
    }

    public function testKeysReturnsTheKeys()
    {
        $array = ['key' => 'value', 'bla' => 'value2'];
        $meta = new ArrayMeta($array);
        $keys = $meta->keys();
        $this->assertSame('key', $keys[0]);
        $this->assertSame('bla', $keys[1]);
    }
}
