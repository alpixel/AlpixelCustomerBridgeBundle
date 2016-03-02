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

    public function getJiraTickets() {
        return $this->_call('get', 'jira/issues');
    }

    protected function _call($method, $query, $params = [])
    {
        try {
            $callURL = self::ENDPOINT.'/'.$query;
            $call = $this->request(strtolower($method), $callURL, [
                'query' => array_merge($params, [
                    'project' => $this->projectName,
                    'token' => $this->token,
                ]),
            ]);

            $response = [
                'statusCode' => $call->getStatusCode(),
                'data' => @json_decode((string) $call->getBody(), true),
            ];
        }
        catch (ClientException $e) {
            $response = $e->getResponse();
        }
        return $response;
    }

}
