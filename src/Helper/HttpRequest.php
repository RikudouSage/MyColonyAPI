<?php

namespace MyColony\Helper;

use GuzzleHttp\Client;

class HttpRequest {

  protected const BASE_URI = "https://www.my-colony.com/api.php?";

  /**
   * @var Client
   */
  protected static $request;

  /**
   * Sends http get request and returns response as a string
   *
   * @param string $url
   *
   * @return string
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public static function get(string $url) {
    if (!static::$request) {
      static::$request = new Client();
    }
    return static::$request
      ->request("get", static::BASE_URI . $url)
      ->getBody()
      ->getContents();
  }

}