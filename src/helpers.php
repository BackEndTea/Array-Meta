<?php

declare(strict_types=1);

use BackEndTea\ArrayMeta\Exception\IllegalKeyException;

//region Array key checker
if (!\function_exists('isValidArrayKey')) {
    function isValidArrayKey($key): bool
    {
        return \is_string($key) || \is_int($key);
    }
}

if (!\function_exists('assertValidArrayKey')) {
    function assertValidArrayKey($key)
    {
        if (!isValidArrayKey($key)) {
            throw IllegalKeyException::wrongType($key);
        }
    }
}
//endregion
