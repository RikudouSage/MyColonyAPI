<?php

namespace MyColony\Response\Collection;

use MyColony\Response\LiveStreamResponse;

/**
 * @method LiveStreamResponse[] getData();
 * @method LiveStreamResponse current();
 * @method LiveStreamResponse offsetGet($offset);
 */
class LiveStreamsCollection extends Collection {

  /**
   * Populates the elements array with data
   *
   * @return void
   */
  protected function populateElements() {
    foreach ($this->data as $row) {
      $this->elements[] = new LiveStreamResponse($row);
    }
  }
}