<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 01/05/2017
 * Time: 07:25 م
 */
class webinty_system

{


    private static $objects;

    /*
     * store Object with Key
     */

    public static function Store($key,$value)

    {

        self::$objects[$key] = $value;
    }



    /*
     * get Object by Key
     */

    public static function Get($key)

    {
        return self::$objects[$key];
    }



}