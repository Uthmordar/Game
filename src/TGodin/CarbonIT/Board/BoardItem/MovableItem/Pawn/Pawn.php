<?php

namespace TGodin\CarbonIT\Board\BoardItem\MovableItem\Pawn;

use TGodin\CarbonIT\Board\BoardItem\BoardItemPickableTrait;
use TGodin\CarbonIT\Board\BoardItem\MovableItem\MovableItem;

/**
 * Represents a pawn.
 *
 * @author tanguy
 */
class Pawn extends MovableItem implements PawnInterface {

  use BoardItemPickableTrait;

  protected $name;

  public function __construct($posX, $posY, $orientation, $name) {

    parent::__construct($posX, $posY, $orientation);
    $this->name = (string) $name;
  }

  public function getName() {
    return $this->name;
  }

  public function export() {

    return ['type' => 'A', 'name' => $this->name, 'X' => $this->posX, 'Y' => $this->posY, 'pickables' => $this->pickables];
  }

}
