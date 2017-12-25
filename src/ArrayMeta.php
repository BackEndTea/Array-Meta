<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta;

use ArrayAccess;
use ArrayIterator;
use BackEndTea\ArrayMeta\Exception\IllegalKeyException;
use BackEndTea\ArrayMeta\Exception\KeyNotFoundException;
use BackEndTea\ArrayMeta\Exception\ValueNotFoundException;
use Countable;
use IteratorAggregate;

class ArrayMeta implements
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

    /**
     * @param int|string $key
     *
     * @throws IllegalKeyException
     *
     * @return bool
     */
    public function offsetExists($key): bool
    {
        return $this->has($key);
    }

    /**
     * @param int|string $key
     *
     * @throws IllegalKeyException
     * @throws KeyNotFoundException
     *
     * @return mixed
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * @param null|int|string $key
     * @param mixed           $value
     *
     * @throws IllegalKeyException
     * @throws KeyNotFoundException
     */
    public function offsetSet($key, $value)
    {
        $this->set($key, $value);
    }

    /**
     * @param int|string $key
     *
     * @throws IllegalKeyException
     */
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

    /**
     * @param int|string $key
     *
     * @throws IllegalKeyException
     *
     * @return bool
     */
    public function has($key): bool
    {
        $this->assertKeyIsOfCorrectType($key);

        return isset($this->items[$key]);
    }

    /**
     * @param int|string $key
     *
     * @throws IllegalKeyException
     * @throws KeyNotFoundException
     *
     * @return mixed
     */
    public function get($key)
    {
        $this->assertKeyIsOfCorrectType($key);

        if (!$this->has($key)) {
            throw KeyNotFoundException::keyNotFound($key);
        }
        return $this->items[$key];
    }

    /**
     * If called with one argument it will assume that it is the value
     *
     * @param int|mixed|string $key
     * @param mixed            $value
     *
     * @throws IllegalKeyException
     */
    public function set($key, $value = null)
    {
        if (\func_num_args() === 1) {
            $value = $key;
            $key = null;
        }
        if (\is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->assertKeyIsOfCorrectType($key);

            $this->items[$key] = $value;
        }
    }

    /**
     * @param int|string $key
     *
     * @throws IllegalKeyException
     */
    public function remove($key)
    {
        $this->assertKeyIsOfCorrectType($key);

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

    public function keys(): self
    {
        return new self(\array_keys($this->items));
    }

    //endregion

    /**
     * @return mixed
     */
    public function pop()
    {
        return \array_pop($this->items);
    }

    public function flip(): self
    {
        return new self(\array_flip($this->items));
    }

    /**
     * @param mixed $value value to append
     *
     * @return int length of the new array
     *
     * @see http://php.net/manual/en/function.array-push.php
     */
    public function push($value): int
    {
        return \array_push($this->items, $value);
    }

    /**
     * Make a new array of all the unique values
     *
     * @param int $sort type of sorting to do, options are:
     *                  SORT_REGULAR - compare items normally (don't change types)
     *                  SORT_NUMERIC - compare items numerically
     *                  SORT_STRING - compare items as strings
     *                  SORT_LOCALE_STRING - compare items as strings, based on the current locale
     *
     * @see http://php.net/manual/en/function.array-unique.php
     *
     * @return self
     */
    public function unique($sort = SORT_STRING): self
    {
        return new self(\array_unique($this->items, $sort));
    }

    /**
     * Searches an a value and returns its key
     *
     * @param mixed $value  value to search for
     * @param bool  $strict whether to check type as well
     *
     * @throws ValueNotFoundException
     *
     * @return int|string key for the value
     */
    public function search($value, bool $strict = false)
    {
        if (($return =  \array_search($value, $this->items, $strict)) === false) {
            throw ValueNotFoundException::valueNotFound($value);
        }

        return $return;
    }

    /**
     * Searches for a value, and checks for type
     *
     * @param $value
     *
     * @throws ValueNotFoundException
     *
     * @return int|string
     *
     * @see search()
     */
    public function searchStrict($value)
    {
        return $this->search($value, true);
    }

    public function reverse(bool $preserveKeys = false): self
    {
        return new self(\array_reverse($this->items, $preserveKeys));
    }

    /**
     * @param mixed $key
     *
     * @throws IllegalKeyException
     */
    private function assertKeyIsOfCorrectType($key)
    {
        if (!\is_string($key) && !\is_int($key)) {
            throw IllegalKeyException::wrongType($key);
        }
    }
}
