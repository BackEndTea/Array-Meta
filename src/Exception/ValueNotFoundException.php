<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Exception;

final class ValueNotFoundException extends \RuntimeException
{
    /**
     * @param mixed $value
     *
     * @return self
     */
    public static function valueNotFound($value): self
    {
        if ((\is_string($value) || \is_numeric($value)) ||
            \is_object($value) && \method_exists($value, '__toString')
        ) {
            return new self(\sprintf(
                'Value "%s" not set.',
                $value
            ));
        }
        return new self('Value not set.');
    }
}
