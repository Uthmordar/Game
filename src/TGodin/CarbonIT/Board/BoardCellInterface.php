<?php

namespace TGodin\CarbonIT\Board;

use TGodin\CarbonIT\Board\BoardItem\BoardItem;

/**
 *
 * @author godinta
 */
interface BoardCellInterface {

  public function addItem(BoardItem $item);

  public function isAccessible();

  public function getItems();

  public function removeItem(BoardItem $item);

}
