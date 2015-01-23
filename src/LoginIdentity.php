<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework;

/**
 * Description of LoginIdentity
 *
 * @version $id$
 * @author peter.ho
 */
class LoginIdentity
{

// <editor-fold defaultstate="collapsed" desc="Constants">

    const LOGIN_STATUS_LOGGED = 0;
    const LOGIN_STATUS_LOGINSUCCESS = 1;
    const LOGIN_STATUS_INCORRECT = 2;
    const LOGIN_STATUS_ACCOUNT_INACTIVE = 3;
    const LOGIN_STATUS_IP_RANGE = 4;
    const LOGIN_STATUS_MAINTENANCE = 5;
    const LOGIN_STATUS_LOGOUT = 6;
    const LOGIN_STATUS_PLEASE_LOGIN = 7;
    const LOGIN_STATUS_CSRF = 8;
    const LOGIN_STATUS_CAPTCHA = 9;

// </editor-fold>

    /**
     * -   repeated: if (checkXXX()) { return static::STATUSCODE; } else
     * 
     * @param string $user
     * @param string $password
     */
    public static function login($user, $password)
    {
        
    }

    /**
     * 
     * @param string $ip
     * @return boolean
     */
    private static function checkIp($ip)
    {
        $result = false;
        return $result;
    }

    /**
     * 
     * 
     * @param string $user
     * @param string $password
     * @return boolean
     */
    private static function checkUserPassword($user, $password)
    {
        $result = false;
        return $result;
    }

    /**
     * Return hashed string of password prefixed by id
     * 
     * @param int $id
     * @param string $password
     * @return string
     */
    private static function getPasswordHash($id, $password)
    {
        return \Hopeter1018\Helper\String::saltyHash($id, $password);
    }

    /**
     * Get the logged userId and return null if not logged
     * 
     * @return int|null
     * @throws Exceptions\LoginException
     */
    public static function getLoggedUserId()
    {
        $session = \Hopeter1018\ExtensionHelper\HoaSession::browserSegment();
        if ($session->isEmpty()) {
            throw new Exceptions\LoginException;
        }
        return (int) $session['userId'] ?: null;
    }

    /**
     * Return if the user is logged
     * 
     * @return boolean
     */
    public static function isLogged()
    {
        return ! \Hopeter1018\ExtensionHelper\HoaSession::browserSegment()->isEmpty();
    }

}
