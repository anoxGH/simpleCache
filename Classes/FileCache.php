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
class FileCache implements CacheInterface
{



    /**
     * @var string
     */
    protected $cacheDirectory = '/tmp';


    /**
     * @var int
     */
    protected $ttl = 360;


    /**
     * @var int
     */
    protected $cacheDirectoryChmod = 0775;


    /**
     * var int
     */
    protected $entryFileChmod = 0664;


    /**
     * @var array
     */
    protected $entryFilenameCache = array();



    /**
     * @param string $cacheDirectory
     * @param int    $cacheDirectoryChmod
     * @throws \Exception
     */
    public function __construct($cacheDirectory = NULL, $cacheDirectoryChmod = NULL)
    {
        if ($cacheDirectory !== NULL)
        {
            $this->setCacheDirectory($cacheDirectory);
        }
        if ($cacheDirectoryChmod !== NULL)
        {
            $this->setCacheDirectoryChmod($cacheDirectoryChmod);
        }
        $this->_initializeCacheDirectory();
    }



    /**
     * @param integer $cacheDirectoryChmod
     */
    public function setCacheDirectoryChmod($cacheDirectoryChmod)
    {
        if (is_numeric($cacheDirectoryChmod))
        {
            $this->cacheDirectoryChmod = $cacheDirectoryChmod;
        }
    }



    /**
     * @param string $cacheDirectory
     */
    public function setCacheDirectory($cacheDirectory)
    {
        $this->cacheDirectory = rtrim($cacheDirectory, '/') . '/';
        $this->_initializeCacheDirectory();
    }



    /**
     * set
     *
     * @param string $key
     * @param mixed  $val
     * @param int    $ttl
     * @param int    $chmod
     */
    public function set($key, $val, $ttl = NULL, $chmod = NULL)
    {
        $entryFilename = $this->getEntryFilenameByKey($key);

        $cacheEntry = array(
            'content' => $val,
            'expires' => time() + (($ttl !== NULL) ? $ttl : $this->ttl)
        );
        file_put_contents($entryFilename, serialize($cacheEntry));
        chmod($entryFilename, ($chmod !== NULL) ? $chmod : $this->entryFileChmod);
    }



    /**
     * get
     *
     * @param string $key
     * @return null|mixed
     */
    public function get($key)
    {
        $filename = $this->getEntryFilenameByKey($key);
        if (file_exists($filename))
        {
            $cacheEntry = unserialize(file_get_contents($filename));
            if ($cacheEntry['expires'] >= time())
            {
                return $cacheEntry['content'];
            }
            unlink($filename);
        }
        return NULL;
    }



    /**
     * @return string
     */
    public function getCacheDirectory()
    {
        return $this->cacheDirectory;
    }



    /**
     * @param string $key
     * @return string
     */
    public function getEntryFilenameByKey($key)
    {
        if (isset($this->entryFilenameCache[$key]))
        {
            return $this->entryFilenameCache[$key];
        }
        return $this->entryFilenameCache[$key] = $this->getCacheDirectory() . '/' . sha1($key) . '.dat';
    }



    /**
     * @param $key
     */
    public function flush($key)
    {
        $entryFilename = $this->getEntryFilenameByKey($key);

        if (file_exists($entryFilename))
        {
            unlink($entryFilename);
        }
    }



    /**
     * initializeCacheDir
     */
    protected function _initializeCacheDirectory()
    {
        $cacheDirectory = $this->getCacheDirectory();

        if (!is_writable(dirname($cacheDirectory)))
        {
            throw new \Exception('cannot write in "' . dirname($this->getCacheDirectory()) . '": Permission denied');
        }
        if (!is_dir($cacheDirectory))
        {
            mkdir($cacheDirectory, $this->cacheDirectoryChmod, TRUE);
        }
    }

}
 