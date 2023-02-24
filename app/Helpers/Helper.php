<?php

namespace App\Helpers;


use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * use guzzle to send requests to 3rd party api
 */
if(!function_exists('sendRequest'))
{
    function sendRequest(string $url, $method = "GET")
    {
        $guzzle = new Client();
        $response = $guzzle->get($url);

        return json_decode($response->getBody()->getContents());
    }
}

