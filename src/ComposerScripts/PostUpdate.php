<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ComposerScripts;

use Composer\Script\Event;
use Hopeter1018\Framework\SystemPath;

/**
 * PostUpdate
 * composer run-script post-update-cmd
 * @version $id$
 * @author peter.ho
 */
final class PostUpdate implements IComposerScripts
{

    protected static $composerJson = null;
    protected static $folderToWrite = array(
        
    );

    protected static function setConst()
    {
        define('APP_IS_DEV', false);
        define('APP_IS_UAT', false);
        define('APP_WCMS_FOLDER', dirname(static::$composerJson->config->{"vendor-dir"}) . '/');
        define('APP_WORKBENCH_FOLDER', 'workbench/');
        define('APP_ROOT', getcwd() . '/');
        define('APP_WCMS_ROOT', APP_ROOT . APP_WCMS_FOLDER);
        define('APP_SYSTEM_STORAGE', APP_WCMS_ROOT . '_system_storage/');
    }

    protected static function doPathChmod($path)
    {
		is_dir($path) or mkdir($path, 0777, true);
        chmod($path, 0777);
        if (! \Hopeter1018\FileOperation\DirectoryOperation::isDirWritable($path)) {
            echo "-   Error: Path not writable. ({$path})";
        }
    }

    public static function run(Event $event)
    {
        static::$composerJson = json_decode(file_get_contents('composer.json'));
        static::setConst();
        static::doPathChmod(SystemPath::assetsPath('js/packages'));
        static::doPathChmod(SystemPath::storagePath());
        echo "Finished PostUpdate";
    }

}
