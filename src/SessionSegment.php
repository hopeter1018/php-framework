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

    private static $projectName = 'PROJECT_NAME';
    private static $sessionOpened = false;

    private $segmentName = null;

    /**
     * 
     * @param string $segmentName
     */
    public function __construct($segmentName)
    {
        $this->segmentName = $segmentName;
    }

    /**
     * 
     * @param string $projectName
     */
    public static function register($projectName)
    {
        static::$projectName = $projectName;
    }

    protected static function sessionStart()
    {
        if (! static::$sessionOpened) {
            static::$sessionOpened = true;

            ini_set('session.use_only_cookies', false);
            ini_set('session.use_cookies', false);
            //ini_set('session.use_trans_sid', false); //May be necessary in some situations
            ini_set('session.cache_limiter', null);
        }
        session_start();
    }

    protected function &session()
    {
        static::sessionStart();
        return $_SESSION[ static::$projectName ][ $this->segmentName ];
    }
    

    public function set($name, $value)
    {
        
    }

    public function remove($name)
    {
        
    }

// <editor-fold defaultstate="collapsed" desc="ArrayAccess">

    public function offsetExists($offset)
    {
        
    }

    public function offsetGet($offset)
    {
        
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
