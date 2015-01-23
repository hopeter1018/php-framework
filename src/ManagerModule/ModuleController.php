<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ManagerModule;

use Hopeter1018\Framework\SuperClass;

/**
 * Base of all kinds of module controllers<br />
 * <br />
 * All methods should:
 * <ol>
 * <li>return Hopeter1018\Framework\Returnable\Returnable (or nested)</li>
 * </ol>
 * <i>* methods name preferred to be single-word.</i>
 * 
 * @version $id$
 * @author peter.ho
 */
abstract class ModuleController extends SuperClass
{

    static $composerAutoloaded = null;
    static $composerAutoloadedClassMap = null;
    final public static function init(\Composer\Autoload\ClassLoader $composerAutoloaded)
    {
        static::$composerAutoloaded = $composerAutoloaded;
        static::$composerAutoloadedClassMap = $composerAutoloaded->getClassMap();
    }

    final public static function getDir()
    {
        return dirname(static::$composerAutoloadedClassMap[static::className()]) . "/";
    }

}
