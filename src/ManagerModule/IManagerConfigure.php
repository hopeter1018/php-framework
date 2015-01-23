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
interface IManagerConfigure
{

    /**
     * Return the default manager name
     * <b>** Return human case.</b>
     * 
     * @return string
     */
    public static function getDefaultManagerName();

}
