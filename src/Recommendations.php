<?php

namespace SdkChaordic;

use SdkChaordic\Core\BaseSdk;
use SdkChaordic\Exceptions\SdkChaordicException;
use SdkChaordic\Library\Http;

class Recommendations extends BaseSdk{
    private $http;    
    
    public function __construct() {
        $this->http = new Http();
        $this->http->setBaseUrl("https://recs.chaordicsystems.com/v0/");
    }
    
    public function pages($name, $source, $deviceId, $productFormat, $categoryId = null, $productId = null){
        $query = array(
            "apiKey" => urlencode($this->apiKey),
            "secretKey" => urlencode($this->apiSecret),
            "name" => urlencode($name),
            "source" => urlencode($source),
            "deviceId" => urlencode($deviceId),
            "productFormat" => urlencode($productFormat)
        );
        
        if($categoryId){
            if(is_array($categoryId)){
                $categories = array();

                foreach($categoryId as $index => $f){
                    if($index == 0){
                        $categories[] = urlencode($f);
                    }
                    else{
                        $categories[] = "categoryId=" . urlencode($f);
                    }
                }
                
                $query["categoryId"] = implode("&", $categories);
                
            }
            else{
                $query["categoryId"] = $categoryId;
            }
        }
        
        if($productId){
            if(is_array($productId)){
                $products = array();

                foreach($productId as $index => $f){
                    if($index == 0){
                        $products[] = urlencode($f);
                    }
                    else{
                        $products[] = "productId=" . urlencode($f);
                    }
                }
                
                $query["productId"] = implode("&", $products);
                
            }
            else{
                $query["productId"] = $productId;
            }
        }
        
        $response = $this->http->get("pages/recommendations", $query);
        
        if($this->isSucess($response["code"]))
            return $response["data"];
        
        throw new SdkChaordicException("[Recommendations][pages] " . $response["responseText"]);
    }
}
