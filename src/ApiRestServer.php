<?php

require_once 'HttpRequest.php';
require_once 'HttpResponse.php';

class ApiRestServer {
    
    private $httpRequest;
    private $httpResponse;
    
    public function __construct() {
        $this->httpRequest = new HttpRequest;
        $this->httpResponse = new HttpResponse;
    }
    
    public function processRequest() {
      
        if (isset($this->httpRequest->parameters['controller']) && !empty($this->httpRequest->parameters['controller'])) {
            $controllerName = $this->httpRequest->parameters['controller'];
            unset($this->httpRequest->parameters['controller']);
        } else {
            HttpResponse::sendResponse(404);
        }
        
        $controllerClass = $this->getControllerClass($controllerName);
        if ($controllerClass == null) {
            HttpResponse::sendResponse(404);
        } 
        
        try {
            $controller = new ReflectionClass($controllerClass);
        } catch (ReflectionException $e) {
            HttpResponse::sendResponse(404);
        }
        
        if (isset($this->httpRequest->parameters['action']) && !empty($this->httpRequest->parameters['action'])) {
            $action = $this->httpRequest->parameters['action'];
            unset($this->httpRequest->parameters['action']);
        } else {
            HttpResponse::sendResponse(404);
        }
        
        try {
            $method = $controller->getMethod($action);
        } catch (ReflectionException $e) {
            HttpResponse::sendResponse(404);
        }
        
        $instance = $controller->newInstance($this->httpRequest, $this->httpResponse);
        $method->invoke($instance);
        
        $this->httpResponse->send();
    }
    
    private function getControllerClass($name) { 
        $expectedControllerClass = $name . 'Controller';
        foreach (glob(APP_PATH . '/controllers/*.php', GLOB_NOSORT) as $filename) {
            $controllerName = basename($filename, '.php') ;
            if (strnatcasecmp($controllerName, $expectedControllerClass) == 0) {
                //TODO: Use autoload.
                require_once APP_PATH . '/controllers/' . basename($filename);
                return $controllerName;
            }
        }
        return null;
    }
    
}

?>
