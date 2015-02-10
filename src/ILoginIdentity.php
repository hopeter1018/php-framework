<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework;

/**
 * Description of ILoginIdentity
 *
 * @version $id$
 * @author peter.ho
 */
interface ILoginIdentity
{

    /**
     * -   repeated: if (checkXXX()) { return static::STATUSCODE; } else
     * 
     * @param string $user
     * @param string $password
     */
    public static function login($user, $password);

    /**
     * 
     * 
     * @param string $user
     * @param string $password
     * @return boolean
     */
    public static function checkUserPassword($user, $password);

    /**
     * Get the logged userId and return null if not logged
     * 
     * @return int|null
     * @throws Exceptions\LoginException
     */
    public static function getLoggedUserId();

    /**
     * Return if the user is logged
     * 
     * @return boolean
     */
    public static function isLogged();

}
