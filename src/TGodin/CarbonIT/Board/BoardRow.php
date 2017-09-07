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

  public function __construct(int $nbCells): void {

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
  public function indexExist(int $index): bool {

    return isset($this->cells[$index]);
  }

  public function isCellAccessible(int $index): bool {

    return isset($this->cells[$index]) && $this->cells[$index]->isAccessible();
  }

  /**
   * Get cell content at provided index.
   *
   * @param int $index
   *
   * @return BoardCell | null
   */
  public function get(int $index): BoardCell {

    return ($this->indexExist($index)) ? $this->cells[$index] : null;
  }

  /**
   * Add a board item in cell at provided index.
   *
   * @param int $index
   * @param BoardItem $value
   *
   * @return boolean
   */
  public function set(int $index, BoardItem $value): bool {

    $cell = $this->cells[$index];
    if ((int) $index <= $this->cellsCount -1 && ($cell == null || $cell->isAccessible())) {
      return $this->cells[$index]->addItem($value);
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
  public function delete(int $index, BoardItem $item): bool {

    if ($this->indexExist($index)) {
      $this->cells[$index]->removeItem($item);
    }
    return $this;
  }

}
