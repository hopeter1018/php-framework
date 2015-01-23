<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\Returnable;

/**
 * Description of DqlOptions
 *
 * @version $id$
 * @author peter.ho
 */
class DqlOptions extends Returnable
{

    /**
     *
     * @var array
     */
    private $result = null;

    /**
     * 
     * @param \Doctrine\ORM\QueryBuilder $dql
     * @param \Closure $format clouse to be applied in array_walk
     * function (&$val) {
     * }
     */
    public function __construct(\Doctrine\ORM\QueryBuilder $dql, \Closure $format = null)
    {
        $this->result = $dql->getQuery()->getArrayResult();
        if ($format instanceof \Closure) {
            array_walk($this->result, $format);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getResult()
    {
        return $this->result;
    }

}
