<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Exception\InvalidArgument;

final class WrongTypeException extends \InvalidArgumentException
{
    public static function fromType($item, $allowed): self
    {
        $type = \gettype($item);

        if (\is_object($item)) {
            $type = \get_class($item);
        }
        if (\is_array($allowed)) {
            $allowedTypes = '';
            foreach ($allowed as $a) {
                $allowedTypes .= ', ' .  $a;
            }
            $allowed = \substr($allowedTypes, 2);
        }
        return new self(
            \sprintf(
                'Only %s allowed, %s supplied.',
                $allowed,
                $type
            )
        );
    }
}
