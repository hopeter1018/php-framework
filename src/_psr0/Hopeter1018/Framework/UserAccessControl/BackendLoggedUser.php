<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\UserAccessControl;

/**
 * Description of BackendLoggedUser
 *
 * @Annotation
 * @Target({"CLASS", "METHOD"})
 * @version $id$
 * @author peter.ho
 */
class BackendLoggedUser extends UserAccessControl
{

    public function isAllowed()
    {
        return \Hopeter1018\Framework\LoginIdentity::isLogged();
    }

}
