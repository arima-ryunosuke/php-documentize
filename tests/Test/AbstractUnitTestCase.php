<?php

namespace ryunosuke\Test;

abstract class AbstractUnitTestCase extends \PHPUnit\Framework\TestCase
{
    public static function assertException($e, $callback)
    {
        if (is_string($e)) {
            $e = new \Exception($e);
        }

        $callback = self::forcedCallize($callback);

        try {
            $callback(...array_slice(func_get_args(), 2));
        }
        catch (\PHPUnit\Framework\Error\Error $ex) {
            throw $ex;
        }
        catch (\Exception $ex) {
            self::assertInstanceOf(get_class($e), $ex);
            self::assertEquals($e->getCode(), $ex->getCode());
            if (strlen($e->getMessage()) > 0) {
                self::assertStringContainsString($e->getMessage(), $ex->getMessage());
            }
            return;
        }
        self::fail(get_class($e) . ' is not thrown.');
    }

    public static function forcedCallize($callable, $method = null)
    {
        if (func_num_args() == 2) {
            $callable = func_get_args();
        }

        if (is_string($callable) && strpos($callable, '::') !== false) {
            $parts = explode('::', $callable);
            $method = new \ReflectionMethod($parts[0], $parts[1]);
            if (!$method->isPublic() && $method->isStatic()) {
                $method->setAccessible(true);
                return function () use ($method) {
                    return $method->invokeArgs(null, func_get_args());
                };
            }
        }

        if (is_array($callable) && count($callable) === 2) {
            try {
                $method = new \ReflectionMethod($callable[0], $callable[1]);
                if (!$method->isPublic()) {
                    $method->setAccessible(true);
                    return function () use ($callable, $method) {
                        return $method->invokeArgs($callable[0], func_get_args());
                    };
                }
            }
            catch (\ReflectionException $ex) {
                // __call を考慮するとどうしようもない
            }
        }

        return $callable;
    }

    public static function forcedRead($object, $property)
    {
        $refprop = null;
        $class = get_class($object);
        while (true) {
            try {
                $refprop = new \ReflectionProperty($class, $property);
                break;
            }
            catch (\ReflectionException $ex) {
                $class = get_parent_class($class);
                if ($class == false) {
                    throw $ex;
                }
            }
        }
        $refprop->setAccessible(true);
        return $refprop->getValue($object);
    }

    public static function forcedWrite($object, $property, $value)
    {
        $refprop = null;
        $class = get_class($object);
        while (true) {
            try {
                $refprop = new \ReflectionProperty($class, $property);
                break;
            }
            catch (\ReflectionException $ex) {
                $class = get_parent_class($class);
                if ($class == false) {
                    throw $ex;
                }
            }
        }
        $refprop->setAccessible(true);
        $current = $refprop->getValue($object);
        $refprop->setValue($object, $value);
        return $current;
    }

    public static function writePhpFile($data, $filename = null)
    {
        $filename ??= tempnam(sys_get_temp_dir(), 'php');
        file_put_contents($filename, "<?php return " . var_export($data, true) . ";");
        return $filename;
    }
}
