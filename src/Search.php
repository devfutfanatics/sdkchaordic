<?php

namespace SdkChaordic;

use SdkChaordic\Core\BaseSdk;

class Search extends BaseSdk{
    private $http;    
    
    public function __construct() {
        $this->http = new Http();
        $this->http->setBaseUrl("https://api.linximpulse.com/engage/search/v3/");
    }
    
    
}
