<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ComposerScripts;

use Composer\Script\Event;

/**
 * Interface to all composer scripts
 * getcwd() return project root
 *
 * @link https://getcomposer.org/doc/articles/scripts.md
 * @version $id$
 * @author peter.ho
 */
interface IComposerScripts
{

    public static function run(Event $event);

}
