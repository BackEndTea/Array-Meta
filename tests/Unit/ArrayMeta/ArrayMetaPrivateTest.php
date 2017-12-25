<?php

declare(strict_types=1);

namespace BackEndTea\ArrayMeta\Test\Unit\ArrayMeta;

use BackEndTea\ArrayMeta\ArrayMeta;
use BackEndTea\ArrayMeta\Exception\IllegalKeyException;

/**
 * This class is used to test private methods in the ArrayMeta class.
 * For testing protected methods, us a fixture class which extends the ArrayMetaClass.
 *
 * @covers \BackEndTea\ArrayMeta\ArrayMeta
 */
class ArrayMetaPrivateTest extends \PHPUnit\Framework\TestCase
{
    public function testAssertKeyIsOfCorrectTypeDoesNothingIfKeyIsString()
    {
        $meta = new ArrayMeta();
        $return = $this->invokeMethod($meta, 'assertKeyIsOfCorrectType', ['key']);

        $this->assertNull($return);
    }

    public function testAssertKeyIsOfCorrectTypeDoesNothingIfKeyIsInteger()
    {
        $meta = new ArrayMeta();
        $return = $this->invokeMethod($meta, 'assertKeyIsOfCorrectType', [3]);

        $this->assertNull($return);
    }

    public function testAssertKeyIsOfCorrectTypeThrowsAnErrorIfKeyIsNotOfAllowedType()
    {
        $meta = new ArrayMeta();

        $this->expectException(IllegalKeyException::class);

        $this->invokeMethod($meta, 'assertKeyIsOfCorrectType', [new \stdClass()]);
    }

    /**
     * Call protected/private method of a class
     *
     * @param object &$object    Instantiated object that we will run method on
     * @param string $methodName Method name to call
     * @param array  $parameters array of parameters to pass into method
     *
     * @return mixed method return
     */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(\get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
