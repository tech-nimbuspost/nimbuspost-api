<?php

namespace Nimbuspackage\Nimbuspost\Module\V2;

/**
* @author  Kishan taretiya
*/
class ShipmentModule extends Module{

    /**
    * Get the awb tracking in bulk
    * @reference  https://documenter.getpostman.com/view/9692837/TW6wHnoz#a22d1ac8-6b15-4a42-bebb-4e52dce1be21
    * @return object/array
    */
    function bulkTrackShipment(array $payload=[]){
        $endpoint='shipments/track/bulk';
        return $this->postRequest($endpoint,$payload);
    }

    /**
    *  Get the awb tracking
    * @reference  https://documenter.getpostman.com/view/9692837/TW6wHnoz#420ad390-6c6b-4f9d-98bc-6f49c8b41120
    * @return object/array
    */
    function trackShipment(string $awb){
        $endpoint='shipments/track/'.$awb;
        return $this->getRequest($endpoint);
    }

    /**
    *  cancel shipment 
    * @reference https://documenter.getpostman.com/view/9692837/TW6wHnoz#074cda17-f8f6-491f-bb35-47274e20eee6
    * @return object/array
    */
    function cancelShipment(array $payload){
        $endpoint='shipments/cancel';
        return $this->postRequest($endpoint,$payload);
    }

    /**
    *  generate manifest
    * @reference https://documenter.getpostman.com/view/9692837/TW6wHnoz#31f3e7ea-66ce-4244-a40b-d15b191f4969
    * @return object/array
    */
    function createManifest(array $payload){
        $endpoint='shipments/manifest'; 
        return $this->postRequest($endpoint,$payload);
    }

    /**
    *  create shipment 
    * @reference https://documenter.getpostman.com/view/9692837/TW6wHnoz#3d1dd145-c6c3-4dc4-9e3a-31769e45e9ea
    * @return object/array
    */
    function createShipment(array $payload){
        $endpoint='shipments'; 
        return $this->postRequest($endpoint,$payload);
    }

     /**
    *  create hyperlocal shipment 
    * @reference https://documenter.getpostman.com/view/9692837/TW6wHnoz#b883a9c4-0e64-49e3-ad62-f096592b14a7
    * @return object/array
    */
    function createHyperlocalShipment(array $payload){
        $endpoint='shipments/hyperlocal'; 
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