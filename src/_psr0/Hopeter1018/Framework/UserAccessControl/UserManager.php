<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\UserAccessControl;

/**
 * Description of UserManager
 *
 * @Annotation
 * @Target({"CLASS", "METHOD"})
 * @version $id$
 * @author peter.ho
 */
class UserManager extends UserAccessControl
{

    /** apple 
     * @var string 
     * @abc
     */
    public $managerName = null;

    /**
     * Check the logged user against the manager
     * 
     * {@inheritdoc}
     * @return boolean
     */
    public function isAllowed()
    {
        \Hopeter1018\Framework\LoginIdentity::getLoggedUserId();

        return false;
    }

}
