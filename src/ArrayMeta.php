<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use OutOfBoundsException;

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
        return $this->has($key);
    }

    /**
     * @throws OutOfBoundsException
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    public function offsetSet($key, $value)
    {
        $this->set($key, $value);
    }

    public function offsetUnset($key)
    {
        $this->remove($key);
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

    //region Array Aliases

    public function has($key): bool
    {
        return isset($this->items[$key]);
    }

    /**
     * @throws OutOfBoundsException
     */
    public function get($key)
    {
        if (!$this->has($key)) {
            throw new OutOfBoundsException();
        }
        return $this->items[$key];
    }

    public function set($key, $value = null)
    {
        if (\func_num_args() === 1) {
            $value = $key;
            $key = null;
        }
        if (\is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    public function remove($key)
    {
        unset($this->items[$key]);
    }

    //endregion

    //region Array key functions

    /**
     * Returns a new instance with the array keys changed to upper or lower case
     *
     * @param int $case CASE_LOWER (default)or CASE_UPPER
     *
     * @return ArrayMeta
     */
    public function changeKeyCase(int $case = CASE_LOWER): self
    {
        return new self(\array_change_key_case($this->items, $case));
    }

    //endregion
}
