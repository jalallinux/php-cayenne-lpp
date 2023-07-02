<?php


use JalalLinuX\CayenneLpp\Cayenne;

if (! function_exists('cayenne')) {
    function cayenne(): Cayenne
    {
        return new Cayenne();
    }
}
