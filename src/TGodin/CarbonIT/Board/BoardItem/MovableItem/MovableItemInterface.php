<?php

namespace TGodin\CarbonIT\Board\BoardItem\MovableItem;

use TGodin\CarbonIT\Board\BoardItem\BoardItemInterface;

/**
 *
 * @author tanguy
 */
interface MovableItemInterface extends BoardItemInterface {

  /**
   * Get item current orientation.
   *
   * @return string
   */
  public function getOrientation(): string;

  /**
   * Set item orientation.
   *
   * @param string $orientation
   *
   * @return $this
   *
   * @throws GameConfigException
   */
  public function setOrientation(string $orientation): string;

  /**
   * Rotate item toward left.
   *
   * @return $this
   */
  public function rotateLeft(): self;

  /**
   * Rotate item toward right.
   *
   * @return $this
   */
  public function rotateRight(): self;

  /**
   * Change item position.
   *
   * @param int $x
   * @param int $y
   *
   * @return $this
   */
  public function setMove(int $x, int $y): self;

}
