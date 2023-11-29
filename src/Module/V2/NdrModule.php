<?php

namespace Nimbuspackage\Nimbuspost\Module\V2;

/**
* @author  Kishan taretiya
*/
class NdrModule extends Module{

    /**
    * Get the list of available couriers for your account
    * @reference  https://documenter.getpostman.com/view/9692837/TW6wHnoz#a22d1ac8-6b15-4a42-bebb-4e52dce1be21
    * @return object/array
    */
    public function getNdrList(array $parameter=[]){

        $endpoint=(count($parameter)==0) ? 'ndr' : 'ndr?'.http_build_query($parameter);
        return $this->getRequest($endpoint);
    }

    /**
    * Take ndr action against any AWB
    * @reference https://documenter.getpostman.com/view/9692837/TW6wHnoz#7155e42e-df2d-4832-9a24-1e9a6c9a7c90
    * @return object/array
    */
    public function ndrAction(array $payload=[]){
        $endpoint='ndr/action';
        return $this->postRequest($endpoint,$payload);
    }
    /**
    * validate token
    * @return object/array
    */
    function getRequest($endpoint){
        $this->tokenExist();
        return parent::getRequest($endpoint);
    }
    /**
    * validate token
    * @return object/array
    */
    function postRequest($endpoint,$request){
        $this->tokenExist();
        return parent::postRequest($endpoint,$request);
    }
}
?>