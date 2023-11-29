<?php

namespace Nimbuspackage\Nimbuspost\Module\V2;

use Nimbuspackage\Nimbuspost\ServerCall\Client;
/**
* @author  Kishan taretiya
*/
class CourierModule extends Module{
  
  /**
    * Get the list of available couriers for your account
    * @reference  https://documenter.getpostman.com/view/9692837/TW6wHnoz#2665632a-c9b6-419b-a696-dc599f3affa1
    * @return object/array
    */
  public function getCouriersList(){

    $endpoint='courier';
    return $this->getRequest($endpoint);
  }

  /**
    * Get the list of all available pincode with serviceability. 
    * @reference  https://documenter.getpostman.com/view/9692837/TW6wHnoz#e4c0510d-6380-4fca-966e-1f6822ca922f
    * @return object/array
    */
  public function courierServiceable(){

    $endpoint='courier/serviceability';
    
    return $this->getRequest($endpoint);
  }

  /**
    * Check serviceablity and get Freight Charges between origin and destination pincodes. 
    * @param array 
    * @payload reference  https://documenter.getpostman.com/view/9692837/TW6wHnoz#4dc571fd-6edb-4e59-a1c4-7ed39e9cc2f0
    * @return object/array
    */
  public function getCourierServiceability(array $request){

    $endpoint='courier/serviceability';
    
    return $this->postRequest($endpoint,$request);
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