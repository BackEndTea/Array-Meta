<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Exception;

final class KeyNotFoundException extends \RuntimeException
{
    /**
     * @param int|string $key
     *
     * @return self
     */
    public static function keyNotFound($key): self
    {
        return new self(\sprintf(
            'Key "%s" not set.',
            $key
        ));
    }
}
