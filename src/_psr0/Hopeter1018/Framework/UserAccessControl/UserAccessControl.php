<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\UserAccessControl;

/**
 * Abstract class UserAccessControl
 *
 * @Annotation
 * @Target({"CLASS", "METHOD"})
 * @version $id$
 * @author peter.ho
 */
abstract class UserAccessControl extends \Hopeter1018\Framework\SuperClass
{

    /**
     * The method body of doing the check
     * @throws \Exception
     * @return boolean
     */
    abstract public function isAllowed();

    const CLASSNAME = __CLASS__;

}
