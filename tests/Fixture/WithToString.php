<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Test\Fixture;

/**
 * @internal
 */
class WithToString
{
    public function __toString()
    {
        return 'Class with to String';
    }
}
