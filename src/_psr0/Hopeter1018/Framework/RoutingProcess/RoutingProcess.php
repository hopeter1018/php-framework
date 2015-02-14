<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\RoutingProcess;

/**
 * Description of RoutingProcess
 * Annotations !
 * 
 * @version $id$
 * @author peter.ho
 */
abstract class RoutingProcess extends \Hopeter1018\Framework\SuperClass
{


    /**
     * 
     * @throws \Exception
     * @return boolean
     */
    abstract public function invoke();

    const CLASSNAME = __CLASS__;

}
