<?php

namespace MyColony\Response\Collection;

use MyColony\Response\GbtPriceResponse;

class GbtPricesCollection extends Collection {

  protected $resourceIds = [];

  /**
   * Populates the elements array with data
   *
   * @return void
   */
  protected function populateElements() {
    $i = 0;
    foreach ($this->data as $row) {
      $element = new GbtPriceResponse($row);
      $this->resourceIds[$element->getResourceId()] = $i;
      $this->elements[$i] = $element;
      $i++;
    }
  }

  public function findById(int $resourceId): GbtPriceResponse {
    if (isset($this->resourceIds[$resourceId])) {
      return $this->elements[$this->resourceIds[$resourceId]];
    }
    throw new \InvalidArgumentException("Unknown resource ID ($resourceId)");
  }
}