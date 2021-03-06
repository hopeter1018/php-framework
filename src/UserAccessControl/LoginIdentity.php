<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\UserAccessControl;

use Hopeter1018\Helper\HttpResponse;
use Hopeter1018\Framework\SuperClass;
use Hopeter1018\Framework\SessionSegment;

/**
 * Description of LoginIdentity
 *
 * @version $id$
 * @author peter.ho
 */
abstract class LoginIdentity extends SuperClass implements ILoginIdentity
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

    protected static $posted = null;
    protected static $sessions = array();
    /**
     * 
     * @return \Hopeter1018\Framework\SessionSegment
     */
    protected static function getSession()
    {
        $className = static::className();
        if (! isset(static::$sessions[$className])) {
            static::$sessions[$className] = new SessionSegment($className);
        }
        return static::$sessions[$className];
    }

    /**
     * 
     * @param int $id
     */
    protected static function setLoggedId($id)
    {
        static::getSession()->set('LOGGED_ID', $id);
    }

    /**
     * Return if the user is logged
     * 
     * @return boolean
     */
    public static function isLogged()
    {
        return (static::getLoggedId() !== null);
    }

    public static function isPostLogin()
    {
        if ('POST' === filter_input(INPUT_SERVER, 'REQUEST_METHOD')
            and is_object($posted = \Hopeter1018\Helper\HttpRequest::getRequestParams())
            and isset($posted->login)
            and isset($posted->password)
            and isset($posted->captcha)
            and isset($posted->csrf)
        ) {
            static::$posted = $posted;
            return true;
        }
    }

    public static function processLogout()
    {
        if ('logout' === filter_input(INPUT_SERVER, 'QUERY_STRING')
            or null !== filter_input(INPUT_GET, 'logout')
        ) {
            static::setLoggedId(null);
            header('Location: login.php');
            exit;
        }
    }

    protected static function processLoginRedirect(){}

    /**
     * 
     * @return int static::LOGIN_STATUS_*
     */
    public static function processLogin()
    {
        $result = static::LOGIN_STATUS_PLEASE_LOGIN;
        if ('logout' === filter_input(INPUT_SERVER, 'QUERY_STRING')
            or null !== filter_input(INPUT_GET, 'logout')
        ) {
            \Hopeter1018\Helper\HttpResponse::addMessageUat('logout');
            static::setLoggedId(null);
            $result = static::LOGIN_STATUS_LOGOUT;
        } elseif (static::isLogged()) {
            static::getSession()->touch();
            $result = static::LOGIN_STATUS_LOGGED;
        } elseif (static::isPostLogin()) {
            try {
                $result = ((static::$posted->captcha === $_SESSION['captcha'])
                    ? static::checkLoginPassword(static::$posted->login, static::$posted->password)
                    : static::LOGIN_STATUS_CAPTCHA);
                HttpResponse::addMessageUat($result, 'processLogin.$result');
                if ($result === static::LOGIN_STATUS_LOGINSUCCESS) {
                    static::processLoginRedirect();
                }
            } catch (\Exception $ex) {
                $result = static::LOGIN_STATUS_INCORRECT;
            }
        }

        return $result;
    }

    /**
     * Get the logged userId and return null if not logged
     * 
     * @return int|null
     * @throws Exceptions\LoginException
     */
    public static function getLoggedId()
    {
        return static::getSession()->get('LOGGED_ID');
    }

    public static function getUserByLoginPassword($entity, $login, $password)
    {
        return $entity::selectFrom()
            ->where('t.login=:login and t.password=PASSWORD(CONCAT(t.login, :password))')
            ->setParameter('login', $login, \PDO::PARAM_STR)
            ->setParameter('password', $password, \PDO::PARAM_STR)
            ->getQuery()->getResult();
    }

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
