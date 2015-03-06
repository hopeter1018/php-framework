<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\Enum;

use ReflectionProperty;

/**
 * Simple DocComment support for class constants.
 */
class ReflectionConst extends \ReflectionProperty
{

    /** @var array Constant names to DocComment strings. */
    private $docComments = [];
    
    private $constName = null;

    /** Constructor. */
    public function __construct($clazz, $constName)
    {
        $this->parse(new \ReflectionClass($clazz));
        $this->constName = $constName;
    }

    /** Parses the class for constant DocComments. */
    private function parse(\ReflectionClass $clazz)
    {
        $content = file_get_contents($clazz->getFileName());
        $tokens = token_get_all($content);

        $doc = null;
        $isConst = false;
        foreach ($tokens as $token) {
            list($tokenType, $tokenValue) = $token;

            switch ($tokenType) {
                // ignored tokens
                case T_WHITESPACE:
                case T_COMMENT:
                    break;

                case T_DOC_COMMENT:
                    $doc = $tokenValue;
                    break;

                case T_CONST:
                    $isConst = true;
                    break;

                case T_STRING:
                    if ($isConst) {
                        $this->docComments[$tokenValue] = self::clean($doc);
                    }
                    $doc = null;
                    $isConst = false;
                    break;

                // all other tokens reset the parser
                default:
                    $doc = null;
                    $isConst = false;
                    break;
            }
        }
    }

    /** Returns an array of all constants to their DocComment. If no comment is present the comment is null. */
    public function getDocComments()
    {
        return $this->docComments;
    }

    /** Returns the DocComment of a class constant. Null if the constant has no DocComment or the constant does not exist. */
    public function getDocComment($constantName = null)
    {
        if (!isset($this->docComments)) {
            return null;
        }
        return $this->docComments[ ($constantName === null) ? $this->constName : $constantName ];
    }

    public function getName()
    {
        return $this->constName;
    }

    /** Cleans the doc comment. Returns null if the doc comment is null. */
    private static function clean($doc)
    {
        $result = null;
        if ($doc !== null) {
            $lines = preg_split('/\R/', $doc);
            foreach ($lines as $line) {
                $line = trim($line, "/* \t\x0B\0");
                if ($line === '') {
                    continue;
                }
//                if (strpos($line, '@') === 0) {
//                    break;
//                }

                if ($result != null) {
                    $result .= ' ';
                }
                $result .= $line;
            }
        }
        return $result;
    }

}
