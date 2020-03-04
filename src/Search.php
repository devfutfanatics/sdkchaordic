<?php

namespace SdkChaordic;

use SdkChaordic\Core\BaseSdk;
use SdkChaordic\Exceptions\SdkChaordicException;
use SdkChaordic\Library\Http;

class Search extends BaseSdk{
    private $http;    
    
    public function __construct() {
        $this->http = new Http();
        $this->http->setBaseUrl("https://api.linximpulse.com/engage/search/v3/");
    }
    
    public function search($terms, $page, $resultsPerPage, $sortBy, array $filters = array(), $allowRedirect = false, $productFormat = "complete", $showOnlyAvailable = true, $pids = "", $salesChannel = "", $hide = ""){
        
        $query = array(
            "apiKey" => urlencode($this->apiKey),
            "secretKey" => urlencode($this->apiSecret),
            "resultsPerPage" => urlencode($resultsPerPage),
            "page" => urlencode($page),
            "sortBy" => urlencode($sortBy),
            "terms" => urlencode($terms)
        );
        
        if(count($filters) > 0){
            $filter = array();

            foreach($filters as $index => $f){
                if($index == 0){
                    $filter[] = urlencode($f);
                }
                else{
                    $filter[] = "filter=" . urlencode($f);
                }
            }
            
            $query["filter"] = implode("&", $filter);
        }
        
        $response = $this->http->get("search", $query);
        
        if($this->isSucess($response["code"]))
            return $response["data"];
        
        throw new SdkChaordicException("[Search][search] " . $response["responseText"]);
    }
    
    public function autocomplete($prefix, $resultsQueries = 5, $resultsProducts = 5, $category = false, $productFormat = "complete", $hide = "products") {
        $query = array(
            "apiKey" => urlencode($this->apiKey),
            "secretKey" => urlencode($this->apiSecret),
            "prefix" => urlencode($prefix),
            "resultsQueries" => urlencode($resultsQueries),
            "resultsProducts" => urlencode($resultsProducts),
            "category" => urlencode($category),
            "productFormat" => urlencode($productFormat)
        );
        
        if (!empty($hide))
            $query["hide"] = urlencode($hide);
        
        $response = $this->http->get("autocompletes", $query);
        
        if($this->isSucess($response["code"]))
            return $response["data"];
        
        throw new SdkChaordicException("[Search][autocomplete] " . $response["responseText"]);
    }
}
