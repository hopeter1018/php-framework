<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ComposerScripts;

use Composer\Script\Event;

/**
 * PostUpdate
 * composer run-script post-update-cmd
 * @version $id$
 * @author peter.ho
 */
final class PostAutoloadDump implements IComposerScripts
{

    protected static $composerJson = null;

    public static function run(Event $event)
    {
        static::$composerJson = json_decode(file_get_contents('composer.json'));
        require_once static::$composerJson->config->{'vendor-dir'} . "/autoload.php";
        $matchedClasses = static::getClassInNamespaceWhich(array(
            "ModuleController" => function($key, $className, $path) {
                return substr($key, -4) === 'Ctrl'
                    and is_subclass_of('\\' . $key, 'Hopeter1018\Framework\ManagerModule\ModuleController');
            },
        ));
//        var_dump($matchedClasses['ctrl']);
    }

    protected static function getClassInNamespaceWhich($conditions)
    {
        $classes = GeneratedAutoloaders::getClassmap(getcwd() . "/");
        $i = new \ArrayIterator($classes);
        $matchedClasses = array_fill_keys(array_keys($conditions), array());
        foreach (static::$composerJson->autoload->{'psr-4'} as $className => $path) {
            while ($i->valid()) {
                if (strpos($i->key(), $className) === 0) {
                    foreach ($conditions as $conditionName => $condition) {
                        if (is_callable($condition) and $condition($i->key(), $className, $path)) {
                            $matchedClasses[ $conditionName ][ $i->key() ] = $i->current();
                        }
                    }
                }
                $i->next();
            }
            $i->rewind();
        }
        return $matchedClasses;
    }

}
