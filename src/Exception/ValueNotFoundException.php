<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Exception;

class ValueNotFoundException extends \RuntimeException
{
    public static function valueNotFound($value): self
    {
        return new self(\sprintf(
            'Value "%s" not set.',
            $value
        ));
    }
}
