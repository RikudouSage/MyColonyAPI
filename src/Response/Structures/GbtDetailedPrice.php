<?php

namespace MyColony\Response\Structures;

use MyColony\Response\Response;

class GbtDetailedPrice extends Response {

  public function getLastTradePrice(): int {
    return (int) $this->data["last"];
  }

  public function getRollingAveragePrice(): int {
    return (int) $this->data["rolling"];
  }

  public function getMinPrice(): int {
    return (int) $this->data["min"];
  }

  public function getMaxPrice(): int {
    return (int) $this->data["max"];
  }

  public function getEmergencyPrice(): int {
    return (int) $this->data["emergency"];
  }

}