<?php

class HttpRequest {
    
    public $method;
    public $headers;
    public $parameters;
    
    public function __construct() {
        $this->method = strtoupper($_SERVER['REQUEST_METHOD']);
        $this->headers = $this->getHttpHeaders();
        
        switch ($this->method) {
            case "GET":
                $this->parameters = $_GET; 
                break;
            case "POST":
                $this->parameters = array_merge($_GET, $POST); 
                break;
            case "PUT":
                parse_str(file_get_contents("php://input"), $this->parameters);
                break;
            case "DELETE":
                $this->parameters = $_GET; 
                break;
            default:
                break;
        }
    }
    
    public function getHttpHeaders() {
        if (!function_exists('getallheaders')) {
            function getallheaders() {
                $headers = array();
                foreach ($_SERVER as $name => $value) {
                    if (substr($name, 0, 5) == 'HTTP_') {
                        $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
                    }
                }
                return $headers;
            }
        }
        return getallheaders();
    }
    
}

?>
