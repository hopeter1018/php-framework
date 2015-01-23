<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ManagerModule\Controller;

/**
 * Description of IForm
 *
 * @version $id$
 * @author peter.ho
 */
interface IForm
{

    /**
     * Get the view/edit mode data
     * 
     * @return Returnable Description
     */
    public static function view();

    /**
     * Run the save action
     * 
     * @param mixed $data
     * @return Returnable Description
     */
    public static function save($data);

}
