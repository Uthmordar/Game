<?php

namespace TGodin\CarbonIT\Board;

use Traversable;
use TGodin\CarbonIT\Board\BoardItem\BoardItem;

/**
 *
 * @author godinta
 */
interface BoardCellInterface {

  public function addItem(BoardItem $item): bool;

  public function isAccessible(): bool;

  public function getItems(): Traversable;

  public function removeItem(BoardItem $item): BoardCellInterface;

}
