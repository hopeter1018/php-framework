<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\UserAccessControl;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Hopeter1018\Framework\LoginIdentity;
use Hopeter1018\Framework\SessionSegment;

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
            $sessionSeg->set('REQUEST_URI', filter_input(INPUT_SERVER, "REQUEST_URI"));

            header('Location: login.php');
        } else {
            header('hkc-uac: login.php');
        }
        exit;
    }

    public static function processLogin()
    {
        $status = parent::processLogin();
        if ($status === static::LOGIN_STATUS_LOGINSUCCESS) {
            $sessionSeg = new SessionSegment('uac');
            $destLocation = "dashboard.php";
            if (null !== $sessionSeg->get("REQUEST_URI", $sessionSeg)) {
                $destLocation = $sessionSeg->get("REQUEST_URI", $sessionSeg);
            }
            header("Location: {$destLocation}");
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
