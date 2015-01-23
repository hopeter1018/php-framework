<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\Returnable;

/**
 * Description of CriteraOptionMapping
 *
 * @version $id$
 * @author peter.ho
 */
class CriteraOptionMapping extends Returnable
{

    /**
     *
     * @var \Hopeter1018\Framework\Returnable\Returnable[] 
     */
    private $optionMapping = null;

    public function __construct()
    {
        $this->optionMapping = array();
    }

    /**
     * 
     * @param string $name
     * @param \Hopeter1018\Framework\Returnable\Returnable $options
     */
    public function addOption($name, Returnable $options)
    {
        $this->optionMapping[ $name ] = $options->getResult();
    }

    public function getResult()
    {
        return $this->optionMapping;
    }

}
