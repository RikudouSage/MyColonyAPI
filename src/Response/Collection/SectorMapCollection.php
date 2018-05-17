<?php

namespace MyColony\Response\Collection;

use MyColony\Response\SectorResponse;

class SectorMapCollection extends Collection {

  protected function populateElements() {
    foreach ($this->data as $row) {
      $this->elements[] = new SectorResponse($row);
    }
  }

}