<?php

namespace MyColony\Helper;

class XYCoordinate {

  /**
   * @var int
   */
  private $x;

  /**
   * @var int
   */
  private $y;

  public function __construct(int $x, int $y) {
    $this->x = $x;
    $this->y = $y;
  }

  /**
   * @return int
   */
  public function getX(): int {
    return $this->x;
  }

  /**
   * @return int
   */
  public function getY(): int {
    return $this->y;
  }

}