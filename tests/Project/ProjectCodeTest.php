<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Test\Project;

use BackEndTea\ArrayMeta\ArrayMeta;

/**
 * This class is intended to test our code is build up according to certain standards.
 * It should be seen as a code style enforcer, rather than a test.
 *
 * Tests about classes being final/having tests etc should be in this class/namespace.
 */
final class ProjectCodeTest extends \PHPUnit\Framework\TestCase
{
    public function testItIsFinal()
    {
        $class = new \ReflectionClass(ArrayMeta::class);
        $this->assertTrue($class->isFinal());
    }

    public function testItImplementsArrayAccess()
    {
        $class = new \ReflectionClass(ArrayMeta::class);
        $this->assertTrue($class->implementsInterface(\ArrayAccess::class));
    }

    public function testItImplementsCountable()
    {
        $class = new \ReflectionClass(ArrayMeta::class);
        $this->assertTrue($class->implementsInterface(\Countable::class));
    }

    public function testItImplementsIteratorAggregate()
    {
        $class = new \ReflectionClass(ArrayMeta::class);
        $this->assertTrue($class->implementsInterface(\IteratorAggregate::class));
        $this->assertTrue($class->isIterateable());
    }
}
