<?php

namespace MyColony\Request;

use GuzzleHttp\Exception\GuzzleException;
use MyColony\Exception\RequiredParametersMissingException;
use MyColony\Helper\HttpRequest;
use MyColony\Helper\XYCoordinate;
use MyColony\Response\Collection\SectorMapCollection;

class SectorMapRequest extends Request {

  /**
   * Sets the basic parameters for api
   */
  public function __construct() {
    $this->setParam("pf", 3);
    $this->setParam("g", 1);
  }

  /**
   * Sets the x coordinate for sector. Required.
   *
   * @param int $x
   *
   * @return $this
   */
  public function setXCoordinate(int $x) {
    return $this->setParam("sx", $x);
  }

  /**
   * Sets the y coordinate for sector. Required.
   *
   * @param int $y
   *
   * @return $this
   */
  public function setYCoordinate(int $y) {
    return $this->setParam("sy", $y);
  }

  /**
   * Shorthand method to set x and y coordinates in one go
   *
   * @param \MyColony\Helper\XYCoordinate $coordinates
   *
   * @return $this
   */
  public function setXYCoordinates(XYCoordinate $coordinates) {
    return $this->setXCoordinate($coordinates->getX())
      ->setYCoordinate($coordinates->getY());
  }

  /**
   * Limits the count of rows returned. Optional.
   *
   * @param int $limit
   *
   * @return $this
   */
  public function setLimit(int $limit) {
    return $this->setParam("limit", $limit);
  }

  /**
   * Whether to return only independent colonies. Optional.
   *
   * @param bool $onlyIndependent
   *
   * @return $this
   */
  public function onlyIndependent(bool $onlyIndependent) {
    if ($onlyIndependent) {
      $this->setParam("ind", 1);
    }
    else {
      unset($this->params["ind"]);
    }
    return $this;
  }

  /**
   * Returns the collection of sector maps
   *
   * @return SectorMapCollection
   * @throws RequiredParametersMissingException
   */
  public function getResponse() {
    if (!$this->hasParam("sx")) {
      throw new RequiredParametersMissingException("The parameter 'X coordinate' (sx) is required");
    }
    if (!$this->hasParam("sy")) {
      throw new RequiredParametersMissingException("The parameter 'Y coordinate' (sy) is required");
    }
    try {
      $result = HttpRequest::get($this->buildUrl());
      return new SectorMapCollection($result);
    } catch (GuzzleException $e) {
      throw new \RuntimeException("Couldn't load data from url");
    }
  }
}