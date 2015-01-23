<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ManagerModule\Model;

/**
 * Description of BaseRecordFileManager
 *
 * @version $id$
 * @author peter.ho
 */
abstract class RecordFileManager
{

    CONST PATH_LIVE = "%s/%d/%s";
    CONST PATH_EDITING = "%s/%d/%s";

    abstract public static function getModuleFolderName();

    public static function getRecordFile($recordId, $name)
    {
        
    }

    public static function getRecordFileEditing($recordId, $name)
    {
        
    }

    public static function getRecordFileLive($recordId, $name)
    {
        
    }

}
