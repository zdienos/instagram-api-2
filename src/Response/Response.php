<?php

namespace Ismailcaakir\InstagramAPI\Response;


class Response
{
    public $_statusCode;

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->_statusCode;
    }

    /**
     * @param mixed $statusCode
     */
    public function setStatusCode($statusCode)
    {
        $this->_statusCode = $statusCode;
    }


}