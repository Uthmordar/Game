<?php

namespace TGodin\CarbonIT\Board;

use TGodin\CarbonIT\ExportableInterface;
use TGodin\CarbonIT\Exception\GameConfigException;
use TGodin\CarbonIT\Board\BoardItem\BoardItem;

/**
 * Represents a game board.
 *
 * @author tanguy
 */
class Board implements BoardInterface, ExportableInterface {

  // Board width.
  protected $x = 0;
  // Board height;
  protected $y = 0;
  /**
   *
   * @var BoardRow[]
   */
  protected $rows = [];

  /**
   * 
   * @param int $x
   *   Width (number of cells).
   * @param int $y
   *   Height (number of cells).
   *
   * @throws GameConfigException
   */
  public function __construct($x, $y) {

    if (!is_numeric($x) || !is_numeric($y) || $x < 1 || $y < 1) {
      throw new GameConfigException("Board width and height should be numeric and heighter than 0.");
    }

    $this->x = (int) $x;
    $this->y = (int) $y;
    for ($i = 0; $i < $y; $i++) {
      $row = new BoardRow($x);
      array_push($this->rows, $row);
    }
  }

  /**
   * Get cell at provided coordinate.
   *
   * @param int $posX
   * @param int $posY
   *
   * @return BoardCellInterface | null
   */
  public function getCell($posX, $posY) {

    return !empty($this->rows[$posY]) ?  $this->rows[$posY]->get($posX) : null;
  }

  /**
   * @return int
   */
  public function getHeight() {
    return $this->y;
  }

  /**
   * @return int
   */
  public function getWidth() {
    return $this->x;
  }

  /**
   * Check if cell at provided coordinate is accessible.
   *
   * @param int $posX
   * @param int $posY
   */
  public function isCellAccessible($posX, $posY) {

    if (!is_numeric($posX) || !is_numeric($posY) || $posX < 0 || $posY < 0 || $posX > $this->x - 1 || $posY > $this->y - 1) {
      return false;
    }
    return $this->rows[$posY]->isCellAccessible($posX);
  }

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
  public function putItem(BoardItem $item, $posX, $posY) {

    if (!is_numeric($posX) || !is_numeric($posY) || $posX <0 || $posY < 0 || $posX > $this->x - 1 || $posY > $this->y - 1) {
      throw new GameConfigException("Item pos X and Y should be numeric and in board range.");
    }
    return $this->rows[$posY]->set($posX, $item);
  }

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
  public function removeItem(BoardItem $item, $x, $y) {

    if (!empty($this->rows[$y])) {
      $this->rows[$y]->delete($item, $x);
    }
    return $this;
  }

  public function export() {

    return ['type' => 'C', 'X' => $this->x, 'Y' => $this->y];
  }

}
