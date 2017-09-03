<?php

namespace TGodin\CarbonIT\Board\BoardItem;

use TGodin\CarbonIT\ExportableInterface;

/**
 * Represents a board item.
 *
 * @author tanguy
 */
abstract class BoardItem implements ExportableInterface {

  protected $accessibility = false;
  protected $posX;
  protected $posY;

  public function __construct($posX, $posY) {

    $this->posX = (int) $posX;
    $this->posY = (int) $posY;
  }

  /**
   * Get item accessibility.
   *
   * If true, item is non cell exclusive.
   *
   * @return boolean
   */
  public function getAccessibility() {
    return $this->accessibility;
  }

  /**
   * Get item X position.
   *
   * @return int
   */
  public function getX() {

    return $this->posX;
  }

  /**
   * Get item Y position.
   *
   * @return int
   */
  public function getY() {

    return $this->posY;
  }

  /**
   * Get item data as string.
   *
   * @return array
   */
  public function export() {

    return ['X' => $this->posX, 'Y' => $this->posY];
  }

}
