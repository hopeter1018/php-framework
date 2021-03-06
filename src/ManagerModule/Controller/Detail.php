<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ManagerModule\Controller;

use Hopeter1018\Framework\ManagerModule\ModuleController;

/**
 * {@inheritdoc}
 *
 * @version $id$
 * @author peter.ho
 */
abstract class Detail extends ModuleController
{

    /**
     * Return options used in edit
     * 
     * @param int $contentId
     * @param int $charsetId
     * @return Returnable Description
     */
    public static function options($contentId, $charsetId)
    {
        return array ();
    }

    /**
     * Get the view/edit mode data
     * 
     * @param int $contentId
     * @param int $charsetId
     * @return Returnable Description
     */
    abstract public static function view($contentId, $charsetId);

    /**
     * Run the save action
     * 
     * @param int $contentId
     * @param int $charsetId
     * @param mixed $data
     * @return Returnable Description
     */
    abstract public static function save($contentId, $charsetId, $data);

}
