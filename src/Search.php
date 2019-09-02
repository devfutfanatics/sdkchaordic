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
            "apiKey" => $this->apiKey,
            "secretKey" => $this->apiSecret,
            "resultsPerPage" => $resultsPerPage,
            "page" => $page,
            "sortBy" => $sortBy,
            "terms" => $terms
        );
        
        if(count($filters) > 0){
            $filter = array();

            foreach($filters as $index => $f){
                if($index == 0){
                    $filter[] = $f;
                }
                else{
                    $filter[] = "filter=" . $f;
                }
            }
            
            $query["filter"] = implode("&", $filter);
        }
        
        $response = $this->http->get("search", $query);
        
        if($this->isSucess($response["code"]))
            return $response["data"];
        
        throw new SdkChaordicException("[Search][search] " . $response["responseText"]);
    }
}
