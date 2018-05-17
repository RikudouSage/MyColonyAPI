# My Colony PHP Api

This is an OOP wrapper around [My Colony](https://www.my-colony.com/) public API. Requires php 7.2+.

## Installation

Install via composer:

`composer require rikudou/my-colony-api`

## Usage

Simply create an instance of the api:

```php
<?php

use MyColony\Api;

$api = new Api();

// get sector info
$findSector = $api->findSector();
// get colony info
$colonyInfo = $api->getColonyInfo();
// get GBT prices
$prices = $api->getGbtPrices();
// get active GBT contracts
$contracts = $api->getGbtContracts();

```

### Sector Info

The `findSector()` method returns instance of class `MyColony\Request\SectorMapRequest`.

Parameters:

- x position (`setXCoordinate()` or `setXYCoordinates()`) - **required**
- y position (`setYCoordinate()` or `setXYCoordinates()`) - **required**
- limit (`setLimit()`) - limits how many colonies to return
- only independent (`onlyIndependent()`) - whether to return only independent colonies
```php
<?php

use MyColony\Api;
use MyColony\Helper\XYCoordinate;

$api = new Api();

$sectorInfo = $api->findSector();

// set the sector to 0,0
$sectorInfo->setXCoordinate(0)->setYCoordinate(0);
// or
$sectorInfo->setXYCoordinates(new XYCoordinate(0, 0));

// limit to 5 colonies
$sectorInfo->setLimit(5);

// only independent
$sectorInfo->onlyIndependent(true);

// changed our mind, we want also dependent colonies
$sectorInfo->onlyIndependent(false);

// here we get the result
$result = $sectorInfo->getResponse();

// or all in one go

$result = $sectorInfo
  ->setXCoordinate(0)
  ->setYCoordinate(0)
  ->setLimit(5)
  ->onlyIndependent(true)
  ->getResponse();

// $result is now instance of MyColony\Response\Collection\SectorMapCollection

/** @var \MyColony\Response\SectorResponse $sectorColonyInfo */
foreach($result as $sectorColonyInfo) {
  $sectorColonyInfo->getName(); // returns colony name
  $sectorColonyInfo->getCharter(); // returns colony charter code
  $sectorColonyInfo->hasCapitol(); // true/false - whether colony has capitol
  $sectorColonyInfo->getMapType(); // can be checked against \MyColony\Enum\MapType constants
  $sectorColonyInfo->getPopulation(); // the population as integer
  $sectorColonyInfo->getXCoordinate(); // get the x position
  $sectorColonyInfo->getYCoordinate(); // get the y position
  $sectorColonyInfo->getColonyInfo(); // returns ColonyInfoResponse, more on that below
}

```

### Colony Info

The `getColonyInfo()` method returns instance of `MyColony\Request\ColonyInfoRequest`

Parameters:

- charter code (`setCharterCode()`) - **required**

```php
<?php

use MyColony\Api;

$api = new Api();

$colonyInfo = $api->getColonyInfo();

// set the charter code
$colonyInfo->setCharterCode("earth");

// get response
$result = $colonyInfo->getResponse();

// or in one go

$result = $colonyInfo->setCharterCode("earth")->getResponse();

// $result is now instance of MyColony\Response\ColonyInfoResponse

$result->getCharterCode(); // the colony charter code
$result->getName(); // the colony name
$result->getCivilization(); // the civilization, can be checked against MyColony\Enum\Civilizations constants
$result->getRace(); // the race, can be checked against MyColony\Enum\Race constants
$result->getMapType(); // the map type, can be checked against MyColony\Enum\MapType
$result->getFounded(); // returns DateTime object with the date the colony was founded
$result->isIndependent(); // whether the colony is or is not independent
$result->getIndependenceDay(); // if colony is independent, returns DateTime with date and time, otherwise returns false
$result->getPopulation(); // the population as integer
$result->getGDP(); // the colony GDP as integer
$result->getUnemploymentRate(); // the unemployment rate as an integer from 0 to 100
$result->getAtmosphereStage(); // the atmosphere level based stage
$result->getDevice(); // the identifier of the device type the colony was last played on
$result->getLastActive(); // DateTime object of when the colony was last online
$result->getThemeColor(); // the theme color the colony choose
$result->getScreenshotUrl(); // returns instance of GuzzleHttp\Psr7\Uri with the URL to colony screenshot
$result->getWebsiteUrl(); // returns instance of GuzzleHttp\Psr7\Uri with the URL to colony website
$result->getSector(); // returns the instance of MyColony\Helper\XYCoordinate with sector x and y coordinates
$result->getLocation(); // returns the instance of MyColony\Helper\XYCoordinate with x and y coordinates of the location inside sector
$result->getRRRIndex(); // returns the rrr index of colony, see https://www.ape-apps.com/viewpage.php?p=3418
$result->getMotherColony(); // returns MyColony\Response\Structures\MotherColonyInfo instance with partial colony info (more below)
$result->getChildColonies(); // return MyColony\Response\Collection\ChildColoniesCollection instance (more below)

// MyColony\Response\Structures\MotherColonyInfo which extends MyColony\Response\Structures\PartialColonyInfo
// MyColony\Response\Structures\ChildColonyInfo is also child of MyColony\Response\Structures\PartialColonyInfo
$motherColony = $result->getMotherColony();
// most of the methods are the same as in the colony stored in $result
// here is the list of methods:
$motherColony->getCharterCode();
$motherColony->getName();
$motherColony->getPopulation();
$motherColony->getWebsite();
$motherColony->getRelations(); // the relation the colony in $result has with colony in $motherColony
$motherColony->getSector();
$motherColony->getLocation();
$motherColony->getRRRIndex();
$motherColony->getFullColonyInfo(); // returns instance of MyColony\Response\ColonyInfoResponse with the full info

// instance of MyColony\Response\Collection\ChildColoniesCollection
// the collection can be iterated and every child is MyColony\Response\Structures\ChildColonyInfo
$children = $result->getChildColonies();
/** @var \MyColony\Response\Structures\ChildColonyInfo $child */
foreach($children as $child) {
  // all methods are the same as in mother colony, except child colonies don't have getRRRIndex()
}
```

### GBT Prices

The `getGbtPrices()` method returns instance of `MyColony\Request\GbtPricesRequest`

Parameters: none

```php
<?php

use MyColony\Api;

$prices = (new Api())->getGbtPrices();

$result = $prices->getResponse();

/** @var \MyColony\Response\GbtPriceResponse $resource */
foreach ($result as $resource) {
  $resource->getName(); // returns the resource name, e.g. Food, can be checked against MyColony\Enum\GbtResourceNames
  $resource->getResourceId(); // returns the resource ID, can be checked against MyColony\Enum\GbtResourceIds
  $resource->getLegacyPrice(); // deprecated, gets resource price for older clients
  $resource->getContracts(); // returns the collection of available contracts, more on that below
  $resource->getPriceDetails(); // returns instance of MyColony\Response\Structures\GbtDetailedPrice
  
  $details = $resource->getPriceDetails();
  
  $details->getLastTradePrice(); // the price for this resource in the latest trade
  $details->getRollingAveragePrice(); // the average price for last three days
  $details->getMinPrice(); // the lowest price for last three days
  $details->getMaxPrice(); // the biggest price for last three days
  $details->getEmergencyPrice(); // emergency price, used by game 'if the market get too crazy'
}
```

### GBT Contracts

The `getGbtContracts()` return instance of `MyColony\Request\GbtContractsRequest`

Parameters:

- resource id (`setResourceId`) - can be taken from `MyColony\Enum\GbtResourceIds`

```php
<?php

use MyColony\Api;
use MyColony\Enum\GbtResourceIds;

$contracts = (new Api())->getGbtContracts();
// set the resource id to 3 (Wood)
$contracts->setResourceId(GbtResourceIds::WOOD);
// get the response
$contracts->getResponse();

// or all at once
$result = $contracts->setResourceId(GbtResourceIds::WOOD)->getResponse();

// $result is now instance of MyColony\Response\Collection\GbtContractsCollection

/** @var \MyColony\Response\GbtContractResponse $contract */
foreach($result as $contract) {
  $contract->getResourceId(); // resource id, can be checked against MyColony\Enum\GbtResourceIds
  $contract->getResourceName(); // resource name, can be checked against MyColony\Enum\GbtResourceNames
  $contract->getSellerName(); // returns the name of the colony that is selling the item
  $contract->getSellerCharterCode(); // the charter code of colony that is selling the item
  $contract->getQuantity(); // the count of goods being sold
  $contract->getPrice(); // the total price of the trade
  $contract->getExpirationDate(); // DateTime object of date and time when the trade disappears from GBT
  $contract->isSelling(); // whether the one who created the trade is selling
  $contract->isBuying(); // whether the one who created the trade is buying
  $contract->getSellerColonyInfo(); // instance of MyColony\Response\ColonyInfoResponse, see 'Colony Info' section above
  $contract->getPricingInfo(); // instance of MyColony\Response\GbtPriceResponse, see 'GBT Prices' section above
}
```

## Enums

There are some enums to assist you.

### Civilizations

Class: `MyColony\Enum\Civilizations`

Description: Contains list of civilizations

### GBT Resource IDs

Class: `MyColony\Enum\GbtResourceIds`

Description: Contains ids of all resources, also contains static method `findByName()`.

```php
<?php

use MyColony\Enum\GbtResourceIds;

$woodId = GbtResourceIds::findByName("Wood"); // returns 3

```

### GBT Resource Names

Class: `MyColony\Enum\GbtResourceNames`

Description: Contains names of all resources, also contains static method `findById()`.

```php
<?php

use MyColony\Enum\GbtResourceNames;

$name = GbtResourceNames::findById(3); // return "Wood"
```

### Map Types

Class: `MyColony\Enum\MapType`

Description: Contains names of map types. **This enum is incomplete**.

### Races

Class: `MyColony\Enum\Race`

Description: Contains names of races in game.

## Exceptions

List of arguments that can be thrown:

- `\InvalidargumentException` - when you input id that doesn't exist, name that doesn't exist etc.
- `MyColony\Exception\RequiredParametersMissingException` - when some request class doesn't have required parameters set
- `\RuntimeException` or `\LogicException` - in all other cases