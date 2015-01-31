<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ComposerScripts;

use Composer\Script\Event;

/**
 * PostCreateProject
 *
 * @version $id$
 * @author peter.ho
 */
final class PostCreateProject implements IComposerScripts
{

    public static function run(Event $event)
    {
        static::regenKeys($event);
        static::genInitSql($event);
    }

    private static function regenKeys(Event $event)
    {
        if (is_file($filepath = getcwd() . "/bootstrap.php")) {
            file_put_contents($filepath, str_replace(
                array ("define('APP_CRYPT_KEY', '');", "define('APP_HASH_KEY', '');"),
                array ("define('APP_CRYPT_KEY', '" . Hopeter1018\Helper\String::randomString() . "');", "define('APP_HASH_KEY', '" . Hopeter1018\Helper\String::randomString() . "');"),
                file_get_contents($filepath)
            ));
        }
    }

    private static function genInitSql()
    {
        $dest = APP_ROOT . "init.sql";
        //	file_put_contents($dest);
    }

}
