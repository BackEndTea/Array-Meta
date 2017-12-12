<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;

final class ArrayMeta implements
    ArrayAccess,
    Countable,
    IteratorAggregate
{
    /**
     * @var array
     */
    private $items;

    public function __construct($items = [])
    {
        if (!\is_array($items)) {
            $items = [$items];
        }
        $this->items = $items;
    }

    //region Array functions
    public function offsetExists($key): bool
    {
        return isset($this->items[$key]);
    }

    public function offsetGet($key)
    {
        return $this->items[$key];
    }

    public function offsetSet($key, $value)
    {
        if (\is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    public function offsetUnset($key)
    {
        unset($this->items[$key]);
    }

    public function count(): int
    {
        return \count($this->items);
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function toArray(): array
    {
        return $this->items;
    }

    //endregion
}
