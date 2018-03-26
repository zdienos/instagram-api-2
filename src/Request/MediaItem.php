<?php

namespace Ismailcaakir\InstagramAPI\Request;


class MediaItem extends Request
{

    protected $code;

    /**
     * @return mixed
     */
    public function getShortCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $username_id
     */
    public function setShortCode($code)
    {
        $this->code = $code;
    }


    /**
     *
     */
    public function get()
    {
        if (!$this->getShortCode())
        {
            throw new \Exception("Code id is null");
        }

        $requestURL = sprintf(
                "%s/p/%s/%s",
                parent::INSTAGRAM_PUBLIC_URL,
                $this->getShortCode(),
                parent::INSTAGRAM_PUBLIC_PARAM
            );

        return $this->run($requestURL);
    }

}