<?php

namespace MyColony\Response\Collection;

use MyColony\Response\GbtContractResponse;

/**
 * @method GbtContractResponse[] getData();
 * @method GbtContractResponse current();
 * @method GbtContractResponse offsetGet($offset);
 */
class GbtContractsCollection extends Collection {

  /**
   * Populates the elements array with data
   *
   * @return void
   */
  protected function populateElements() {
    foreach ($this->data as $row) {
      $this->elements[] = new GbtContractResponse($row);
    }
  }
}