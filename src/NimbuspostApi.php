<?php

namespace Nimbuspackage\Nimbuspost;

use Nimbuspackage\Nimbuspost\ServerCall\NimbuspostClient;
use Nimbuspackage\Nimbuspost\Exceptions\NimbusException;
use Nimbuspackage\Nimbuspost\Module\V2\CourierModule;
use Nimbuspackage\Nimbuspost\Module\V2\NdrModule;
use Nimbuspackage\Nimbuspost\Module\V2\ShipmentModule;
use Nimbuspackage\Nimbuspost\Module\V1\ShipmentModule as v1ShipmentModule;
use Nimbuspackage\Nimbuspost\Module\V1\OrderModule;
use Nimbuspackage\Nimbuspost\Module\V1\WarehouseModule;

class NimbuspostApi
{
    protected $client;
    protected $token;
    

    public function __construct(array $token=[])
    { 
        $client=new NimbuspostClient;
        $this->client = $client;
        $this->token = $token;
    }

    /**
     * set the response type
     *
     * @param string $type ['object','array']
     * @return null
     */
    public function setResponseType(string $type)
    { 
        if(in_array($type,['object','array']))
            $this->client->responseType($type);
        else
            throw new NimbusException('invalid response type');
    }

    /**
     * get courier list
     * @reference https://documenter.getpostman.com/view/9692837/TW6wHnoz#2665632a-c9b6-419b-a696-dc599f3affa1
     * @return 'object/array'
     */
    public function getCouriers(){
        $courier=new CourierModule($this->client,$this->token);
        return $courier->getCouriersList();
    }

    /**
     * get couriers serviceable list
     * @reference https://documenter.getpostman.com/view/9692837/TW6wHnoz#e4c0510d-6380-4fca-966e-1f6822ca922f
     * @return 'object/array'
     */
    public function getCouriersServiceable(){
        $courier=new CourierModule($this->client,$this->token);
        return $courier->courierServiceable();
    }

    /**
     * get couriers serviceablility list with freight charges between origin and destination pincodes
     * @reference https://documenter.getpostman.com/view/9692837/TW6wHnoz#4dc571fd-6edb-4e59-a1c4-7ed39e9cc2f0
     * @return 'object/array'
     */
    public function getCourierServiceability(array $payload){
        $courier=new CourierModule($this->client,$this->token);
        return $courier->getCourierServiceability($payload);
    }

     /**
     * get ndr list
     * @reference https://documenter.getpostman.com/view/9692837/TW6wHnoz#a22d1ac8-6b15-4a42-bebb-4e52dce1be21
     * @param array parameter
     * @return 'object/array'
     */
    public function getNdr(array $payload=[]){
        $ndr=new NdrModule($this->client,$this->token);
        return $ndr->getNdrList($payload);
    }

     /**
     * submit ndr actions 
     * @reference https://documenter.getpostman.com/view/9692837/TW6wHnoz#7155e42e-df2d-4832-9a24-1e9a6c9a7c90
     * @param array parameter
     * @return 'object/array'
     */
    public function putNdrAction(array $payload=[]){
        $ndr=new NdrModule($this->client,$this->token);
        return $ndr->ndrAction($payload);
    }

    /**
     * shipment tracking through awb number
     * @reference https://documenter.getpostman.com/view/9692837/TW6wHnoz#420ad390-6c6b-4f9d-98bc-6f49c8b41120
     * @param string awb
     * @return 'object/array'
     */
    public function getShipmentTracking(string $awb){
        $shipment=new ShipmentModule($this->client,$this->token);
        return $shipment->trackShipment($awb);
    }

    /**
     * get multiple shipment tracking through awb number
     *  @reference https://documenter.getpostman.com/view/9692837/TW6wHnoz#59b456cd-278c-4a0a-83b5-e95fa2eb8520
     * @param array awbs
     * @return 'object/array'
     */
    public function getShipmentsTracking(array $awb){
        $shipment=new ShipmentModule($this->client,$this->token);
        return $shipment->bulkTrackShipment($awb);
    }

    /**
     * cancel shipment through awb number
     * @reference https://documenter.getpostman.com/view/9692837/TW6wHnoz#074cda17-f8f6-491f-bb35-47274e20eee6
     * @param array awbs
     * @return 'object/array'
     */
    public function cancelShipment(array $payload=[]){
        $shipment=new ShipmentModule($this->client,$this->token);
        return $shipment->cancelShipment($payload);
    }

    /**
     * generate manifest through awb number
     * @reference  https://documenter.getpostman.com/view/9692837/TW6wHnoz#31f3e7ea-66ce-4244-a40b-d15b191f4969
     * @param array awbs
     * @return 'object/array'
     */
    public function createManifest(array $payload=[]){
        $shipment=new ShipmentModule($this->client,$this->token);
        return $shipment->createManifest($payload);
    }
    /**
     * create shipment 
     * @reference  https://documenter.getpostman.com/view/9692837/TW6wHnoz#3d1dd145-c6c3-4dc4-9e3a-31769e45e9ea
     * @param array payload
     * @return 'object/array'
     */
    public function createShipment(array $payload=[]){
        $shipment=new ShipmentModule($this->client,$this->token);
        return $shipment->createShipment($payload);
    }


    /**
     * get orders list
     * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#56be4ac5-b5d3-4fb5-82e0-04990447cfc7
     * @return 'object/array'
     */
    public function getOrders(array $payload=[]){
        $order=new OrderModule($this->client,$this->token);
        return $order->getOrdersList($payload);
    }

    /**
     * get specific orders
     * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#c8a87162-3088-4fb2-a1fe-8c634361f5b7
     * @return 'object/array'
     */
    public function getOrder(string $orderid){
        $order=new OrderModule($this->client,$this->token);
        return $order->getSpecificOrder($orderid);
    }

    /**
     * cancel specific order
     * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#c8a87162-3088-4fb2-a1fe-8c634361f5b7
     * @return 'object/array'
     */
    public function cancelOrder(string $orderid){
        $order=new OrderModule($this->client,$this->token);
        return $order->cancelOrder($orderid);
    }

    /**
     * create custom order
     * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#1318e2f9-0ef6-4571-a71f-da4d22b665bd
     * @return 'object/array'
     */
    public function createOrder(array $orderdetail){
        $order=new OrderModule($this->client,$this->token);
        return $order->createOrder($orderdetail);
    }
    /**
     * create autoship order
     * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#1318e2f9-0ef6-4571-a71f-da4d22b665bd
     * @return 'object/array'
     */
    public function createAutoshipOrder(array $orderdetail){
        $order=new OrderModule($this->client,$this->token);
        return $order->createAutoshipOrder($orderdetail);
    }
    /**
     * generate AWB
     * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#deabf7ad-03bc-4e09-a773-482d569fe153
     * @return 'object/array'
     */
    public function shipByOrderId(array $orderdetail){
        $order=new OrderModule($this->client,$this->token);
        return $order->shipByOrderId($orderdetail);
    }
    /**
     * get all warehouse list
     * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#deabf7ad-03bc-4e09-a773-482d569fe153
     * @return 'object/array'
     */
    public function getWarehouses(){
        $order=new WarehouseModule($this->client,$this->token);
        return $order->getWarehousesList();
    }

    /**
     * create warehouse
     * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#dc3ae3c6-6050-48e0-ae05-df7afcb281aa
     * @return 'object/array'
     */
    public function createWarehouse(array $warehouse){
        $order=new WarehouseModule($this->client,$this->token);
        return $order->createWarehouse($warehouse);
    }
    
    /**
     * get Shipments list
     * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#375acfea-0222-459b-aa64-f74786a4d0f3
     * @return 'object/array'
     */
    public function getShipments(array $payload=[]){
        $order=new v1ShipmentModule($this->client,$this->token);
        return $order->getShipmentsList($payload);
    }
    /**
     * get specific Shipment
     * @reference  https://documenter.getpostman.com/view/9692837/SWE6beC7#6d5f1b31-bfde-449e-a11e-9d387a6025be
     * @return 'object/array'
     */
    public function getShipment(int $shipmentId){
        $order=new v1ShipmentModule($this->client,$this->token);
        return $order->getSpecificShipment($shipmentId);
    }
    /**
     * create pickup request
     * @reference https://documenter.getpostman.com/view/9692837/SWE6beC7#8923e517-b823-4def-b132-490d753406a0
     * @return 'object/array'
     */
    public function createPickup(array $shipmentIds){
        $order=new v1ShipmentModule($this->client,$this->token);
        return $order->createPickup($shipmentIds);
    }

    /**
     * get tracking by shipment id
     * @reference https://documenter.getpostman.com/view/9692837/SWE6beC7#d80b0afb-53ac-4c0f-bb3e-0c340b0aa049
     * @return 'object/array'
     */
    public function getShipmentTrackingByShipmentId(string $shipmentId){
        $order=new v1ShipmentModule($this->client,$this->token);
        return $order->trackingByShipmentId($shipmentId);
    }

}