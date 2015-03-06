<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\UserAccessControl;

/**
 * Description of ILoginIdentity
 *
 * @version $id$
 * @author peter.ho
 */
interface ILoginIdentity
{

    /**
     * Put logic of database here
     * 
     * @param string $login
     * @param string $password
     * @return boolean
     */
    public static function checkLoginPassword($login, $password);

}
