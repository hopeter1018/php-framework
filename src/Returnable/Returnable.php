<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\Returnable;

/**
 * Description of Returnable
 *
 * @version $id$
 * @author peter.ho
 */
abstract class Returnable
{

    /**
     * @return array|\stdClass
     */
    abstract public function getResult();

    /**
     * @return string in json format
     */
    final public function getReturn()
    {
        
    }

}
