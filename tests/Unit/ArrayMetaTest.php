<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Test\Unit;

use BackEndTea\ArrayMeta\ArrayMeta;

/**
 * @covers \BackEndTea\ArrayMeta\ArrayMeta
 */
final class ArrayMetaTest extends \PHPUnit\Framework\TestCase
{
    //region Works as an array
    public function testItCanBeAccessedAsAnArray()
    {
        $array = ['a', 'b', 'c'];
        $meta = new ArrayMeta($array);

        $this->assertSame('a', $meta[0]);
    }

    public function testItIsAnEmptyArrayWhenEmptyConstructor()
    {
        $meta = new ArrayMeta();
        $this->assertEmpty($meta);
        $this->assertFalse(isset($meta[0]));
    }

    public function testItConvertsInputToArray()
    {
        $meta = new ArrayMeta('hello');

        $this->assertSame('hello', $meta[0]);
    }

    public function testItCanBeCheckedWithIsset()
    {
        $array = ['a', 'b', 'c', 'key' => 'value'];
        $meta = new ArrayMeta($array);

        $this->assertTrue(isset($meta[0]));
        $this->assertTrue(isset($meta['key']));
        $this->assertFalse(isset($meta[3]));
    }

    public function testItKeepsKeys()
    {
        $array = ['key' => 'value', 3 => 8, 'next' => 'next'];
        $meta = new ArrayMeta($array);

        $this->assertSame('value', $meta['key']);
        $this->assertSame(8, $meta[3]);
        $this->assertSame('next', $meta['next']);
    }

    public function testKeysCanBeAdded()
    {
        $array = ['key' => 'value'];
        $meta = new ArrayMeta($array);
        $meta['key2'] = 'value2';

        $this->assertSame('value', $meta['key']);
        $this->assertSame('value2', $meta['key2']);
    }

    public function testMoreValuesCanBeAddedWithoutKeys()
    {
        $array = ['a', 'b', 'c'];
        $meta = new ArrayMeta($array);
        $meta[] = 'q';

        $this->assertSame('q', $meta[3]);
    }

    public function testKeysCanBeRemovedWithUnset()
    {
        $array = ['key' => 'value', 'key2' => 'value2'];
        $meta = new ArrayMeta($array);

        $this->assertSame('value', $meta['key']);
        $this->assertSame('value2', $meta['key2']);

        unset($meta['key']);

        $this->assertSame('value2', $meta['key2']);
        $this->assertFalse(isset($meta['key']));
    }

    public function testItCanBeCounted()
    {
        $array = ['a', 'b', 'c'];
        $meta = new ArrayMeta($array);

        $this->assertCount(3, $meta);
    }

    public function testCountCanBeCalled()
    {
        $array = ['a', 'b', 'c'];
        $meta = new ArrayMeta($array);

        $this->assertSame(3, $meta->count());
    }

    public function testItCanBeCountedWithKeys()
    {
        $array = ['key' => 'value', 'key2' => 'value2'];
        $meta = new ArrayMeta($array);

        $this->assertCount(2, $meta);
    }

    public function testItCanBeUsedInAForEach()
    {
        $array = ['key' => 'value', 'key2' => 'value2'];
        $meta = new ArrayMeta($array);

        foreach ($meta as $key => $value) {
            $this->assertSame($meta[$key], $value);
        }
    }

    public function testToArrayReturnsInputArray()
    {
        $array = ['a', 'b', 'c'];
        $meta = new ArrayMeta($array);

        $this->assertSame($array, $meta->toArray());
    }

    public function testGetToArrayKeepsKeys()
    {
        $array = ['key' => 'value', 'key2' => 'value2'];
        $meta = new ArrayMeta($array);

        $this->assertSame($array, $meta->toArray());
    }

    //endregion
}
