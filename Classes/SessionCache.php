<?php
namespace AnoxGH\SimpleCache;

/**
 * Class SessionCache
 *
 * @author    Sebastian Gieselmann <s.gieselmann@live.com>
 * @copyright Copyright (c) 2015, Sebastian Gieselmann
 * @package   AnoxGH\SimpleCache
 * @link      https://github.com/anoxGH/simpleCache
 * @license   http://opensource.org/licenses/GPL-2.0
 */
class SessionCache implements CacheInterface
{



    /**
     * __construct
     */
    public function __construct()
    {
        $this->_initializeSession();
    }



    /**
     * _initializeSession
     */
    protected function _initializeSession()
    {
        if (version_compare(PHP_VERSION, '5.4.0') >= 0 && session_status() == PHP_SESSION_NONE)
        {
            session_start();
        }
        else if (session_id() == '')
        {
            session_start();
        }
        if (!isset($_SESSION[__CLASS__]))
        {
            $_SESSION[__CLASS__] = array();
        }
    }



    /**
     * @param string   $key
     * @param mixed    $val
     * @param null|int $ttl
     *
     * @return void
     */
    public function set($key, $val, $ttl = NULL)
    {
        $cacheEntry                = array(
            'content' => $val,
            'expires' => (($ttl === NULL) ? $ttl : time() + $ttl)
        );
        $_SESSION[__CLASS__][$key] = serialize($cacheEntry);
    }



    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        if (isset($_SESSION[__CLASS__][$key]))
        {
            $cacheEntry = unserialize($_SESSION[__CLASS__][$key]);
            if ($cacheEntry['expires'] >= time())
            {
                return $cacheEntry['content'];
            }
            unset($_SESSION[__CLASS__][$key]);
        }
        return NULL;
    }



    /**
     * @param $key
     *
     * @return void
     */
    public function flush($key)
    {
        unset($_SESSION[__CLASS__][$key]);
    }
}
