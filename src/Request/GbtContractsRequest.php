<?php

namespace MyColony\Request;

use GuzzleHttp\Exception\GuzzleException;
use MyColony\Helper\HttpRequest;
use MyColony\Response\Collection\GbtContractsCollection;

class GbtContractsRequest extends Request {

  public function __construct() {
    $this->setParam("pf", 4);
    $this->setParam("g", 1);
  }

  public function setResourceId(int $id) {
    return $this->setParam("r", $id);
  }

  /**
   * Sends the request and returns a collection or a response
   *
   * @return GbtContractsCollection
   */
  public function getResponse() {
    try {
      $response = HttpRequest::get($this->buildUrl());
      return new GbtContractsCollection($response);
    } catch (GuzzleException $e) {
      throw new \RuntimeException("Couldn't load data from url");
    }
  }
}