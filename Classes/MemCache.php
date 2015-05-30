<?php
namespace AnoxGH\SimpleCache;

/**
 * Class MemCache
 *
 * @author    Sebastian Gieselmann <s.gieselmann@live.com>
 * @copyright Copyright (c) 2015, Sebastian Gieselmann
 * @package   AnoxGH\SimpleCache
 * @link      https://github.com/anoxGH/simpleCache
 * @license   http://opensource.org/licenses/GPL-2.0
 */
class MemCache implements CacheInterface
{



    /**
     * @var \Memcached
     */
    protected $memcache = NULL;


    /**
     * @var int
     */
    protected $ttl = 360;



    /**
     * @param array $servers array(0 => array($host, $port, $weight))
     */
    public function __construct(array $servers = array())
    {
        $this->memcache = new \ Memcached();
        $this->memcache->addServers($servers);
    }



    /**
     * @param string   $key
     * @param mixed    $val
     * @param null|int $ttl
     */
    public function set($key, $val, $ttl = NULL)
    {
        $this->memcache->set($key, $val, time() + (($ttl !== NULL) ? $ttl : $this->ttl));
    }



    /**
     * @param string $key
     * @return mixed|null
     */
    public function get($key)
    {
        $result = $this->memcache->get($key);
        if ($this->memcache->getResultCode() === \Memcached::RES_NOTFOUND)
        {
            return NULL;
        }
        return $result;
    }



    /**
     * @param $key
     */
    public function flush($key)
    {
        $this->memcache->delete($key);
    }

}