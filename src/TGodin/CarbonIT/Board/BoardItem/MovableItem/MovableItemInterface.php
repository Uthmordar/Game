<?php

namespace TGodin\CarbonIT\Board\BoardItem\MovableItem;

/**
 *
 * @author tanguy
 */
interface MovableItemInterface {

  /**
   * Get item current orientation.
   *
   * @return string
   */
  public function getOrientation();

  /**
   * Set item orientation.
   *
   * @param string $orientation
   *
   * @return $this
   *
   * @throws GameConfigException
   */
  public function setOrientation($orientation);

  public function rotateLeft();

  public function rotateRight();

  /**
   * Change item position.
   *
   * @param int $x
   * @param int $y
   *
   * @return $this
   */
  public function setMove($x, $y);

}
