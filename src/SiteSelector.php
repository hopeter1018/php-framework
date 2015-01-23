<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework;

/**
 * Description of SiteSelector
 *
 * @version $id$
 * @author peter.ho
 */
final class SiteSelector
{

    /**
     * Set the siteId to session.<br />
     * <ol>
     * <li>Login</li>
     * <li>Select another Site by the site selector</li>
     * </ol>
     * 
     * @todo check the siteId against db.
     * @param int $siteId
     */
    public static function setSiteId($siteId)
    {
        $session = \Hopeter1018\ExtensionHelper\HoaSession::browserSegment();
        $session['siteId'] = (int) $siteId;
    }

    /**
     * Get the logged siteId from:
     * <ol>
     * <li>Session</li>
     * <li>Cookie</li>
     * <li>Default site id set in DB</li>
     * <li>Default</li>
     * </ol>
     * 
     * @todo check the siteId against db.
     * @return int
     */
    public static function getSiteId()
    {
        $session = \Hopeter1018\ExtensionHelper\HoaSession::browserSegment();
        $siteID = APP_DEFAULT_SITE;
        if (! $session->isEmpty()) {
            $siteID = $session['siteId'];
        } elseif (isset($_COOKIE['siteId']) and (int) $_COOKIE['siteId'] > 0) {
            $siteID = $_COOKIE['siteId'];
        } elseif (LoginIdentity::isLogged()) {
            $siteID = static::getUserDefaultSiteId();
        }

        return $siteID;
    }

    /**
     * Get the default site id of the logged user set in DB
     * @todo Get from DB
     * @return int
     */
    private static function getUserDefaultSiteId()
    {
        return 0;
    }

}
