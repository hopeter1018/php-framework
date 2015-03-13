<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hopeter1018\Framework;

/**
 * Description of SessionSegment
 *
 * @version $id$
 * @author peter.ho
 */
final class SessionSegment implements \ArrayAccess
{

    private static $projectName = null;
    private static $sessionOpened = false;

    private $segmentName = null;
    private $sessionMap = null;

    private static $iniSetBeforeStart = array();
    private static $iniDirectiveNameValue = array(
        'session.use_only_cookies' => false,
        'session.use_cookies' => false,
        'session.cache_limiter' => null,
    );

    /**
     * Get a new instance of SessionSegment
     * 
     * @param string $segmentName
     * @param string $projectName
     */
    public function __construct($segmentName, $projectName = null)
    {
        $this->segmentName = $segmentName;
        if ($projectName !== null) {
            static::register($projectName);
        }
        $this->checkInit();
        $this->init();
    }

    /**
     * Check config when Init a SessionSegment.
     * 
     * @throws Exception
     */
    private function checkInit()
    {
        if (static::$projectName === null) {
            throw new \Exception('Please do SessionSegment::register');
        }
    }

    /**
     * Init the _session[ project-name ][ segment-name ]
     */
    private function init()
    {
        session_start();
        if (! isset($_SESSION[ static::$projectName ])) {
            $_SESSION[ static::$projectName ] = array();
        }
        if (! isset($_SESSION[ static::$projectName ][$this->segmentName])) {
            $_SESSION[ static::$projectName ][$this->segmentName] = array();
        }
        session_write_close();
    }

    /**
     * Register the name of Session "root"
     * @param string $projectName
     */
    public static function register($projectName)
    {
        static::$projectName = $projectName;
        foreach (static::$iniDirectiveNameValue as $name => $value) {
            static::$iniSetBeforeStart[$name] = ini_get($name);
        }
    }

    private static function iniSetOnStart()
    {
        foreach (static::$iniDirectiveNameValue as $name => $value) {
            header($name . ": " .  $value);
            ini_set($name, $value);
        }
    }

    private static function iniSetOnWriteClose()
    {
        foreach (static::$iniSetBeforeStart as $name => $value) {
            header($name . ": " .  $value);
            ini_set($name, $value);
        }
    }

    /**
     * Implements of multiple session_start
     */
    protected static function sessionStart()
    {
        if (! static::$sessionOpened) {
            static::$sessionOpened = true;
        }
        static::iniSetOnStart();
        session_start();
    }

    /**
     * Do a session write close and stores a dump of session for reading.
     * <ol>
     * <li>Get a dump of the session segment to object properties</li>
     * <li>session_write_close</li>
     * </ol>
     * 
     */
    protected function sessionWriteClose()
    {
        $this->sessionMap = $_SESSION[ static::$projectName ][ $this->segmentName ];
        static::iniSetOnWriteClose();
        session_write_close();
    }

    public function touch()
    {
        static::sessionStart();
        $this->sessionWriteClose();
    }

    /**
     * Set a value in the session segment
     * @param string $name
     * @param mixed $value
     */
    public function set($name, $value)
    {
        static::sessionStart();
        $_SESSION[ static::$projectName ][ $this->segmentName ][ $name ] = $value;
        $this->sessionWriteClose();
    }

    /**
     * Get a value in the session segment
     * @param string $name
     * @return int
     */
    public function get($name)
    {
        if ($this->sessionMap === null) {
            static::sessionStart();
            $this->sessionWriteClose();
        }

        return isset($this->sessionMap[$name])
            ? $this->sessionMap[$name]
            : null;
    }

    private static function setIn(&$src, $value, $names)
    {
        if (count($names) === 1) {
            $src[$names[0]] = $value;
        } else {
            $name = array_shift($names);
            if (! isset($src[$name])) {
                $src[$name] = array();
            }
            static::setIn($src[$name], $value, $names);
        }
    }

    /**
     * Set a value in the session segment with a chain of name (array-keys)
     * @param type $value
     * @param string $names,...
     */
    public function setDeep()
    {
        $names = func_get_args();
        $value = array_shift($names);

        static::sessionStart();
        static::setIn($_SESSION[ static::$projectName ][ $this->segmentName ], $value, $names);
        $this->sessionWriteClose();
    }

    /**
     * Remove a value by name in the session segment
     * @param string $name
     */
    public function remove($name)
    {
        static::sessionStart();
        unset($_SESSION[ static::$projectName ][ $this->segmentName ][ $name ]);
        $this->sessionWriteClose();
    }

    /**
     * Destroy the whole session segment
     */
    public function destroy()
    {
        static::sessionStart();
        unset($_SESSION[ static::$projectName ][ $this->segmentName ]);
    }

    public function getAll()
    {
        return $this->sessionMap;
    }

// <editor-fold defaultstate="collapsed" desc="ArrayAccess">

    public function offsetExists($offset)
    {
        return isset($this->sessionMap[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->sessionMap[$offset];
    }

    public function offsetSet($offset, $value)
    {
        throw new \Exception('Cannot set session as array. Please use ->set($name, $value).');
    }

    public function offsetUnset($offset)
    {
        throw new \Exception('Cannot unset session as array. Please use ->remove($name, $value).');
    }
    
// </editor-fold>

}
