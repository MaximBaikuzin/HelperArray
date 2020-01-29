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
     * Check if two multidimensional arrays or single-line arrays is different.
     * By default the type conversion does not take place. The $strict_type is used with false to disable strict mode.
     *
     *
     * @param $array1
     * @param $array2
     * @param bool $strict_type
     *
     * @return bool
     */
    public static function isDifferent($array1, $array2, $strict_type = true): bool
    {
        $result = self::getDifference($array1, $array2, $strict_type);
        if (!empty($result)) {
            return true;
        }

        $result = self::getDifference($array2, $array1, $strict_type);
        if (!empty($result)) {
            return true;
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
     * Reindex an array so the new array starts with an index of $start.
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
            $cnt  = count($arr);
            $keys = range($start, $start + $cnt + -1);
            $arr  = array_combine($keys, $arr);
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


    /**
     * Get a several top values in a multidimensional array by key or a single-line array.
     *
     * If two values compare as equal, their relative order in the sorted array is undefined.
     *
     * @param array $arr
     * @param int $length
     * @param null|int|string $key
     *
     * @return array
     */
    public static function getTop(array $arr, int $length, $key = null)
    {
        if (self::isMultidimensional($arr)) {
            $values = array_column($arr, $key);
            array_multisort($values, SORT_DESC, SORT_REGULAR, $arr);
        }
        else {
            rsort($arr);
        }

        $arr = array_slice($arr,0, $length);

        return $arr;
    }


    /**
     * Get the difference of two multidimensional arrays or single-line arrays.
     * Returns an array containing all the entries from array1 that are not present in array2.
     * By default the type conversion does not take place. The $strict_type is used with false to disable strict mode.
     *
     * @param $array1
     * @param $array2
     * @param bool $strict_type
     *
     * @return array
     */
    public static function getDifference($array1, $array2, $strict_type = true): array
    {
        $difference = array();
        foreach ($array1 as $k => $v) {
            if (is_array($v)) {
                if (!array_key_exists($k, $array2) OR !is_array($array2[$k])) {
                    $difference[$k] = $v;
                } else {
                    $new_diff = self::getDifference($v, $array2[$k]);
                    if (!empty($new_diff)) {
                        $difference[$k] = $new_diff;
                    }
                }
            }
            else {
                if (!array_key_exists($k, $array2)) {
                    $difference[$k] = $v;
                }
                elseif ($strict_type AND $array2[$k] !== $v) {
                    $difference[$k] = $v;
                }
                elseif (!$strict_type AND $array2[$k] != $v) {
                    $difference[$k] = $v;
                }
            }
        }

        return $difference;
    }







}