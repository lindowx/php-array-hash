<?php
/*
 *
 */
namespace Lindowx\PHPArrayHash;

final class ArrayHash
{
    const OPT_NIA_IGNORE_ORDER = 0x00000001;

    /**
     * @param array $arr
     * @param callable $walkFunc
     * @param array $path
     * @return void
     */
    private static function arrayWalkRecursive(array $arr, callable $walkFunc, array &$path = [])
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
     * @param int $options
     * @return string
     */
    public static function hash(array $arr, callable $func, int $options = 0): string
    {
        $flat = [];
        self::arrayWalkRecursive($arr, function ($path, $value) use (& $flat, & $options) {
            if (is_object($value)) {
                $value = serialize($value);
            }

            if ($options & self::OPT_NIA_IGNORE_ORDER) {
                $flat[$value] = '1';
            } else {
                $flat[implode('.', $path)] = $value;
            }
        });

        ksort($flat);
        $stub = '';
        foreach ($flat as $k => $v) {
            $stub .= $k . '=' . $v . ';';
        }

        return call_user_func($func, $stub);
    }
}