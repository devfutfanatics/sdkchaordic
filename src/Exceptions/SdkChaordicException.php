<?php

namespace SdkChaordic\Exceptions;

use Exception;

class SdkChaordicException extends Exception{
    
    
    
    public function __construct(string $message = "", int $code = 0, \Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}
