<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\UserAccessControl;

/**
 *
 * @Annotation
 * @Target({"CLASS", "METHOD"})
 * @version $id$
 * @author peter.ho
 */
class Anonymous extends UserAccessControl
{

    /**
     * Always return true.
     * {@inheritdoc}
     * 
     * @return boolean
     */
    public function isAllowed()
    {
        return true;
    }

}
