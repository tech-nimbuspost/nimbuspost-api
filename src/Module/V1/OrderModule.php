<?php

namespace Nimbuspackage\Nimbuspost\Module\V1;

/**
* @author  Kishan taretiya
*/
class OrderModule extends Module{
  
  /**
    * Get the list of all orders
    * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#56be4ac5-b5d3-4fb5-82e0-04990447cfc7
    * @return object/array
    */
  public function getOrdersList(array $parameter=[]){
    $endpoint=(count($parameter)==0) ? 'orders' : 'orders?'.http_build_query($parameter);
    return $this->getRequest($endpoint);
  }

  /**
    * get specific order by nimbus order id
    * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#c8a87162-3088-4fb2-a1fe-8c634361f5b7
    * @return object/array
    */
  public function getSpecificOrder(string $orderId){
    $endpoint='orders/'.$orderId;
    return $this->getRequest($endpoint);
  }

  /**
    * cancel specific order 
    * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#fb04f1d2-feef-43fd-b5ee-a559d0290bc5
    * @return object/array
    */
  public function cancelOrder(string $orderId){
    $endpoint='orders/cancel';
    return $this->postRequest($endpoint,['id'=>(int) $orderId]);
  }

  /**
    * create custom order
    * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#1318e2f9-0ef6-4571-a71f-da4d22b665bd
    * @return object/array
    */
  public function createOrder(array $order){
    $endpoint='orders/create';
    return $this->postRequest($endpoint,$order);
  }

  /**
    * create autoship order
    * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#e345df1e-5b5e-4042-ab9c-26028e22c9af
    * @return object/array
    */
  public function createAutoshipOrder(array $order){
    $endpoint='orders/autoship_order';
    return $this->postRequest($endpoint,$order);
  }

  /**
    * generate AWB
    * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#deabf7ad-03bc-4e09-a773-482d569fe153
    * @return object/array
    */
  public function shipByOrderId(array $order){
    $endpoint='orders/ship';
    return $this->postRequest($endpoint,$order);
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