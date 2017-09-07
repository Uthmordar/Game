<?php

namespace TGodin\CarbonIT\Board\BoardItem;

/**
 * Description of BoardItemInterface.
 *
 * @author godinta
 */
interface BoardItemInterface {

  /**
   * Get item accessibility.
   *
   * If true, item is non cell exclusive.
   *
   * @return boolean
   */
  public function getAccessibility(): bool;

  /**
   * Get item X position.
   *
   * @return int
   */
  public function getX(): int;

  /**
   * Get item Y position.
   *
   * @return int
   */
  public function getY(): int;

}
