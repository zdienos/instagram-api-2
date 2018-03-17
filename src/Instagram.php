<?php

namespace Ismailcaakir\Inspublic;

use Ismailcaakir\Inspublic\Request\Account as RequestAccount;
use Ismailcaakir\Inspublic\Response\Account as ResponseAccount;

class Instagram
{

    /**
     * @var Request\Account
     */
    protected $_requestAccount;

    /**
     * Instagram constructor.
     */
    public function __construct()
    {

        $this->_requestAccount = new RequestAccount();

    }



    public function getAccountInformation($username = null)
    {
        if(!$username){
            throw new \Exception("Username is null");
        }

        /**
         * Set by Instagram account username
         */
        $this->_requestAccount->setUsername($username);

        /** @var  ResponseAccount $response */
        $response = new ResponseAccount($this->_requestAccount->get());

        return $response;

    }


    public function getAllMedia($username = null,$nextMaxId = null)
    {
        // COMING 
//        if(!$username){
//            throw new \Exception("Username is null");
//        }
//
//        /**
//         * Set by Instagram account username
//         */
//        $this->_requestAccount->setUsername($username);
//
//        /** @var  ResponseAccount $response */
//        $response = new ResponseAccount($this->_requestAccount->get());
//
//        return $response;

    }







}