<?php

namespace MyColony\Enum;

class GbtResourceIds {

  const FOOD = 1;

  const WATER = 2;

  const WOOD = 3;

  const ORE = 4;

  const STEEL = 5;

  const GOLD = 6;

  const ALUMINUM = 7;

  const URANIUM = 8;

  const MICROCHIP = 9;

  const ALIEN_ARTIFACT = 10;

  const RUM = 11;

  const CLAY = 12;

  const POTTERY = 13;

  const BRICKS = 14;

  const CLOTH = 15;

  const WOOL = 16;

  const HELIUM_3 = 17;

  const CHARCOAL = 18;

  const REGOLITH = 19;

  const PLASTIC = 20;

  const TOY = 21;

  const OIL = 22;

  const SUGAR = 23;

  const ANT_PASTE = 24;

  const ANTANIUM = 25;

  const ROBOT = 26;

  const DIAMOND = 27;

  const TRIANTANIUM = 28;

  const CRYSTALLINE = 29;

  const ALIEN_RELIC = 30;

  const OBSIDIAN = 31;

  const ANCIENT_INSTRUCTIONS = 32;

  const PAINTING = 33;

  const STARSHIP = 34;

  const WHEEL = 35;

  public static function findByName(string $name): int {
    /** @noinspection PhpUnhandledExceptionInspection */
    $nameConstants = (new \ReflectionClass(GbtResourceNames::class))->getConstants();
    /** @noinspection PhpUnhandledExceptionInspection */
    $idConstants = (new \ReflectionClass(static::class))->getConstants();
    $key = array_search($name, $nameConstants);
    if (!$key) {
      throw new \InvalidArgumentException("The resource name ($name) is invalid");
    }
    return $idConstants[$key];
  }

}