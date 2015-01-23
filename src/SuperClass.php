<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework;

/**
 * Description of SuperClass
 *
 * @version $id$
 * @author peter.ho
 */
abstract class SuperClass
{

    public static function className()
    {
        return get_class(new static);
    }

}
