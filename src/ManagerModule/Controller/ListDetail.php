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

}
