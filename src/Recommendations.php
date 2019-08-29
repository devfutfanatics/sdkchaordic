<?php

namespace SdkChaordic;

use SdkChaordic\Core\BaseSdk;
use SdkChaordic\Library\Http;

class Recommendations extends BaseSdk{
    private $http;    
    
    public function __construct() {
        $this->http = new Http();
        $this->http->setBaseUrl("https://recs.chaordicsystems.com/v0/");
    }
    
    public function pages($name, $source, $deviceId, $productFormat){
        $response = $this->http->get("pages/recommendations", array(
            "apiKey" => $this->apiKey,
            "secretKey" => $this->apiSecret,
            "name" => $name,
            "source" => $source,
            "deviceId" => $deviceId,
            "productFormat" => $productFormat
        ));
        
        if($this->isSucess($response["code"]))
            return $response["data"];
        
        throw new SdkChaordicException("[Recommendations][pages] " . $response["text"]);
    }
    
}
