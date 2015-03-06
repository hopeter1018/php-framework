<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\Enum;

use MabeEnum\Enum;
//use ReflectionClass;

/**
 * Extended version of marc-mabe/php-enum for framework uses
 * 
 * @link https://github.com/marc-mabe/php-enum
 * @version $id$
 * @author peter.ho
 */
class FrameworkEnum extends Enum
{

//    public static function getAll()
//    {
//        $refl = new ReflectionClass(get_called_class());
//        $constants = $refl->getConstants();
//        $constDoc = new ReflectionConst(get_called_class());
//        EnumConstAnnotation::registerAnnotation();
//
//        foreach ($constants as $constantName => $value) {
//            $constDoc = new ReflectionConst(get_called_class(), $constantName);
////            $docComment = $constDoc->getDocComment($constantName);
//            \Hopeter1018\DoctrineExtension\AnnotationHelper::byProperty(get_called_class(), $constantName);
//            echo "<hr />";
//        }
//    }

    protected static $captions = array();
    protected static $option = array();
    public static function asOption()
    {
        $constants = static::getConstants();
        $option = array();
        foreach ($constants as $constantName => $value) {
            $option[] = array(
                "id" => $value,
                "value" => (isset(static::$captions[ $value ])) ? static::$captions[$value] : $constantName,
            );
        }
        return $option;
    }

}
