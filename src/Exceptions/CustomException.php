<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework\Exceptions;

/**
 * Description of CustomException
 *
 * @link http://php.net/manual/en/language.exceptions.php#91159
 * @version $id$
 * @author peter.ho
 */
abstract class CustomException extends Exception implements IException
{

    /**
     * Exception message
     * @var string
     */
    protected $message = 'Unknown exception';

    /**
     * Unknown
     * @var string
     */
    private $string;

    /**
     * User-defined exception code
     * @var int
     */
    protected $code = 0;

    /**
     * Source filename of exception
     * @var string
     */
    protected $file;

    /**
     * Source line of exception
     * @var int
     */
    protected $line;

    /**
     * Unknown
     * @var array
     */
    private $trace;

    public function __construct($message = null, $code = 0)
    {
        if (!$message) {
            throw new $this('Unknown ' . get_class($this));
        }
        parent::__construct($message, $code);
    }

    public function __toString()
    {
        return get_class($this) . " '{$this->message}' in {$this->file}({$this->line})\n"
            . "{$this->getTraceAsString()}";
    }

}
