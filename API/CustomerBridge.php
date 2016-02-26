<?php

namespace Alpixel\Bundle\CustomerBridgeBundle\API;

use GuzzleHttp\Exception\ClientException;

class CustomerBridge extends \GuzzleHttp\Client
{

    const API_VERSION = "1.0";
    const ENDPOINT = "https://alpixel-customer-bridge.herokuapp.com/api";

    protected $projectName;
    protected $token;

    public function __construct ($projectName, $token) {
        $this->projectName = $projectName;
        $this->token = $token;
        parent::__construct(['defaults' => [
            'headers' => [
                'user-agent' => 'alpixel-customer-bridge/' . phpversion() . '/' . self::API_VERSION
            ]
        ]]);
    }

    protected function _call($method, $query, $params)
    {
        try {
            $callURL = self::ENDPOINT.'/'.$query;
            $call    = $this->send($this->createRequest(strtolower($method), $callURL, [
                'query' => $params
            ]));
            $response = [
                'statusCode' => $call->getStatusCode(),
                'data'       => $call->json(),
            ];
        }
        catch (ClientException $e) {
            $response = $e->getResponse();
        }
        return $response;
    }

}
