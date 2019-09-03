<?php

namespace SdkChaordic;

use SdkChaordic\Core\BaseSdk;
use SdkChaordic\Exceptions\SdkChaordicException;
use SdkChaordic\Library\Http;

class Collect extends BaseSdk{
    private $http;    
    
    public function __construct() {
        $this->http = new Http();
        $this->http->setBaseUrl("https://collect.chaordicsystems.com/v7/events/views/");
    }
    
    public function product($source, $deviceId, $pid, $user = null){
        $body = array(
            "apiKey" => $this->apiKey,
            "secretKey" => $this->apiSecret,
            "source" => $source,
            "deviceId" => $deviceId,
            "pid" => $pid
        );
        
        if($user){
            $body["user"] = $user;
        }
        
        $response = $this->http->post("product", [], $body);
        
        if($this->isSucess($response["code"]))
            return $response["data"];
        
        throw new SdkChaordicException("[Collect][product] " . $response["responseText"]);
    }
    
    public function cart($source, $deviceId, array $items, $user = null){
        $body = array(
            "apiKey" => $this->apiKey,
            "secretKey" => $this->apiSecret,
            "source" => $source,
            "deviceId" => $deviceId,
            "items" => $items
        );
        
        if($user){
            $body["user"] = $user;
        }
        
        $response = $this->http->post("cart", [], $body);
        
        if($this->isSucess($response["code"]))
            return $response["data"];
        
        throw new SdkChaordicException("[Collect][cart] " . $response["responseText"]);
    }
    
    public function transaction($source, $deviceId, array $items, $id, $total, $user = null){
        $body = array(
            "apiKey" => $this->apiKey,
            "secretKey" => $this->apiSecret,
            "source" => $source,
            "deviceId" => $deviceId,
            "items" => $items,
            "id" => $id
        );
        
        if($user){
            $body["user"] = $user;
        }
        
        $response = $this->http->post("transaction", [], $body);
        
        if($this->isSucess($response["code"]))
            return $response["data"];
        
        throw new SdkChaordicException("[Collect][transaction] " . $response["responseText"]);
    }
    
    public function search($source, $deviceId, array $items, $query, $user = null){
        $body = array(
            "apiKey" => $this->apiKey,
            "secretKey" => $this->apiSecret,
            "source" => $source,
            "deviceId" => $deviceId,
            "items" => $items,
            "query" => $query
        );
        
        if($user){
            $body["user"] = $user;
        }
        
        $response = $this->http->post("search", [], $body);
        
        if($this->isSucess($response["code"]))
            return $response["data"];
        
        throw new SdkChaordicException("[Collect][search] " . $response["responseText"]);
    }
    
    public function category($source, $deviceId, array $categories, $user = null){
        $body = array(
            "apiKey" => $this->apiKey,
            "secretKey" => $this->apiSecret,
            "source" => $source,
            "deviceId" => $deviceId,
            "categories" => $categories
        );
        
        if($user){
            $body["user"] = $user;
        }
        
        $response = $this->http->post("category", [], $body);
        
        if($this->isSucess($response["code"]))
            return $response["data"];
        
        throw new SdkChaordicException("[Collect][category] " . $response["responseText"]);
    }
}
