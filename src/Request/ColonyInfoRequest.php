<?php

namespace MyColony\Request;

use GuzzleHttp\Exception\GuzzleException;
use MyColony\Exception\RequiredParametersMissingException;
use MyColony\Helper\HttpRequest;
use MyColony\Response\ColonyInfoResponse;

class ColonyInfoRequest extends Request {

  public function __construct() {
    $this->setParam("pf", 2);
    $this->setParam("g", 1);
  }

  public function setCharterCode(string $charterCode) {
    return $this->setParam("c", $charterCode);
  }

  /**
   * Sends the request and returns a collection or a response
   *
   * @return ColonyInfoResponse
   * @throws \MyColony\Exception\RequiredParametersMissingException
   */
  public function getResponse() {
    if (!$this->hasParam("c")) {
      throw new RequiredParametersMissingException("The parameter 'charter' (c) is required");
    }
    try {
      $result = HttpRequest::get($this->buildUrl());
      if (!($data = json_decode($result, TRUE))) {
        throw new \RuntimeException("The data is not a valid JSON");
      }
      return new ColonyInfoResponse($data);
    } catch (GuzzleException $e) {
      throw new \RuntimeException("Couldn't load data from url");
    }
  }
}