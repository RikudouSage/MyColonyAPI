<?php

namespace MyColony\Enum;

class GbtResourceNames {

  const FOOD = "Food";

  const WATER = "Water";

  const WOOD = "Wood";

  const ORE = "Ore";

  const STEEL = "Steel";

  const GOLD = "Gold";

  const ALUMINUM = "Aluminum";

  const URANIUM = "Uranium";

  const MICROCHIP = "Microchip";

  const ALIEN_ARTIFACT = "Alien Artifact";

  const RUM = "Rum";

  const CLAY = "Clay";

  const POTTERY = "Pottery";

  const BRICKS = "Bricks";

  const CLOTH = "Cloth";

  const WOOL = "Wool";

  const HELIUM_3 = "Helium 3";

  const CHARCOAL = "Charcoal";

  const REGOLITH = "Regolith";

  const PLASTIC = "Plastic";

  const TOY = "Toy";

  const OIL = "Oil";

  const SUGAR = "Sugar";

  const ANT_PASTE = "Ant Paste";

  const ANTANIUM = "Antanium";

  const ROBOT = "Robot";

  const DIAMOND = "Diamond";

  const TRIANTANIUM = "Triantanium";

  const CRYSTALLINE = "Crystalline";

  const ALIEN_RELIC = "Alien Relic";

  const OBSIDIAN = "Obsidian";

  const ANCIENT_INSTRUCTIONS = "Ancient Instructions";

  const PAINTING = "Painting";

  public static function findById(int $resourceId): string {
    /** @noinspection PhpUnhandledExceptionInspection */
    $nameConstants = (new \ReflectionClass(static::class))->getConstants();
    /** @noinspection PhpUnhandledExceptionInspection */
    $idConstants = (new \ReflectionClass(GbtResourceIds::class))->getConstants();
    $key = array_search($resourceId, $idConstants);
    if (!$key) {
      throw new \InvalidArgumentException("The resource id ($resourceId) is invalid");
    }
    return $nameConstants[$key];
  }

}