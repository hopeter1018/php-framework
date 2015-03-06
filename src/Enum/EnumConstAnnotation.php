<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\Enum;

use Doctrine\Common\Annotations\AnnotationRegistry;
use Hopeter1018\Framework\SuperClass;

/**
 * 
 * @Annotation
 * @Target({"PROPERTY"})
 * @Attributes({
 *   @Attribute("caption", type = "string"),
 * })
 * @version $id$
 * @author peter.ho
 */
class EnumConstAnnotation extends SuperClass
{

    public static function registerAnnotation()
    {
        AnnotationRegistry::registerAutoloadNamespace(static::className());
    }

}
