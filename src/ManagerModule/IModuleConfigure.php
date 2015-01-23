<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ManagerModule;

/**
 * Description of IModuleConfigure
 *
 * @version $id$
 * @author peter.ho
 */
interface IModuleConfigure
{

    /**
     * Return the default module-name for routing
     * <b>** Return dash case.</b>
     * 
     * @return string
     */
    public static function getDefaultModuleName();

    /**
     * Return the guid if the module is an input module
     * 
     * @return null|string
     */
    public static function getGuid();

    /**
     * Return the list of unique-entities used by the module
     * 
     * @return BaseEntity[]
     */
    public static function getEntities();

    /**
     * Return the instance of the module event
     * 
     * @return ModuleEvents
     */
    public static function getEvents();

}
