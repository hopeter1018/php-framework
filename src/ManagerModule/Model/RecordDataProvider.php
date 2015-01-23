<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ManagerModule\Model;

/**
 * For "article" input module<br />
 *
 * @version $id$
 * @author peter.ho
 */
abstract class RecordDataProvider
{

    /**
     * Get record from the module table
     */
    abstract public static function getRecord($recordId, $charsetId);

    /**
     * Update record of the module table
     */
    abstract public static function updateRecord($recordId, $charsetId);

    /**
     * Delete record from the module table
     */
    abstract public static function deleteRecord($recordId, $charsetId);

    /**
     * Get setting from the module table
     */
    abstract public static function getSetting($contentId, $charsetId);

}
