<?php

namespace MyColony\Response\Collection;

use MyColony\Response\Structures\ChildColonyInfo;

class ChildColoniesCollection extends Collection {

  /**
   * Populates the elements array with data
   *
   * @return void
   */
  protected function populateElements() {
    foreach ($this->data as $row) {
      $this->elements[] = new ChildColonyInfo($row);
    }
  }
}