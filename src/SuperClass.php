<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework;

/**
 * Description of SuperClass
 *
 * @version $id$
 * @author peter.ho
 */
abstract class SuperClass
{

    protected static $reflected = array();
    public static function className()
    {
        return get_class(new static);
    }

    public static function reflFileName()
    {
        $staticClassName = static::className();
        if (! isset(static::$reflected[$staticClassName])) {
            static::$reflected[$staticClassName] = new \ReflectionClass(new static);
        }
        return static::$reflected[$staticClassName]->getFileName();
    }

}
