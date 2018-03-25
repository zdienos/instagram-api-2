<?php
/**
 * Created by PhpStorm.
 * User: ismail
 * Date: 15.03.2018
 * Time: 23:24
 */

namespace Ismailcaakir\InstagramAPI\Request;


class Request
{

    const INSTAGRAM_PUBLIC_URL = "https://www.instagram.com";

    const INSTAGRAM_PUBLIC_PARAM = "?__a=1";

    const INSTAGRAM_QUERY_VAL   = 17888483320059182;

    /**
     * Request constructor.
     */
    public function __construct()
    {

    }


    public function run($requestURL)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $requestURL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: ca9bd67d-63b6-3d87-274b-9174f4105d87"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            throw new \Exception("Internal Request Error");
        } else {
            return json_decode($response);
        }
    }

}