<?php

namespace MyColony\Response;

use MyColony\Request\GbtContractsRequest;
use MyColony\Response\Collection\GbtContractsCollection;
use MyColony\Response\Structures\GbtDetailedPrice;

class GbtPriceResponse extends Response {

  public function getResourceId(): int {
    return (int) $this->data["id"];
  }

  public function getName(): string {
    return $this->data["name"];
  }

  /**
   * @return int
   * @deprecated
   */
  public function getLegacyPrice(): int {
    return (int) $this->data["price"];
  }

  public function getPriceDetails(): GbtDetailedPrice {
    return new GbtDetailedPrice($this->data["detailed"]);
  }

  public function getContracts(): GbtContractsCollection {
    return (new GbtContractsRequest())->setResourceId($this->getResourceId())
      ->getResponse();
  }

}