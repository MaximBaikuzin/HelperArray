<?php
namespace MaximBaikuzin\Helper;


class HelperArray
{

    /**
     * Pretty print is used to format the data.
     * The data can be represented in a more readable form for humans by using pretty printing.
     *
     * @param array $arr
     */
    public static function printPretty(array $arr): void
    {
        print('<pre>' . print_r($arr, true) . '</pre>');
    }


    /**
     * Check if an array is multidimensional or if it is a single-line array.
     *
     * @param array $arr
     *
     * @return bool
     */
    public static function isMultidimensional(array $arr): bool
    {
        foreach ($arr as $v) {
            if (is_array($v)) {
                return true;
            }
        }

        return false;
    }


    /**
     * Convert deeply nested object to associative array.
     *
     * @param object $obj
     *
     * @return array
     */
    public static function convertObjectToArray(object $obj): array
    {
        return json_decode(json_encode($obj), true);
    }


    /**
     * Reindex an array so the new array starts with an index of $start
     *
     * @param array $arr
     * @param int $start
     *
     * @return array
     */
    public static function reindex(array $arr, int $start = 0): array
    {
        $arr = array_values($arr);

        if ($start > 0) {
            $cnt = count($arr);
            $keys = range($start, $start + $cnt + - 1);
            $arr = array_combine($keys, $arr);
        }

        return $arr;
    }


    /**
     * Delete all elements containing the value.
     *
     * @param array $arr
     * @param $value
     *
     * @return array
     */
    public static function unsetByValue(array $arr, $value): array
    {
        do {
            $key = array_search($value, $arr);
            if ($key !== false) {
                unset($arr[$key]);
            }
        } while ($key !== false);

        return $arr;
    }

}