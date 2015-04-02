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

    public static function classNameWithoutNamespace()
    {
        return strrchr(static::className(), "\\");
    }

    public static function classHash()
    {
        $md5 = md5(static::className());
        return substr($md5, 0, 8) . '-' . substr($md5, 8, 4) . '-' . substr($md5, 12, 4) . '-' . substr($md5, 16, 4) . '-' . substr($md5, 20, 12);
    }
    public static function reflFileName()
    {
        $staticClassName = static::className();
        if (! isset(static::$reflected[$staticClassName])) {
            static::$reflected[$staticClassName] = new \ReflectionClass(new static);
        }
        return static::$reflected[$staticClassName]->getFileName();
    }

    private $hash = null;

    public function __construct()
    {
        $this->hash = substr(md5(time()), 0, 6);
    }
    
    public function __toString()
    {
        if ($this->hash === null) {
            error_log(static::className() . "::__construct; doesn't called SuperClass::__construct();");
        }
        return static::className() . "@{$this->hash}";
    }
}
