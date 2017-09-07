<?php

namespace TGodin\CarbonIT\Board\BoardItem;

use TGodin\CarbonIT\ExportableInterface;

/**
 * Represents a board item.
 *
 * @author tanguy
 */
abstract class BoardItem implements BoardItemInterface, ExportableInterface {

  protected $accessibility = false;
  protected $posX;
  protected $posY;

  public function __construct(int $posX, int $posY): void {

    $this->posX = $posX;
    $this->posY = $posY;
  }

  /**
   * Get item accessibility.
   *
   * If true, item is non cell exclusive.
   *
   * @return boolean
   */
  public function getAccessibility(): bool {
    return $this->accessibility;
  }

  /**
   * Get item X position.
   *
   * @return int
   */
  public function getX(): int {

    return $this->posX;
  }

  /**
   * Get item Y position.
   *
   * @return int
   */
  public function getY(): int {

    return $this->posY;
  }

  /**
   * Get item data as string.
   *
   * @return array
   */
  public function export(): array {

    return ['X' => $this->posX, 'Y' => $this->posY];
  }

}
