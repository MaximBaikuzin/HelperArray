<?php
namespace Helper;


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

}