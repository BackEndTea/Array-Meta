<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta;

use BackEndTea\ArrayMeta\Exception\InvalidArgument\WrongTypeException;
use InvalidArgumentException;

class ArrayMetaClient
{
    /**
     * @see http://php.net/manual/en/function.array-fill.php
     *
     * @param int   $startIndex
     * @param int   $num
     * @param mixed $value
     *
     * @return ArrayMeta
     */
    public static function fill(int $startIndex, int $num, $value): ArrayMeta
    {
        if ($num < 0) {
            throw new InvalidArgumentException();
        }
        return new ArrayMeta(\array_fill($startIndex, $num, $value));
    }

    /**
     * @see http://php.net/manual/en/function.array-fill-keys.php
     *
     * @param array|int|string $keys
     * @param mixed            $value
     *
     * @throws WrongTypeException
     * @throws InvalidArgumentException
     *
     * @return ArrayMeta
     */
    public static function fillWithKeys($keys, $value): ArrayMeta
    {
        if (\is_string($keys) || \is_int($keys)) {
            $keys = [$keys];
        }
        if (!\is_array($keys)) {
            throw  WrongTypeException::fromType($keys, ['string', 'integer', 'array']);
        }
        try {
            return new ArrayMeta(\array_fill_keys($keys, $value));
        } catch (\Throwable $e) {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @param mixed          $start
     * @param mixed          $end
     * @param null|float|int $step
     *
     * @throws WrongTypeException
     * @throws InvalidArgumentException
     *
     * @return ArrayMeta
     */
    public static function range($start, $end, $step = 1)
    {
        if (!\is_numeric($step)) {
            throw WrongTypeException::fromType($step, ['integer', 'double']);
        }
        if ($step == 0) {
            throw new InvalidArgumentException();
        }
        return new ArrayMeta(\range($start, $end, $step));
    }
}
