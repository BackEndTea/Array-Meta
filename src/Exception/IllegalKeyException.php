<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Exception;

final class IllegalKeyException extends \InvalidArgumentException
{
    public static function wrongType($value): self
    {
        $type = \gettype($value);

        if (\is_object($value)) {
            $type = \get_class($value);
        }

        return new self(\sprintf(
            'Only strings or integers allowed as keys, %s supplied',
            $type
        ));
    }
}
