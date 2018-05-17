<?php

namespace MyColony\Response\Structures;

class MotherColonyInfo extends PartialColonyInfo {

  public function getRRRIndex(): int {
    return (int) $this->data["rrr"];
  }

}