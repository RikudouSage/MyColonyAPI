<?php

namespace MyColony\Response;

use MyColony\Enum\GbtResourceIds;
use MyColony\Request\ColonyInfoRequest;
use MyColony\Request\GbtPricesRequest;

class GbtContractResponse extends Response {

  public function getResourceId(): int {
    return GbtResourceIds::findByName($this->getResourceName());
  }

  public function getResourceName(): string {
    return $this->data["resource"];
  }

  public function getSellerName(): string {
    return $this->data["seller"];
  }

  public function getSellerCharterCode(): string {
    return $this->data["sellercharter"];
  }

  public function getQuantity(): int {
    return (int) $this->data["quantity"];
  }

  public function getPrice(): int {
    return (int) $this->data["price"];
  }

  public function getExpirationDate(): \DateTime {
    return new \DateTime($this->data["expires"]);
  }

  public function isSelling(): bool {
    return intval($this->data["offerflag"]) === 0;
  }

  public function isBuying(): bool {
    return !$this->isSelling();
  }

  public function getSellerColonyInfo(): ColonyInfoResponse {
    /** @noinspection PhpUnhandledExceptionInspection */
    return (new ColonyInfoRequest())->setCharterCode($this->getSellerCharterCode())
      ->getResponse();
  }

  public function getPricingInfo(): GbtPriceResponse {
    return (new GbtPricesRequest())->getResponse()
      ->findById($this->getResourceId());
  }

}