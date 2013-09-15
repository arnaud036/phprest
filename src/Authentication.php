<?php

interface Authenticable {
    public function authenticate();
}

class BasicAuthentication 
    implements Authenticable {
    
    //TO DO: Add credential in a config file.
    const USERNAME = "****";
    const PASSWORD = "****";

    public function authenticate() {
        return $this->getBasicUsername() == self::USERNAME && $this->getBasicPassword() == self::PASSWORD;
    }
    
    private function getBasicUsername() {
        return isset($_SERVER['PHP_AUTH_USER']) ? $_SERVER['PHP_AUTH_USER'] : null;
    }
    
    private function getBasicPassword() {
        return isset($_SERVER['PHP_AUTH_PW']) ? $_SERVER['PHP_AUTH_PW'] : null;
    }
}

class Authenticator {
    
    private $strategy;
    
    public function __construct($strategy) {
        $this->strategy = $strategy;
    }
    
    public function authenticate() { 
        return $this->strategy->authenticate();
    }
}

?>
