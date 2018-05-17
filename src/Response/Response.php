<?php

namespace MyColony\Response;

abstract class Response {

  /**
   * @var array
   */
  protected $data;

  /**
   * Takes the array for a single response and stores it
   *
   * @param array $data
   */
  public function __construct(array $data) {
    $this->data = $data;
  }

}