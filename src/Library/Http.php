<?php

namespace SdkChaordic\Library;

class Http {

    private $baseUrl;
    
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';
    const DELETE = 'DELETE';
    
    function getBaseUrl() {
        return $this->baseUrl;
    }

    function setBaseUrl($baseUrl) {
        $this->baseUrl = $baseUrl;
    }

    public function get($uri, array $query = array(), array $body = array(), array $header = array()) {
        if (empty($this->baseUrl)) {
            throw new Exception("Informe a Url Base.");
        }
        
        return $this->curlCall($uri, Http::GET, $body, $query, $header);
    }

    public function post($uri, array $query = array(), array $body = array(), array $header = array()) {
        if (empty($this->baseUrl)) {
            throw new Exception("Informe a Url Base.");
        }
        
        return $this->curlCall($uri, Http::POST, $body, $query, $header);
    }

    public function put($uri, array $query = array(), array $body = array(), array $header = array()) {
        if (empty($this->baseUrl)) {
            throw new Exception("Informe a Url Base.");
        }
        
        return $this->curlCall($uri, Http::PUT, $body, $query, $header);
    }

    public function delete($uri, array $query = array(), array $body = array(), array $header = array()) {
        if (empty($this->baseUrl)) {
            throw new Exception("Informe a Url Base.");
        }
        
        return $this->curlCall($uri, Http::DELETE, $body, $query, $header);
    }

    private function curlCall($url, $type, $postParams = array(), $getParams = array(), $headerParams = array()) {
        $url = $this->baseUrl . "?" . http_build_query($getParams);
        
        $header = array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($postParams))
            );
        
        $header = array_merge($header, $headerParams);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        if ($type == Http::POST) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postParams));
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_SSLVERSION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // JSON de retorno 
        $jsonRetorno = trim(curl_exec($ch));
        $resposta = json_decode($jsonRetorno);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err = curl_errno($ch);
        curl_close($ch);

        return array(
            "responseText" => $jsonRetorno,
            "code" => $code,
            "data" => $resposta,
            "err" => curlError($err)
        );
    }

}
