<?php

namespace MyColony\Response;

use MyColony\Request\ColonyInfoRequest;

class LiveStreamResponse extends Response {

  public function getColonyName(): string {
    return $this->data["colony"];
  }

  public function getCharterCode(): string {
    return $this->data["charter"];
  }

  public function getUser(): string {
    return $this->data["user"];
  }

  public function getColonyInfo(): ColonyInfoResponse {
    return
      (new ColonyInfoRequest())->setCharterCode($this->getCharterCode())->getResponse();
  }

}