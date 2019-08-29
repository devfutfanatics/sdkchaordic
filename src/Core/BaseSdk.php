<?php

namespace SdkChaordic\Core;

require '../Helpers/global.php';

class BaseSdk {
    protected $apiKey;
    protected $apiSecret;
    
    public function setAuthorization($apiKey, $apiSecret){
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        return $this;
    }
    
}