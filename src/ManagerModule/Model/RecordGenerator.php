<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\ManagerModule\Model;

/**
 * Description of BaseRecordGenerator
 *
 * @version $id$
 * @author peter.ho
 */
abstract class RecordGenerator
{

    abstract public static function generateContentList($contentId, $charsetId, $param);

    abstract public static function generateContentDetail($contentId, $charsetId, $param);

}
