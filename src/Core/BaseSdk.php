<?php

namespace SdkChaordic\Core;

require __DIR__ . '/../Helpers/global.php';

class BaseSdk {
    protected $apiKey;
    protected $apiSecret;
    
    public function setAuthorization($apiKey, $apiSecret){
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        return $this;
    }
    
    public function isSucess($code){
        return in_array($code, [200, 201, 204]);
    }
}