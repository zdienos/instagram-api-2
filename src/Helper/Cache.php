<?php

namespace Ismailcaakir\Inspublic\Helper;
use Ismailcaakir\Inspublic\Instagram;

/**
 * Class Cache
 *
 * Inspublic paketine ozel cache yonetim classi
 * @alert Bu Class ile pakete ait veriler dosya olarak tutulur. Class sadece pakete ozel olarak gelistirilmistir.
 * @author github.com/ismailcaakir
 * @package Ismailcaakir\Inspublic
 */
class Cache
{
    /** @var string  */
    private $_cacheDir = "cache";

    /** @var int|null  */
    private $_cacheLifeTime = 3600;

    /** @var string  */
    private $_cacheExtensions = ".data";

    /** @var array  */
    private $_types = [
        Instagram::CACHE_USER_TYPE,
        Instagram::CACHE_ALL_MEDIA_TYPE,
        Instagram::CACHE_MEDIA_TYPE,
        Instagram::CACHE_TAG_TYPE,
        Instagram::CACHE_DEFAULT_TYPE
    ];

    /**
     * Cache constructor.
     */
    public function __construct($cacheDir = null,$cacheLifeTime = null)
    {

        if (!is_null($cacheDir))
        {
            $this->_cacheDir = $cacheDir;
        } else {
            $this->_cacheDir = dirname( __DIR__,1).DIRECTORY_SEPARATOR.$this->_cacheDir;
        }

        if (!is_null($cacheLifeTime))
        {
            $this->_cacheLifeTime = $cacheLifeTime;
        }

    }

    /**
     * Cache kayit var mi kontrolu yapar
     * @param null $cacheName
     * @param string $type
     * @return bool
     * @throws \Exception
     */
    public function has($cacheName = null, $type = "default")
    {
        if (is_null($cacheName) && !in_array($type,$this->_types))
        {
            throw new \Exception("Cache name is null or type not found");
        }

        if (!file_exists($this->getCacheDir().DIRECTORY_SEPARATOR.$type.DIRECTORY_SEPARATOR.$cacheName.$this->_cacheExtensions))
        {
            return false;
        }

        return true;
    }

    /**
     * Cache'den kayitli veriyi alir
     * @param null $cacheName
     * @param string $type
     * @return bool|mixed
     * @throws \Exception
     */
    public function get($cacheName = null,$type = "default")
    {
        if (is_null($cacheName) && !in_array($type,$this->_types))
        {
            throw new \Exception("Cache name is null or type not found");
        }

        if ($this->has($cacheName,$type))
        {
            return json_decode(file_get_contents($this->getCacheDir().DIRECTORY_SEPARATOR.$type.DIRECTORY_SEPARATOR.$cacheName.$this->_cacheExtensions));
        }

        return false;

    }

    /**
     * Cache kayiti olusturur var ise gunceller.
     * @param $cacheName
     * @param $data
     * @param string $type
     * @throws \Exception
     */
    public function set($cacheName,$data,$type = "default")
    {
        $fileName = $this->getCacheDir().DIRECTORY_SEPARATOR.$type.DIRECTORY_SEPARATOR.$cacheName.$this->_cacheExtensions;

        $this->storeFile($fileName,json_encode($data));
    }

    /**
     * Cache dosyasini olusturma ve guncelleme islemlerini yapar.
     * @param string $fileName
     * @param array|string $data
     * @return bool|int
     * @throws \Exception
     */
    private function storeFile($fileName = null,$data = null)
    {
        if (is_null($fileName) && is_null($data))
        {
            throw new \Exception("File name or data is null");
        }

        $proccess = file_put_contents($fileName,$data);

        if (!$proccess)
        {
            throw new \Exception("File can't create");
        }

        return $proccess;
    }

    /**
     * Cache dosyalarinin kaydedilecegi klasoru dondurur.
     * @return string
     */
    public function getCacheDir()
    {
        $this->makeCacheDir();
        return $this->_cacheDir;
    }

    /**
     * $this->getCacheDir fonksiyonu icin olusturulmayan klasoru olusturur.
     * @throws \Exception
     */
    private function makeCacheDir()
    {
        try{
            if (!is_dir($this->_cacheDir))
            {
                mkdir($this->_cacheDir,0700);
            }
            foreach ($this->_types as $type)
            {
                if(!$this->checkCacheDir($type))
                {
                    var_dump("asd");
                    mkdir($this->_cacheDir.DIRECTORY_SEPARATOR.$type,0700);
                }
            }
        }catch (\Exception $e){
            throw new \Exception("Cache Folder Error --> {$e->getMessage()}");
        }
    }

    /**
     * Cache klasorunun kontrolunu saglar
     * @return bool
     */
    private function checkCacheDir($type = null)
    {
        if (!is_null($type))
        {
            return is_dir($this->_cacheDir.DIRECTORY_SEPARATOR.$type);
        }

        $checked = true;

        foreach ($this->_types as $type)
        {
            if (!is_dir($this->_cacheDir.DIRECTORY_SEPARATOR.$type))
            {
                $checked = false;
            }
        }

        return $checked;
    }


}