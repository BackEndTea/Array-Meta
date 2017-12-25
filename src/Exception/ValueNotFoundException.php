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
        return new self(\sprintf(
            'Value "%s" not set.',
            $value
        ));
    }
}
