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
interface CacheInterface
{



    /**
     * @param string  $key
     * @param mixed   $val
     * @param integer $ttl
     * @return void
     */
    public function set($key, $val, $ttl = NULL);



    /**
     * @param $key
     * @return mixed|null
     */
    public function get($key);



    /**
     * @param $key
     * @return void
     */
    public function flush($key);
}

 