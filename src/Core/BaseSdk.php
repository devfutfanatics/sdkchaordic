<?php

namespace SdkChaordic\Core;

class BaseSdk {
    protected $apiKey;
    protected $apiSecret;
    
    protected function setAuthorization($apiKey, $apiSecret){
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
    }
    
}