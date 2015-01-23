<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework;

use Hopeter1018\FileOperation\Path;

/**
 * Consolidated Shortcuts to all system writable paths
 *
 * @version $id$
 * @author peter.ho
 */
final class SystemPath
{

    CONST WB_APP = 'application/';
    CONST WB_APP_GEN = 'application/generated/';
    CONST WB_APP_GEN_DOCTRINE = 'application/generated/doctrine-files/';
    CONST WB_APP_GEN_NETBEANS = 'application/generated/netbeans-hinting/';
    CONST WB_APP_TWIG_COMMON = 'application/twig-common/';

    /**
     * Return the absolute path under [wcms/_system_storage/]
     * 
     * @param string $path Path relative to storage
     * @return string
     */
    public static function storagePath($path = '')
    {
        return Path::concatPath(APP_SYSTEM_STORAGE, $path);
    }

    /**
     * Return the absolute path under [workbench/]
     * 
     * @param string $path Path relative to workbench
     * @return string
     */
    public static function wbAppGenPath($path = '')
    {
        return Path::concatPath(APP_WORKBENCH_ROOT, self::WB_APP_GEN, $path);
    }

    /**
     * Return the absolute path under [workbench/]
     * 
     * @param string $path Path relative to workbench
     * @return string
     */
    public static function workbenchPath($path = '')
    {
        return Path::concatPath(APP_WORKBENCH_ROOT, $path);
    }

    /**
     * Return the absolute path under [workbench/application/generated/netbeans-hinting/]
     * 
     * @param string $parts,...
     * @return string
     */
    public static function twigCommonHintPath()
    {
        return Path::concatPath(APP_WORKBENCH_ROOT, static::WB_APP_TWIG_COMMON, func_get_args());
    }

    /**
     * Return the absolute path under [workbench/application/generated/netbeans-hinting/]
     * 
     * @param string $parts,...
     * @return string
     */
    public static function netbeansHintPath()
    {
        return Path::concatPath(APP_WORKBENCH_ROOT, static::WB_APP_GEN_NETBEANS, func_get_args());
    }

    /**
     * Return the absolute path under [workbench/application/generated/doctrine-files/]
     * 
     * @param string $parts,...
     * @return string
     */
    public static function doctrineFilesPath()
    {
        return Path::concatPath(APP_WORKBENCH_ROOT, static::WB_APP_GEN_DOCTRINE, func_get_args());
    }

}
