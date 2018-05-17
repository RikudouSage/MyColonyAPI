<?php

namespace MyColony\Request;

use MyColony\Response\Collection\Collection;
use MyColony\Response\Response;

/**
 * Base request class, all other request extend this one.
 *
 * @package MyColony\Request
 */
abstract class Request {

  /**
   * Array that holds all get parameters
   *
   * @var array
   */
  protected $params = [];

  /**
   * Wrapper around http_build_query(), returns the parameters
   * as a query string
   *
   * @return string
   */
  protected function buildUrl() {
    return http_build_query($this->params);
  }

  /**
   * Sends the request and returns a collection or a response
   *
   * @return Collection|Response
   */
  abstract public function getResponse();

  /**
   * Checks whether given param exists
   *
   * @param string $param
   *
   * @return bool
   */
  protected function hasParam(string $param) {
    return isset($this->params[$param]);
  }

  /**
   * Sets the parameter value and returns current instance
   *
   * @param string $paramName
   * @param string|int $paramValue
   *
   * @return $this
   */
  protected function setParam(string $paramName, $paramValue) {
    $this->params[$paramName] = $paramValue;
    return $this;
  }

}