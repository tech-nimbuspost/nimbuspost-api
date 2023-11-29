<?php

namespace Nimbuspackage\Nimbuspost\Module\V1;

/**
* @author  Kishan taretiya
*/
class ShipmentModule extends Module{
  
 
  /**
  * Get the list of all shipments
  * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#56be4ac5-b5d3-4fb5-82e0-04990447cfc7
  * @return object/array
  */
  public function getShipmentsList(array $parameter=[]){
    $endpoint=(count($parameter)==0) ? 'shipments' : 'shipments?'.http_build_query($parameter);
    return $this->getRequest($endpoint);
  }

  /**
    * get specific shipment
    * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#c8a87162-3088-4fb2-a1fe-8c634361f5b7
    * @return object/array
    */
  public function getSpecificShipment(string $shipmentId){
    $endpoint='shipments/'.$shipmentId;
    return $this->getRequest($endpoint);
  }

  /**
    * create pickup request
    * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#8923e517-b823-4def-b132-490d753406a0
    * @return object/array
    */
  public function createPickup(array $shipmentIds){
    $endpoint='/shipments/pickups';
    return $this->postRequest($endpoint,$shipmentIds);
  }
  /**
    * create pickup request
    * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#8923e517-b823-4def-b132-490d753406a0
    * @return object/array
    */
  public function createShipmentsLabel(array $shipmentIds){
    $endpoint='/shipments/label';
    return $this->postRequest($endpoint,$shipmentIds);
  }
  /**
    * tracking by shipment id
    * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#d80b0afb-53ac-4c0f-bb3e-0c340b0aa049
    * @return object/array
    */
  public function trackingByShipmentId(string $shipmentId){
    $endpoint='/shipments/track/'.$shipmentId;
    return $this->getRequest($endpoint);
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