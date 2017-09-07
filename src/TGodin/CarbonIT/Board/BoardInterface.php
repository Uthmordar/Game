<?php

namespace TGodin\CarbonIT\Board;

use TGodin\CarbonIT\ExportableInterface;
use TGodin\CarbonIT\Board\BoardItem\BoardItem;

/**
 * Represents a board.
 *
 * @author godinta
 */
interface BoardInterface extends ExportableInterface {

  /**
   * Get cell at provided coordinate.
   *
   * @param int $posX
   * @param int $posY
   *
   * @return BoardCellInterface | null
   */
  public function getCell(int $posX, int $posY): BoardCellInterface;

  /**
   * @return int
   */
  public function getHeight(): int;

  /**
   * @return int
   */
  public function getWidth(): int;

  /**
   * Check if cell at provided coordinate is accessible.
   *
   * @param int $posX
   * @param int $posY
   */
  public function isCellAccessible(int $posX, int $posY): bool;

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
  public function putItem(BoardItem $item, int $posX, int $posY): bool;

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
  public function removeItem(BoardItem $item, int $x, int $y): BoardInterface;

}
