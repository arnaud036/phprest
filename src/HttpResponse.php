<?php

class HttpResponse {
    
    private $status;
    private $body;
    private $contentType;
    
    public function __construct() { 
        $this->status = 200;
        $this->body = '';
        $this->contentType = 'text/html';
    }
    
    public function setStatus($status) {
        $this->status = $status;
    }
    
    public function setBody($body) {
        $this->body = $body;
    }
    
    public function setContentType($contentType) {
        $this->contentType = $contentType;
    }
    
    public function send() {
        self::sendResponse($this->status, $this->body, $this->contentType);
    }
    
    public static function sendResponse($status = 200, $body = '', $contentType = 'text/html') {
        header("HTTP", true, $status);
        header('Content-type: ' . $contentType);
        
        echo $body;
        exit;
    }   
            
}

?>
