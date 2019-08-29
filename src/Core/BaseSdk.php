<?php

require '../Helpers/global.php';

namespace SdkChaordic\Core;

class BaseSdk {
    protected $apiKey;
    protected $apiSecret;
    
    public function setAuthorization($apiKey, $apiSecret){
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        return $this;
    }
    
}