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
abstract class LoginIdentity
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
     * Return hashed string of password prefixed by id
     * 
     * @param int $id
     * @param string $password
     * @return string
     */
    protected static function getPasswordHash($id, $password)
    {
        return \Hopeter1018\Helper\String::saltyHash($id, $password);
    }

}
