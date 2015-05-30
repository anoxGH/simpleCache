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

    public function set($key, $val, $ttl = NULL);
    public function get($key);
    public function flush($key);
}

 