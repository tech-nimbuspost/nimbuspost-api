# NimbusPost API (V1) PHP SDK
## Index
1. [Installation](https://github.com/tech-nimbuspost/nimbuspost-api#installation)
2. [Usage](https://github.com/tech-nimbuspost/nimbuspost-api#installation)
    1. [Authentication](https://github.com/tech-nimbuspost/nimbuspost-api#Authentication)
    2. [Couriers](https://github.com/tech-nimbuspost/nimbuspost-api#Couriers)
    3. [NDR](https://github.com/tech-nimbuspost/nimbuspost-api#NDR)
    4. [Tracking](https://github.com/tech-nimbuspost/nimbuspost-api#Tracking)
    5. [Orders](https://github.com/tech-nimbuspost/nimbuspost-api#Orders)
    6. [Shipments](https://github.com/tech-nimbuspost/nimbuspost-api#Shipments)
    7. [Manifest](https://github.com/tech-nimbuspost/nimbuspost-api#Manifest)  
    8. [Warehouse](https://github.com/tech-nimbuspost/nimbuspost-api#Warehouse)
3. [Contributors](https://github.com/tech-nimbuspost/nimbuspost-api#contributors)

## Installation

You can install the package via composer:

```bash
composer require nimbuspost/nimbuspost
```

## Authentication
    

##### Get the login details
```php
use Nimbuspackage\Nimbuspost\NimbuspostApi;


$config=[
    'key'=>'07faa9dxxxxxxxxxxxxxxxxxxxe1c1',
    'email'=>'xxxxx',
    'password'=>'xxxxxxx'
];

$object=new NimbuspostApi($config);
$object->setResponseType('array') // default object

```

## Couriers

#### get list of available couriers
https://documenter.getpostman.com/view/9692837/TW6wHnoz#2665632a-c9b6-419b-a696-dc599f3affa1
```php

$object=new NimbuspostApi($config);
$response=$object->getCouriers();

```

#### Get the list of all available pincode with serviceability
https://documenter.getpostman.com/view/9692837/TW6wHnoz#e4c0510d-6380-4fca-966e-1f6822ca922f
```php

$object=new NimbuspostApi($config);
$response=$object->getCouriersServiceable();

```
#### Check serviceablity and get Freight Charges between origin and destination pincodes
https://documenter.getpostman.com/view/9692837/TW6wHnoz#4dc571fd-6edb-4e59-a1c4-7ed39e9cc2f0
```php

$object=new NimbuspostApi($config);
$payload = [
  // refer above url for required parameters 
  'weight'=>500,
];
$response=$object->getCourierServiceability($payload);

```
## NDR

### Get NDR List
https://documenter.getpostman.com/view/9692837/TW6wHnoz#a22d1ac8-6b15-4a42-bebb-4e52dce1be21
```php

$object=new NimbuspostApi($config);
$payload = [
  // refer above url for required parameters 
  'per_page'=>1,
];
$response=$object->getNdr($payload);

```

### Submit NDR Action
https://documenter.getpostman.com/view/9692837/TW6wHnoz#7155e42e-df2d-4832-9a24-1e9a6c9a7c90
```php

$object=new NimbuspostApi($config);
$payload = [
  // refer above url for required parameters 
  [
    "awb" : "NMBC0002111111",
  ]
];
$response=$object->putNdrAction($payload);

```

## Tracking

### Get the single tracking history through awb 
https://documenter.getpostman.com/view/9692837/TW6wHnoz#420ad390-6c6b-4f9d-98bc-6f49c8b41120
```php

$object=new NimbuspostApi($config);
$awb='N123456789';
$response=$object->getShipmentTracking($awb);

```
### Get the bulk tracking history through awb
https://documenter.getpostman.com/view/9692837/TW6wHnoz#59b456cd-278c-4a0a-83b5-e95fa2eb8520
```php

$object=new NimbuspostApi($config);
$payload=[
         "awb"=> [
             "77845353283",
             "4270712142976"
         ]
     ]
$response=$object->getShipmentsTracking($payload);

```

### Get the tracking history through shipment id
https://documenter.getpostman.com/view/9692837/TW6wHnoz#59b456cd-278c-4a0a-83b5-e95fa2eb8520
```php

$object=new NimbuspostApi($config);
$shipmentId=123456789;
$response=$object->getShipmentTrackingByShipmentId($shipmentId);

```

## Order

### Get orders list
 https://documenter.getpostman.com/view/9692837/SWE6beC7#56be4ac5-b5d3-4fb5-82e0-04990447cfc7
 ```php

$object=new NimbuspostApi($config);
$payload = [
  // refer above url for required parameters 
  'per_page'=>1
];
$response=$object->getOrders($payload);

```

### Get specific order
 https://documenter.getpostman.com/view/9692837/SWE6beC7#c8a87162-3088-4fb2-a1fe-8c634361f5b7
 ```php

$object=new NimbuspostApi($config);
// refer above url for required parameters 
$orderId=123123123;
$response=$object->getOrder($orderId);

```

### Create custom order
  https://documenter.getpostman.com/view/9692837/SWE6beC7#1318e2f9-0ef6-4571-a71f-da4d22b665bd
 ```php

$object=new NimbuspostApi($config);
// refer above url for required parameters 
$payload=[
  'order_number'=>'4423',
];
$response=$object->createOrder($payload);

```

### Create autoship order
 https://documenter.getpostman.com/view/9692837/SWE6beC7#e345df1e-5b5e-4042-ab9c-26028e22c9af
 ```php

$object=new NimbuspostApi($config);
// refer above url for required parameters 
$payload=[
  'order_number'=>'4423',
];
$response=$object->createAutoshipOrder($payload);

```

### Cancel order
https://documenter.getpostman.com/view/9692837/SWE6beC7#fb04f1d2-feef-43fd-b5ee-a559d0290bc5
 ```php

$object=new NimbuspostApi($config);
// refer above url for required parameters 
$orderId=123123123;
$response=$object->cancelOrder($orderId);

```

### Ship by order id
https://documenter.getpostman.com/view/9692837/SWE6beC7#deabf7ad-03bc-4e09-a773-482d569fe153
 ```php

$object=new NimbuspostApi($config);
// refer above url for required parameters 
$payload=[
  'id'=>'4423',
];
$response=$object->shipByOrderId($payload);

```

## Shipments

### Get list of shipments
 https://documenter.getpostman.com/view/9692837/SWE6beC7#375acfea-0222-459b-aa64-f74786a4d0f3

  ```php

$object=new NimbuspostApi($config);
// refer above url for required parameters 
$payload=[
  'page'=>'1',
];
$response=$object->getShipments($payload);

```

### Get specific shipment
https://documenter.getpostman.com/view/9692837/SWE6beC7#6d5f1b31-bfde-449e-a11e-9d387a6025be

  ```php

$object=new NimbuspostApi($config);
// refer above url for required parameters 
$shipmentId=12314;
$response=$object->getShipment($shipmentId);

```

### Create Shipment
https://documenter.getpostman.com/view/9692837/TW6wHnoz#3d1dd145-c6c3-4dc4-9e3a-31769e45e9ea

```php

$object=new NimbuspostApi($config);
// refer above url for required parameters 
$payload=[
  'order_number'=>'1231',
];
$response=$object->createShipment($payload);

```

### Cancel Shipment
https://documenter.getpostman.com/view/9692837/TW6wHnoz#074cda17-f8f6-491f-bb35-47274e20eee6

```php

$object=new NimbuspostApi($config);
// refer above url for required parameters 
$payload=[
  'awb'=>'59632218892',
];
$response=$object->cancelShipment($payload);

```

## Manifest

### Generate manifest through awb number
https://documenter.getpostman.com/view/9692837/TW6wHnoz#31f3e7ea-66ce-4244-a40b-d15b191f4969

```php

$object=new NimbuspostApi($config);
// refer above url for required parameters 
$payload=[
 "awbs": [
        "4152911775885",
        "NMBC0001789312"
    ]
];
$response=$object->createManifest($payload);

```


## Warehouse

### Get the list of warehouse
https://documenter.getpostman.com/view/9692837/SWE6beC7#42d8f354-c80a-47d9-9e51-49ac513818c5

```php

$object=new NimbuspostApi($config);
$response=$object->createWarehouse();

```

### Create warehouse
https://documenter.getpostman.com/view/9692837/SWE6beC7#dc3ae3c6-6050-48e0-ae05-df7afcb281aa

```php

$object=new NimbuspostApi($config);
// refer above url for required parameters 
$payload=[
 "name": "XXXXXXXXX"
];
$response=$object->createWarehouse($payload);

```
