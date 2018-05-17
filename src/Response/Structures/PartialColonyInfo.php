<?php

namespace MyColony\Response\Structures;

use GuzzleHttp\Psr7\Uri;
use MyColony\Helper\XYCoordinate;
use MyColony\Request\ColonyInfoRequest;
use MyColony\Response\ColonyInfoResponse;
use MyColony\Response\Response;

abstract class PartialColonyInfo extends Response {

  public function getName(): string {
    return $this->data["name"];
  }

  public function getCharterCode(): string {
    return $this->data["charter"];
  }

  public function getPopulation(): int {
    return (int) $this->data["population"];
  }

  public function getWebsite(): Uri {
    return new Uri($this->data["website"]);
  }

  public function getRelations(): int {
    return (int) $this->data["relations"];
  }

  public function getSector(): XYCoordinate {
    $xy = explode(",", $this->data["sector"]);
    return new XYCoordinate($xy[0], $xy[1]);
  }

  public function getLocation(): XYCoordinate {
    $xy = explode(",", $this->data["location"]);
    return new XYCoordinate($xy[0], $xy[1]);
  }

  public function getFullColonyInfo(): ColonyInfoResponse {
    /** @noinspection PhpUnhandledExceptionInspection */
    return
      (new ColonyInfoRequest())->setCharterCode($this->getCharterCode())->getResponse();
  }

}