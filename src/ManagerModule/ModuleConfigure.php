<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ManagerModule;

/**
 * Declarations of each module, it storee:
 * - Manager (MANAGER_NAME) / Module (GUID)
 * - Entities (db_tables)
 * - Controller + subs (grouping / routing)
 * 
 * @version $id$
 * @author peter.ho
 */
abstract class ModuleConfigure extends \Hopeter1018\Framework\SuperClass implements IModuleConfigure
{

    /**
     * Return the relative path of the configure file
     * 
     * @todo cache
     * @return string
     */
    public static function getPath()
    {
        $refl = new \ReflectionClass(static::className());
        return dirname($refl->getFileName()) . '/';
    }

    /**
     * Return the relative path of the assets
     * 
     * @todo cache
     * @return string
     */
    public static function getPathAssets()
    {
        return static::getPath() . 'assets/';
    }

    /**
     * Return the relative path of the assets
     * 
     * @todo cache
     * @param string $fileName
     * @return string
     */
    public static function getDefaultTwig($fileName = 'main.html.twig')
    {
        return static::getPathAssets() . $fileName;
    }

}
