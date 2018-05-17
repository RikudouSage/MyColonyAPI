<?php

/**
 * Checks for contracts that have price below half of the average
 */

use MyColony\Api;

require_once __DIR__ . "/../vendor/autoload.php";

$api = new Api();

$prices = $api->getGbtPrices()->getResponse();

$deals = [];

/** @var \MyColony\Response\GbtPriceResponse $price */
foreach ($prices as $price) {
  $average = $price->getPriceDetails()->getRollingAveragePrice();
  /** @var \MyColony\Response\GbtContractResponse $contract */
  foreach ($price->getContracts() as $contract) {
    // we don't want trades that want to buy resources
    if(!$contract->isSelling()) {
      continue;
    }

    // the average price is per 100 pieces, so we must divide by 100
    $contractAverage = $contract->getQuantity() * $average / 100;
    if ($contract->getPrice() <= $contractAverage / 2) {
      $deals[] = "There is a great deal for {$contract->getResourceName()}!
      Quantity: {$contract->getQuantity()}
      Average Price: {$contractAverage}
      Actual Price: {$contract->getPrice()}
      Seller: {$contract->getSellerName()}";
    }
  }
}

// transform the array to html for e-mail
$deals = implode("<br><br>", array_map(function ($item) {
  return nl2br($item);
}, $deals));

// send the $deals as e-mail