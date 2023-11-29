<?php

namespace Nimbuspackage\Nimbuspost\Module\V1;

/**
* @author  Kishan taretiya
*/
class WarehouseModule extends Module{
  
  /**
    * Get the list of all warehouse
    * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#42d8f354-c80a-47d9-9e51-49ac513818c5
    * @return object/array
    */
  public function getWarehousesList(){
    $endpoint='warehouse';
    return $this->getRequest($endpoint);
  }
  /**
    * create warehouse 
    * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#42d8f354-c80a-47d9-9e51-49ac513818c5
    * @return object/array
    */
  public function createWarehouse($warehouseDetail){
    $endpoint='warehouse/create';
    return $this->postRequest($endpoint,$warehouseDetail);
  }
  /**
    * validate token
    * @return object/array
    */
  function getRequest($endpoint){
    $this->apiKeyExist();
    return parent::getRequest($endpoint);
  }
  /**
    * validate token
    * @return object/array
    */
  function postRequest($endpoint,$post=[]){
    $this->apiKeyExist();
    return parent::postRequest($endpoint,$post);
  }
}
?>