<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ManagerModule\Controller;

use Hopeter1018\Framework\ManagerModule\ModuleController;
use Hopeter1018\Framework\Returnable\CriteraOptionMapping;

/**
 * {@inheritdoc}
 *
 * @version $id$
 * @author peter.ho
 */
abstract class Form extends ModuleController implements IForm
{

    /**
     * Return options used in edit mode
     * 
     * @return CriteraOptionMapping Description
     */
    public static function options()
    {
        $result = new CriteraOptionMapping;
        return $result;
    }

}
