<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ManagerModule\Controller;

use Hopeter1018\Framework\ManagerModule\ModuleController;

/**
 * Specified for um with both listing and form<br />
 * {@inheritdoc}
 *
 * @version $id$
 * @author peter.ho
 */
abstract class ListDetail extends ModuleController
{

    /**
     * Return options used in search panel
     * 
     * @param int $contentId
     * @param int $charsetId
     * @return Returnable Description
     */
    public static function criteria($contentId, $charsetId)
    {
        return array ();
    }

    /**
     * Get the list mode data<br />
     * Return ng-table compatible array
     * 
     * @param int $contentId
     * @param int $charsetId
     * @return Returnable Description
     */
    abstract public static function listing($contentId, $charsetId);

    /**
     * Run the delete action
     * 
     * @param int $contentId
     * @param int $charsetId
     * @param mixed $data
     * @return Returnable Description
     */
    abstract public static function delete($contentId, $charsetId, $data);

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
