<?php

namespace TGodin\CarbonIT\Board;

use TGodin\CarbonIT\Board\BoardItem\BoardItem;

/**
 * Represents a Board row aka a sequence of cells.
 *
 * @author tanguy
 */
class BoardRow {

  protected $cellsCount = 0;
  /**
   * @var BoardCell[]
   */
  protected $cells;

  public function __construct($nbCells) {

    $this->cellsCount = $nbCells;
    $this->cells = [];
    for ($i = 0; $i < $nbCells; $i++) {
      array_push($this->cells, new BoardCell()); 
    } 
  }

  /**
   * Check if a cell exist at provided index.
   *
   * @param int $index
   *
   * @return Boolean
   */
  public function indexExist($index) {

    return isset($this->cells[(int) $index]);
  }

  public function isCellAccessible($index) {

    return isset($this->cells[(int) $index]) && $this->cells[(int) $index]->isAccessible();
  }

  /**
   * Get cell content at provided index.
   *
   * @param int $index
   *
   * @return BoardCell | null
   */
  public function get($index) {

    return ($this->indexExist((int) $index)) ? $this->cells[(int) $index] : null;
  }

  /**
   * Add a board item in cell at provided index.
   *
   * @param int $index
   * @param BoardItem $value
   *
   * @return boolean
   */
  public function set($index, BoardItem $value) {

    $cell = $this->cells[(int) $index];
    if ((int) $index <= $this->cellsCount -1 && ($cell == null || $cell->isAccessible())) {
      return $this->cells[(int) $index]->addItem($value);
    }
    return false;
  }

  /**
   * Reset cell content at provided index.
   *
   * @param int $index
   *
   * @return $this
   */
  public function delete(BoardItem $item, $index) {

    if ($this->indexExist($index)) {
      $this->cells[$index]->removeItem($item);
    }
    return $this;
  }

}
