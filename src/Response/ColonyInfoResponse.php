<?php

namespace MyColony\Response;

use GuzzleHttp\Psr7\Uri;
use MyColony\Helper\XYCoordinate;
use MyColony\Response\Collection\ChildColoniesCollection;
use MyColony\Response\Structures\MotherColonyInfo;

class ColonyInfoResponse extends Response {

  public function getCharterCode(): string {
    return $this->data["charter"];
  }

  public function getName(): string {
    return $this->data["name"];
  }

  public function getCivilization(): string {
    return $this->data["civilization"];
  }

  public function getRace(): string {
    return $this->data["race"];
  }

  public function getMapType(): string {
    return $this->data["maptype"];
  }

  public function getFounded(): \DateTime {
    return new \DateTime($this->data["founded"]);
  }

  public function isIndependent(): bool {
    return !!$this->data["independence"];
  }

  /**
   * @return bool|\DateTime
   */
  public function getIndependenceDay() {
    if ($this->isIndependent()) {
      return new \DateTime($this->data["independence"]);
    }
    return FALSE;
  }

  public function getPopulation(): int {
    return (int) $this->data["population"];
  }

  public function getGDP(): int {
    return (int) $this->data["gdp"];
  }

  public function getUnemploymentRate(): int {
    return (int) $this->data["unemployment"];
  }

  public function getAtmosphereStage(): int {
    return (int) $this->data["mapstage"];
  }

  public function getDevice(): string {
    return $this->data["playson"];
  }

  public function getLastActive(): \DateTime {
    return new \DateTime($this->data["lastactive"]);
  }

  public function getThemeColor(): string {
    return $this->data["theme"];
  }

  public function getScreenshotUrl(): Uri {
    return new Uri($this->data["screenshot"]);
  }

  public function getWebsiteUrl(): Uri {
    return new Uri($this->data["website"]);
  }

  public function getSector(): XYCoordinate {
    $data = explode(",", $this->data["sector"]);
    return new XYCoordinate($data[0], $data[1]);
  }

  public function getLocation(): XYCoordinate {
    $data = explode(",", $this->data["location"]);
    return new XYCoordinate($data[0], $data[1]);
  }

  public function getRRRIndex(): int {
    return (int) $this->data["rrr"];
  }

  public function getMotherColony(): MotherColonyInfo {
    return new MotherColonyInfo($this->data["mothercolony"]);
  }

  public function getChildColonies(): ChildColoniesCollection {
    return new ChildColoniesCollection(json_encode($this->data["childcolonies"]));
  }

}