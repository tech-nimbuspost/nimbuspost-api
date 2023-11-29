<?php

namespace Nimbuspackage\Nimbuspost\Module\V2;

use Nimbuspackage\Nimbuspost\ServerCall\Client;
use Nimbuspackage\Nimbuspost\Exceptions\NimbusException;
use Nimbuspackage\Nimbuspost\Traits\Authenticate;

/**
* @author  Kishan taretiya
*/
class Module{

    use Authenticate;
    protected $client;
    protected $token;
    protected $apitype='token';

    function __construct(Client $client, $token = null){
        $this->client=$client;
        $this->token['token']=$this->login($token);
    }

    function login($credentials){
        $response=$this->auth($this->client, $credentials);
        if(empty($response->status))
            throw new NimbusException($response->message);
        
        return $response->data;
    }
    /**
    * 
    * server call request in get method
    * @param string url endpoint
    * @return object/array
    */

    function getRequest($endpoint){

        $client=$this->client->setEndpoint($endpoint);
        if(!empty($this->token[$this->apitype]))
            $client->setHeaders($this->token[$this->apitype]);
        return $client->get();

    }

    /**
    * 
    * server call request in post method
    * @param string url endpoint,payload 
    * @return object/array
    */
    function postRequest($endpoint,$post){

        $client=$this->client->setEndpoint($endpoint);
        if(!empty($this->token[$this->apitype]))
            $client->setHeaders($this->token[$this->apitype]);
        return $client->post($post);

    }

    /**
    * check api token exist
    * @param array token
    */
    function tokenExist(){
        if(empty($this->token['token']))
            throw new NimbusException('invalid token');
    }
}
?>