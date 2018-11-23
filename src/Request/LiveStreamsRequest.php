<?php

namespace MyColony\Request;

use GuzzleHttp\Exception\GuzzleException;
use MyColony\Helper\HttpRequest;
use MyColony\Response\Collection\Collection;
use MyColony\Response\Collection\LiveStreamsCollection;
use MyColony\Response\Response;

class LiveStreamsRequest extends Request {

  public function __construct() {
    $this->setParam("pf", 5);
    $this->setParam("g", 1);
  }

  /**
   * Sends the request and returns a collection or a response
   *
   * @return LiveStreamsCollection
   */
  public function getResponse() {
    try {
      $response = HttpRequest::get($this->buildUrl());
      return new LiveStreamsCollection($response);
    } catch (GuzzleException $e) {
      throw new \RuntimeException("Couldn't load data from url");
    }
  }
}