<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\UserAccessControl;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Hopeter1018\Framework\SessionSegment;
use Hopeter1018\Helper\HttpRequest;

/**
 * Abstract class UserAccessControl
 *
 * @Annotation
 * @Target({"CLASS", "METHOD"})
 * @version $id$
 * @author peter.ho
 */
abstract class UserAccessControl extends LoginIdentity
{

    const LOGGED_URL = "dashboard.php";

    /**
     * The method body of doing the check
     * @throws \Exception
     * @return boolean
     */
    public function isAllowed()
    {
        parent::processLogin();
        return static::isLogged();
    }

    public function accessDenied($method)
    {
        if (null === $method) {
            $sessionSeg = new SessionSegment('uac');
            $parsed = parse_url(filter_input(INPUT_SERVER, "REQUEST_URI"));
            if (basename($parsed['path']) !== 'login.php') {
                if (isset($parsed['query']) and $parsed['query'] === 'logout') {
                    $parsed['query'] = '';
                }
                $sessionSeg->set('REQUEST_URI', $parsed['path'] . "?" . $parsed['query']);
            }
            header('Location: login.php');
        } else {
            header('hkc-uac: login.php');
        }
        exit;
    }

    public static function processLogin()
    {
        $status = parent::processLogin();
//        \Hopeter1018\Helper\HttpResponse::addMessageUat($status);
        if ($status === static::LOGIN_STATUS_LOGINSUCCESS
            or $status === static::LOGIN_STATUS_LOGGED
        ) {
            $sessionSeg = new SessionSegment('uac');
            $destLocation = static::LOGGED_URL;
            if (null !== $sessionSeg->get("REQUEST_URI", $sessionSeg)) {
                $destLocation = $sessionSeg->get("REQUEST_URI", $sessionSeg);
            }
            $sessionSeg->remove('REQUEST_URI');

            if (HttpRequest::has('hkc-login')) {
                header("hkc-uac: {$destLocation}");
            } else {
                header("Location: {$destLocation}");
            }
            exit;
        }
    }

    /**
     * Register the UserAccessControl into Doctrine Annotation
     */
    public static function registerAnnotation()
    {
        AnnotationRegistry::registerAutoloadNamespace(static::className());
    }

    const CLASSNAME = __CLASS__;

}
