<?php

namespace Ismailcaakir\Inspublic;

use Ismailcaakir\Inspublic\Helper\Cache;
use Ismailcaakir\Inspublic\Request\Account as RequestAccount;
use Ismailcaakir\Inspublic\Response\Account as ResponseAccount;

use Ismailcaakir\Inspublic\Request\Media as RequestMedia;
use Ismailcaakir\Inspublic\Response\Media as ResponseMedia;

class Instagram
{

    protected $_requestAccount;
    protected $_requestMedia;


    /** @var bool $_cacheEnable */
    protected $_cacheEnable = true;

    /** CACHE USER TYPE STRING */
    const CACHE_USER_TYPE   = "user";

    /** CACHE MEDIA TYPE STRING */
    const CACHE_MEDIA_TYPE  = "media";

    /** CACHE TAG TYPE STRING */
    const CACHE_TAG_TYPE  = "tag";

    /** CACHE ALLMEDIA TYPE STRING */
    const CACHE_ALL_MEDIA_TYPE  = "allmedia";

    /** CACHE DEFAULT TYPE STRING */
    const CACHE_DEFAULT_TYPE  = "default";


    /**
     * Instagram constructor.
     */
    public function __construct()
    {
        $this->_requestAccount = new RequestAccount();
        $this->_requestMedia = new RequestMedia();
        $this->_cache = new Cache();
    }

    /**
     * Information for Instagram User
     * @param string $username | Instagram Username
     * @return ResponseAccount | Response Account
     * @throws \Exception
     */
    public function getAccountInformation($username = null)
    {
        if(!$username){
            throw new \Exception("Username is null");
        }

        if ($this->_cacheEnable && $this->_cache->has($username,self::CACHE_USER_TYPE))
        {
            return new ResponseAccount($this->_cache->get($username,self::CACHE_USER_TYPE));
        }

        /**
         * Set by Instagram account username
         */
        $this->_requestAccount->setUsername($username);


        /** @var  ResponseAccount $response */
        $response = $this->_requestAccount->get();

        if ($this->_cacheEnable)
        {
            $this->_cache->set($username,$response,self::CACHE_USER_TYPE);
        }

        return new ResponseAccount($response);

    }

    /**
     * @param string $username
     * @param string $nextMaxId
     * @return ResponseMedia
     * @throws \Exception
     */
    public function getUserMedia($username = null,$nextMaxId = null)
    {
        if(!$username){
            throw new \Exception("Username is null");
        }

        $mediaLimit = 20;

        if ($this->_cacheEnable && $this->_cache->has($username,self::CACHE_USER_TYPE))
        {
            $account = new ResponseAccount($this->_cache->get($username,self::CACHE_USER_TYPE));
        } else {

            /**
             * Set by Instagram account username
             */
            $this->_requestAccount->setUsername($username);

            /** @var  ResponseAccount $account */
            $accountData = $this->_requestAccount->get();

            if ($this->_cacheEnable)
            {
                $this->_cache->set($username,$accountData,self::CACHE_USER_TYPE);
            }

            $account = new ResponseAccount($accountData);
        }



        /**
         * Set by Instagram account media paramaters
         */
        $this->_requestMedia->setUsernameId($account->getId());
        $this->_requestMedia->setLimit($mediaLimit);
        $this->_requestMedia->setNextMaxId($nextMaxId);

        $response = new ResponseMedia($this->_requestMedia->get());

        return $response;
    }

    /**
     * @param null $username
     * @return array
     * @throws \Exception
     */
    public function getUserMediaForAll($username = null)
    {
        if(!$username){
            throw new \Exception("Username is null");
        }

        $mediaLimit = 200;

        if ($this->_cacheEnable && $this->_cache->has($username,self::CACHE_USER_TYPE))
        {
            $account = new ResponseAccount($this->_cache->get($username,self::CACHE_USER_TYPE));
        } else {

            /**
             * Set by Instagram account username
             */
            $this->_requestAccount->setUsername($username);

            /** @var  ResponseAccount $account */
            $accountData = $this->_requestAccount->get();

            if ($this->_cacheEnable)
            {
                $this->_cache->set($username,$accountData,self::CACHE_USER_TYPE);
            }

            $account = new ResponseAccount($accountData);
        }

        /**
         * Set by Instagram account media paramaters
         */
        $this->_requestMedia->setUsernameId($account->getId());

        $next_max_id = null;
        $items = [];
        $items = [];
        try{
            do {

                $this->_requestMedia->setLimit($mediaLimit);
                $this->_requestMedia->setNextMaxId($next_max_id);

                $response = $this->_requestMedia->get();

                $data = new ResponseMedia($response);
                $next_max_id = $data->getNextMaxId();
                $items = array_merge($items, $data->getItems());

            } while (!is_null($next_max_id));
        }catch (\Exception $e){
            throw new \Exception("Error on Instagram --> {$e->getMessage()}");
        }

        return $items;
    }







}