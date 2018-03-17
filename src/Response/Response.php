<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 16.03.2018
 * Time: 00:00
 */

namespace Ismailcaakir\Inspublic\Response;


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