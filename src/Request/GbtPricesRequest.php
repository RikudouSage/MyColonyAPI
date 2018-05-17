<?php

namespace MyColony\Request;

use GuzzleHttp\Exception\GuzzleException;
use MyColony\Helper\HttpRequest;
use MyColony\Response\Collection\GbtPricesCollection;

class GbtPricesRequest extends Request {

  public function __construct() {
    $this->setParam("pf", 1);
    $this->setParam("g", 1);
  }

  /**
   * Sends the request and returns a collection or a response
   *
   * @return GbtPricesCollection
   */
  public function getResponse() {
    try {
      $result = HttpRequest::get($this->buildUrl());
      $data = json_decode($result, true);
      $data = $data["resources"];
      return new GbtPricesCollection(json_encode($data));
    } catch (GuzzleException $e) {
      throw new \RuntimeException("Couldn't load data from url");
    }
  }
}