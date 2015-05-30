<?php
namespace AnoxGH\SimpleCache;

/**
 * Class MemoryCache
 *
 * @author    Sebastian Gieselmann <s.gieselmann@live.com>
 * @copyright Copyright (c) 2015, Sebastian Gieselmann
 * @package   AnoxGH\SimpleCache
 * @link      https://github.com/anoxGH/simpleCache
 * @license   http://opensource.org/licenses/GPL-2.0
 */
class MemoryCache implements CacheInterface
{



    /**
     * @var int
     */
    protected $ttl = 360;


    /**
     * @var array
     */
    protected $cache = array();



    /**
     * @param string   $key
     * @param mixed    $val
     * @param null|int $ttl
     *
     * @return void
     */
    public function set($key, $val, $ttl = NULL)
    {
        $cacheEntry        = array(
            'content' => $val,
            'expires' => (($ttl === NULL) ? $ttl : time() + $ttl)
        );
        $this->cache[$key] = $cacheEntry;
    }



    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        if (isset($this->cache[$key]))
        {
            $cacheEntry = ($this->cache[$key]);
            if ($cacheEntry['expires'] >= time())
            {
                return $cacheEntry['content'];
            }
            unset($this->cache[$key]);
        }
        return NULL;
    }



    /**
     * @param $key
     * @return void
     */
    public function flush($key)
    {
        unset($this->cache[$key]);
    }


}