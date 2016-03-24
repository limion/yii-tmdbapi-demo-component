<?php

namespace TmdbDemoComponent;

use TmdbDemo\Api;

/* 
 * Proxy component for TmdbDemo\Api library
 * @author vlad.holovko@gmail.com
 */
class TmdbProxy extends \CApplicationComponent {
    
    public $clientOptions = [];
    
    private $_client;
    
    public function __call($name, $parameters) 
    {
        if(method_exists($this->getClient(),$name)) {
            return call_user_func_array(array($this->getClient(),$name),$parameters);
        }
        parent::__call($name,$arguments);
    }
    
    public function getClient()
    {
        if(null === $this->_client) {
            $this->_client = new Api($this->clientOptions);
        }
        return $this->_client;
    }
    
    public function getApiKey()
    {
        return $this->getClient()->apiKey;
    }
    
    public function setApiKey($apiKey)
    {
        $this->getClient()->apiKey = $apiKey;
        return $this;
    }
    
}
