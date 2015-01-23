<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ManagerModule;

/**
 * Description of ModuleEvents
 *
 * @version $id$
 * @author peter.ho
 */
abstract class ModuleEvents
{

    abstract static function onInstall();
    abstract static function onUninstall();
    abstract static function onVersionChanged($oldVersion, $newVersion);

}
