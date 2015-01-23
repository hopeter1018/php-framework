<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\Exceptions;

/**
 * Description of IException
 *
 * @link http://php.net/manual/en/language.exceptions.php#91159
 * @version $id$
 * @author peter.ho
 */
interface IException
{

    /* Protected methods inherited from Exception class */

    /**
     * Exception message 
     */
    public function getMessage();                 

    /**
     * User-defined Exception code
     */
    public function getCode();

    /**
     * Source filename
     */
    public function getFile();

    /**
     * Source line
     */
    public function getLine();

    /**
     * An array of the backtrace()
     */
    public function getTrace();

    /**
     * Formated string of trace
     */
    public function getTraceAsString();

    /* Overrideable methods inherited from Exception class */

    /**
     * formated string for display
     */
    public function __toString();

    public function __construct($message = null, $code = 0);

}
