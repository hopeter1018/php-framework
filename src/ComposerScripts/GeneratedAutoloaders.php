<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ComposerScripts;

/**
 * Description of AutoloadClassmap
 *
 * @version $id$
 * @author peter.ho
 */
final class GeneratedAutoloaders
{

    protected static $composerJson = null;

    protected static $classmap = null;
    public static function getClassmap($appRoot)
    {
        if (static::$composerJson === null or static::$classmap === null) {
            $jsonPath = $appRoot . 'composer.json';

            static::$composerJson = json_decode(file_get_contents($jsonPath));
            static::$classmap = include $appRoot . static::$composerJson->config->{'vendor-dir'} . "/composer/autoload_classmap.php";
        }
        return static::$classmap;
    }

}
