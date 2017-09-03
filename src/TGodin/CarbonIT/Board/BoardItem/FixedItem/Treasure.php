<?php

namespace TGodin\CarbonIT\Board\BoardItem\FixedItem;

use TGodin\CarbonIT\Board\BoardItem\BoardItem;
use TGodin\CarbonIT\Board\BoardItem\BoardItemPickableInterface;
use TGodin\CarbonIT\Board\BoardItem\BoardItemPickableTrait;
use TGodin\CarbonIT\Exception\GameConfigException;

/**
 * Represents a treasure item.
 *
 * @author tanguy
 */
class Treasure extends BoardItem implements BoardItemPickableInterface {

  use BoardItemPickableTrait;

  protected $accessibility = true;

  public function __construct($x, $y, $artifactsCount) {

    parent::__construct($x, $y);
    if (!is_numeric($artifactsCount) && $artifactsCount <1) {
      throw new GameConfigException('Treasure should have at least one artifact.');
    }
    $this->pickables = $artifactsCount;
  }

  /**
   * @inherit
   */
  public function export() {

    return ['type' => 'T', 'X' => $this->posX, 'Y' => $this->posY, 'pickables' => $this->pickables];
  }

}
