<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Exception;

final class KeyNotFoundException extends \RuntimeException
{
    public static function keyNotFound($key): self
    {
        return new self(\sprintf(
            'Key "%s" not set.',
            $key
        ));
    }
}
