<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework;

use MabeEnum\Enum;

/**
 * Extended version of marc-mabe/php-enum for framework uses
 * 
 * @link https://github.com/marc-mabe/php-enum
 * @version $id$
 * @author peter.ho
 */
class FrameworkEnum extends Enum
{

    public static function getAll()
    {
        return static::getConstants();
    }

    protected static $captions = array();
    protected static $option = array();
    public static function toOptions()
    {
        $constants = static::getConstants();
        $option = array();
        foreach ($constants as $constantName => $value) {
            $option[] = array(
                "id" => $value,
                "value" => (isset(static::$captions[ $value ]))
                    ? static::$captions[$value]
                    : $constantName,
            );
        }
        return $option;
    }

}
