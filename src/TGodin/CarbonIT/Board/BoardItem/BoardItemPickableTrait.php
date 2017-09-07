<?php

namespace TGodin\CarbonIT\Board\BoardItem;

/**
 * Provided pickable inventory management.
 *
 * @author godinta
 */
trait BoardItemPickableTrait {

  protected $pickables = 0;

  /**
   * Check if pickables are available.
   *
   * @return boolean
   */
  public function hasAvailablePickables(): bool {

    return $this->pickables > 0;
  }

  /**
   * Decrement pickables.
   *
   * @return boolean
   *   True if pickable has been successfully decreased, else false.
   */
  public function decrementPickables(): bool {

    if ($this->hasAvailablePickables()) {
      $this->pickables--;
      return true;
    }
    return false;
  }

  /**
   * Add a pickable to inventory.
   */
  public function incrementPickables(): void {

    $this->pickables++;
  }

}
