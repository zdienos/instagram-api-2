<?php

namespace Ismailcaakir\InstagramAPI\Request;


class Account extends Request
{

    public $username;

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }


    /**
     *
     */
    public function get()
    {
        if (!$this->getUsername())
        {
            throw new \Exception("Username is null");
        }

        $requestURL = sprintf("%s/%s/%s",parent::INSTAGRAM_PUBLIC_URL,$this->getUsername(),parent::INSTAGRAM_PUBLIC_PARAM);

        return $this->run($requestURL);
    }


}