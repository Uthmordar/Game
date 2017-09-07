<?php

namespace TGodin\CarbonIT\Board\BoardItem\MovableItem\Pawn;

use TGodin\CarbonIT\Board\BoardItem\MovableItem\MovableItemInterface;
use TGodin\CarbonIT\Board\BoardItem\BoardItemPickableInterface;

/**
 *
 * @author tanguy
 */
interface PawnInterface extends BoardItemPickableInterface, MovableItemInterface {

  public function getName(): string;
}
