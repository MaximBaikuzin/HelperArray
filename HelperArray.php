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

}