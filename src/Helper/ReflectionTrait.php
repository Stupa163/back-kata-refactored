<?php

namespace App\src\Helper;

use PHPUnit\Framework\MockObject\MockObject;
use Prophecy\Exception\Doubler\MethodNotFoundException;
use ReflectionException;
use ReflectionProperty;

trait ReflectionTrait
{
    /**
     * @throws ReflectionException
     */
    protected static function getPrivateProperty(string $class, string $property): ReflectionProperty
    {
        $reflectionProperty = new ReflectionProperty($class, $property);
        $reflectionProperty->setAccessible(true);

        return $reflectionProperty;
    }

    /**
     * @throws ReflectionException
     * @throws MethodNotFoundException
     */
    protected static function mockSingletonRepository(string $class, MockObject $mock): void
    {
        if (!method_exists($class, 'getInstance')) {
            throw new MethodNotFoundException('Requested method can\'t be found', $class, 'getInstance');
        }

        (self::getPrivateProperty($class, 'instance'))->setValue($class::getInstance(), $mock);
    }
}