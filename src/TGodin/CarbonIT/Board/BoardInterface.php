<?php

namespace TGodin\CarbonIT\Board;

use TGodin\CarbonIT\Board\BoardItem\BoardItem;

/**
 * Represents a board.
 *
 * @author godinta
 */
interface BoardInterface {

  /**
   * Get cell at provided coordinate.
   *
   * @param int $posX
   * @param int $posY
   *
   * @return BoardCellInterface | null
   */
  public function getCell($posX, $posY);

  /**
   * @return int
   */
  public function getHeight();

  /**
   * @return int
   */
  public function getWidth();

  /**
   * Check if cell at provided coordinate is accessible.
   *
   * @param int $posX
   * @param int $posY
   */
  public function isCellAccessible($posX, $posY);

  /**
   * Add a BoardItem in Board.
   *
   * @param BoardItem $item
   * @param int $posX
   * @param int $posY
   *
   * @return Boolean
   *
   * @throws GameConfigException
   */
  public function putItem(BoardItem $item, $posX, $posY);

  /**
   * Remove item from targeted cell.
   *
   * @param BoardItem $item
   *   Item to remove.
   * @param int $x
   *   Cell pos x.
   * @param int $y
   *   Cell pos y.
   *
   * @return $this
   */
  public function removeItem(BoardItem $item, $x, $y);

  /**
   * @return []
   */
  public function export();
}
