<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 18.03.2018
 * Time: 01:32
 */

namespace Ismailcaakir\InstagramAPI\Request;


class Media extends Request
{

    protected $username_id;
    protected $nextMaxId = null;
    protected $limit = null;

    /**
     * @return mixed
     */
    public function getUsernameId()
    {
        return $this->username_id;
    }

    /**
     * @param mixed $username_id
     */
    public function setUsernameId($username_id)
    {
        $this->username_id = $username_id;
    }


    /**
     *
     */
    public function get()
    {
        if (!$this->getUsernameId())
        {
            throw new \Exception("Username id is null");
        }

        $requestURL = sprintf(
                '%s/graphql/query/?query_id=%s&variables={"id":"%s","first":%s,"after":"%s"}',
                parent::INSTAGRAM_PUBLIC_URL,
                parent::INSTAGRAM_QUERY_VAL,
                $this->getUsernameId(),
                $this->getLimit(),
                $this->getNextMaxId()
            );

        return $this->run($requestURL);
    }

    /**
     * @param null $nextMaxId
     */
    public function setNextMaxId($nextMaxId)
    {
        $this->nextMaxId = $nextMaxId;
    }

    /**
     * @param null $limit
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
    }

    /**
     * @return null
     */
    public function getNextMaxId()
    {
        return $this->nextMaxId;
    }

    /**
     * @return null
     */
    public function getLimit()
    {
        return $this->limit;
    }


}