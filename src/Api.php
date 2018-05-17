<?php

namespace MyColony;

use MyColony\Request\ColonyInfoRequest;
use MyColony\Request\GbtContractsRequest;
use MyColony\Request\GbtPricesRequest;
use MyColony\Request\SectorMapRequest;

class Api {

  public function findSector(): SectorMapRequest {
    return new SectorMapRequest();
  }

  public function getColonyInfo(): ColonyInfoRequest {
    return new ColonyInfoRequest();
  }

  public function getGbtPrices(): GbtPricesRequest {
    return new GbtPricesRequest();
  }

  public function getGbtContracts(): GbtContractsRequest {
    return new GbtContractsRequest();
  }

}