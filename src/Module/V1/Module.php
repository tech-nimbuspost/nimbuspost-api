<?php

namespace Nimbuspackage\Nimbuspost\Module\V1;

use Nimbuspackage\Nimbuspost\ServerCall\Client;
use Nimbuspackage\Nimbuspost\Exceptions\NimbusException;

/**
* @author  Kishan taretiya
*/
class Module{
    
    protected $client;
    protected $token;
    protected $apitype='key';

    function __construct(Client $client, $token = null){
        $this->client=$client;
        $this->token=$token;
        
    }
    /**
    * 
    * server call request in get method
    * @param string url endpoint
    * @return object/array
    */

    function getRequest($endpoint){

        $client=$this->client;
        if(!empty($this->token[$this->apitype]))
            $client->setOldHeaders($this->token[$this->apitype]);
        $client->setEndpoint($endpoint);
        return $client->get();

    }

    /**
    * 
    * server call request in post method
    * @param string url endpoint,payload 
    * @return object/array
    */
    function postRequest($endpoint,$post=[]){

        $client=$this->client;
        if(!empty($this->token[$this->apitype]))
            $client->setOldHeaders($this->token[$this->apitype]);
        $client->setEndpoint($endpoint);
        return $client->post($post);

    }


    /**
    * check api key exist
    * @param array token
    */
    function apiKeyExist(){
        if(empty($this->token['key']))
            throw new NimbusException('invalid api key');
    }
}
?>