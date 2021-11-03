<?php
/*
 *
 */
namespace Lindowx\PHPArrayHash;

final class ArrayHash
{
    /**
     * @param array $arr
     * @param callable $walkFunc
     * @param array $path
     * @return void
     */
    protected static function arrayWalkRecursive(array $arr, callable $walkFunc, &$path = [])
    {
        foreach ($arr as $key => $value) {
            $path[] = $key;
            if (is_array($value)) {
                self::arrayWalkRecursive($value, $walkFunc, $path);
            } else {
                $walkFunc($path, $value);
            }
            array_pop($path);
        }
    }

    /**
     * Hashing
     *
     * @param array $arr
     * @param callable $func
     * @return string
     */
    public static function hash(array $arr, callable $func)
    {
        $flat = [];
        self::arrayWalkRecursive($arr, function ($path, $value) use (& $flat) {
            if (is_object($value)) {
                $value = serialize($value);
            }
            $flat[implode('.', $path)] = $value;
        });

        ksort($flat);
        $stub = '';
        foreach ($flat as $k => $v) {
            $stub .= $k . '=' . $v . ';';
        }

        return call_user_func($func, $stub);
    }
}