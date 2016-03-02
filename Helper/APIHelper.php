<?php

namespace Alpixel\Bundle\CustomerBridgeBundle\Helper;

use Alpixel\Bundle\CustomerBridgeBundle\API\CustomerBridge;

class APIHelper
{
    protected $apiService;

    public function __construct ($customerKey, $customerToken) {
        $this->apiService = new CustomerBridge($customerKey, $customerToken);
    }

    public function getAPI() {
        return $this->apiService;
    }
}
