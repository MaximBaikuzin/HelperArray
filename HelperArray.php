<?php
namespace MaximBaikuzin\Helper;


class HelperArray
{

    public static function printPretty(array $arr): void
    {
        print('<pre>' . print_r($arr, true) . '</pre>');
    }

}