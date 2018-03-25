<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 25.03.2018
 * Time: 17:38
 */

namespace Ismailcaakir\InstagramAPI\Helper;


use Ismailcaakir\InstagramAPI\Response\Media;
use Ismailcaakir\InstagramAPI\Response\MediaItem;
use Ismailcaakir\InstagramAPI\Instagram;

trait Downloadable
{

    protected $_file = null;

    protected $_prefixFolder = null;

    protected $_storage = "storage";

    protected $_storageType = null;

    protected $_mediaRequest = null;

    /**
     * Dosyayı sunucuya indirmek için hazırlar.
     * @return null|string
     * @throws \Exception
     */
    public function download()
    {
        $this->_storage = dirname( __DIR__,1).DIRECTORY_SEPARATOR.$this->_storage;

        switch ($this->getType())
        {
            case "GraphImage":
                return $this->saveImage();
                break;
            case "GraphVideo":
                return $this->saveVideo();
                break;
            default:
                return null;
                break;
        }
    }

    /**
     * Dosya image ise indirir.
     * @return string
     * @throws \Exception
     */
    private function saveImage()
    {
        if ($this->getType() != "GraphImage")
        {
            throw new \Exception("{$this->getUrl()} is not image");
        }

        $this->_file = $this->getDisplayUrl();

        $this->_prefixFolder = $this->getOwner()->getId();

        $this->_storageType = $this->getType();

        return $this->save();
    }

    /**
     * Dosya video ise indirir.
     * @return string
     * @throws \Exception
     */
    private function saveVideo()
    {
        if ($this->getType() != "GraphVideo")
        {
            throw new \Exception("{$this->getUrl()} is not video");
        }

        if ($this->getVideoUrl())
        {
            $this->_file = $this->getVideoUrl();
        } else {
            $this->_file = $this->findVideoUrl();
        }

        $this->_prefixFolder = $this->getOwner()->getId();

        $this->_storageType = $this->getType();

        return $this->save();
    }

    /**
     * Dosyayı sunucuya indirir.
     * @return string
     * @throws \Exception
     */
    private function save()
    {
        if (!isset($this->_file))
        {
            throw new \Exception("file not found");
        }

        $fileName = $this->getStorageDir();

        if (php_sapi_name() == "cli") {
            echo "dowloanding {$this->getShortcode()} %%%%%%%%%%%% \n";
        }

        $dwFile = $this->_storage.DIRECTORY_SEPARATOR.$this->_prefixFolder.DIRECTORY_SEPARATOR.$this->_storageType.DIRECTORY_SEPARATOR.$this->getShortcode().$this->getFileType();
        copy($this->_file, $dwFile);

        if (php_sapi_name() == "cli") {
            echo "dowloanded {$this->getShortcode()} %%%%%%%%%%%% \n";
            echo "========================= \n";
        }

        return $dwFile;
    }

    /**
     * Dosya türünü döndürür.
     * @return string
     */
    private function getFileType()
    {
        return ".".pathinfo($this->_file, PATHINFO_EXTENSION);
    }

    /**
     * Video url bulunamaz ise detay sayfasına istekte bulunarak video url getirir.
     * @return null
     * @throws \Exception
     */
    private function findVideoUrl()
    {
        $this->_mediaRequest = new \Ismailcaakir\InstagramAPI\Request\MediaItem();

        $this->_mediaRequest->setShortCode($this->getShortcode());

        $video_url = new MediaItem($this->_mediaRequest->get()->graphql->shortcode_media);

        return $video_url->getVideoUrl();
    }

    /**
     * Cache dosyalarinin kaydedilecegi klasoru dondurur.
     * @return string
     */
    protected function getStorageDir()
    {
        $this->makeStorageDir();
        return $this->_storage;
    }

    /**
     * $this->getCacheDir fonksiyonu icin olusturulmayan klasoru olusturur.
     * @throws \Exception
     */
    private function makeStorageDir()
    {

        try{
            if (!is_dir($this->_storage))
            {
                mkdir($this->_storage,0700);
            }

            if (!is_dir($this->_storage.DIRECTORY_SEPARATOR.$this->_prefixFolder))
            {
                mkdir($this->_storage.DIRECTORY_SEPARATOR.$this->_prefixFolder,0700);
            }

            if (!is_dir($this->_storage.DIRECTORY_SEPARATOR.$this->_prefixFolder.DIRECTORY_SEPARATOR.$this->_storageType))
            {
                mkdir($this->_storage.DIRECTORY_SEPARATOR.$this->_prefixFolder.DIRECTORY_SEPARATOR.$this->_storageType,0700);
            }

        }catch (\Exception $e){
            throw new \Exception("Storage Folder Error --> {$e->getMessage()}");
        }
    }

    /**
     * Cache klasorunun kontrolunu saglar
     * @return bool
     */
    private function checkStorageDir($type = null)
    {
        return is_dir($this->_storage.DIRECTORY_SEPARATOR.$this->_prefixFolder);
    }
    
}