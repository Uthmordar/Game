<?php

namespace TGodin\CarbonIT\Board\BoardItem;

/**
 * Provided pickable inventory management.
 *
 * @author godinta
 */
interface BoardItemPickableInterface extends BoardItemInterface {

  /**
   * Check if pickables are available.
   *
   * @return boolean
   */
  public function hasAvailablePickables(): bool;

  /**
   * Decrement pickables.
   *
   * @return boolean
   *   True if pickable has been successfully decreased, else false.
   */
  public function decrementPickables(): bool;

  /**
   * Add a pickable to inventory.
   */
  public function incrementPickables(): void;

}
