<?php
namespace AnoxGH\SimpleCache;

/**
 * Class FileCache
 *
 * @author    Sebastian Gieselmann <s.gieselmann@live.com>
 * @copyright Copyright (c) 2015, Sebastian Gieselmann
 * @package   AnoxGH\SimpleCache
 * @link      https://github.com/anoxGH/simpleCache
 * @license   http://opensource.org/licenses/GPL-2.0
 */
class ApcCache implements CacheInterface
{



    /**
     * @var int
     */
    protected $ttl = 360;



    /**
     * @throws \Exception
     */
    public function __construct()
    {
        if (!extension_loaded('apc') || !ini_get('apc.enabled'))
        {
            throw new \Exception('APC disabled!');
        }
    }



    /**
     * @param string  $key
     * @param mixed   $val
     * @param integer $ttl
     *
     * @return void
     */
    public function set($key, $val, $ttl = NULL)
    {
        apc_store($key, serialize($val), (($ttl !== NULL) ? $ttl : $this->ttl));
    }



    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key)
    {
        $value = apc_fetch($key, $success);
        return $success ? unserialize($value) : NULL;
    }



    /**
     * @param $key
     *
     * @return void
     */
    public function flush($key)
    {
        apc_delete($key);
    }


}