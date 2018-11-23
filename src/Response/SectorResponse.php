<?php

namespace MyColony\Response;

use MyColony\Request\ColonyInfoRequest;

class SectorResponse extends Response {

  protected $colonyInfoResponse;

  public function getName(): string {
    return $this->data["name"];
  }

  public function getCharter(): string {
    return $this->data["charter"];
  }

  public function hasCapitol(): bool {
    return !!$this->data["capitol"];
  }

  public function getPopulation(): int {
    return (int) $this->data["population"];
  }

  public function getMapType(): string {
    return $this->data["maptype"];
  }

  public function getTheme(): string {
    return $this->data["theme"];
  }

  public function getXCoordinate(): int {
    return (int) $this->data["x"];
  }

  public function getYCoordinate(): int {
    return (int) $this->data["y"];
  }

  public function getColonyInfo() {
    if (!$this->colonyInfoResponse) {
      /** @noinspection PhpUnhandledExceptionInspection */
      $this->colonyInfoResponse =
        (new ColonyInfoRequest())->setCharterCode($this->getCharter())->getResponse();
    }
    return $this->colonyInfoResponse;
  }

}