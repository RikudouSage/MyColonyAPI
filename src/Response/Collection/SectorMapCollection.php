<?php

namespace MyColony\Response\Collection;

use MyColony\Response\SectorResponse;

/**
 * @method SectorResponse[] getData();
 * @method SectorResponse current();
 * @method SectorResponse offsetGet($offset);
 */
class SectorMapCollection extends Collection {

  protected function populateElements() {
    foreach ($this->data as $row) {
      $this->elements[] = new SectorResponse($row);
    }
  }

}