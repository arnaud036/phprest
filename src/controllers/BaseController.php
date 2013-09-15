<?php

abstract class BaseController {
    
    protected $httpRequest;
    protected $httpResponse;
    
    public function __construct($httpRequest, $httpResponse) {
        $this->httpRequest = $httpRequest;
        $this->httpResponse = $httpResponse;
    }
    
    public function authenticate() {
        return true;
    }
    
}

?>
