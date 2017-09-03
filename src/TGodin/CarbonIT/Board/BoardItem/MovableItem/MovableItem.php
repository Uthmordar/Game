<?php

namespace TGodin\CarbonIT\Board\BoardItem\MovableItem;

use TGodin\CarbonIT\Board\BoardItem\BoardItem;
use TGodin\CarbonIT\Board\BoardItem\MovableItem\ItemOrientation;
use TGodin\CarbonIT\Exception\GameConfigException;

/**
 * Represents a board item with movement capabilities.
 *
 * @author tanguy
 */
class MovableItem extends BoardItem implements MovableItemInterface {

  protected $orientation;
  protected $history = [];
  protected $allowedPositions = [ItemOrientation::N, ItemOrientation::W, ItemOrientation::S, ItemOrientation::E];
  protected $nbPositions;

  public function __construct($posX, $posY, $orientation) {

    parent::__construct($posX, $posY);
    if (!in_array($orientation, $this->allowedPositions)) {
      throw new GameConfigException('Invalid item orientation ' . $orientation . ' should be in ' . implode(', ', $this->allowedPositions) . '.');
    }
    $this->nbPositions = count($this->allowedPositions);
    $this->orientation = array_flip($this->allowedPositions)[$orientation];
    $this->history += [$this->posX, $this->posY];
  }

  /**
   * Get item current orientation.
   *
   * @return string
   */
  public function getOrientation() {

    return $this->allowedPositions[$this->orientation];
  }

  /**
   * Set item orientation.
   *
   * @param string $orientation
   *
   * @return $this
   *
   * @throws GameConfigException
   */
  public function setOrientation($orientation) {

    if (!in_array($orientation, $this->allowedPositions)) {
      throw new GameConfigException('Invalid item orientation ' . $orientation . ' should be in ' . implode(', ', $this->allowedPositions) . '.');
    }
    $this->orientation = array_flip($this->allowedPositions)[$orientation];
    return $this;
  }

  /**
   * Rotate item toward left.
   *
   * @return $this
   */
  public function rotateLeft() {

    if ($this->orientation == $this->nbPositions - 1) {
      $this->orientation = 0;
    } else {
      $this->orientation++;
    }
    return $this;
  }

  /**
   * Rotate item toward right.
   *
   * @return $this
   */
  public function rotateRight() {

    if ($this->orientation == 0) {
      $this->orientation = $this->nbPositions - 1;
    } else {
      $this->orientation--;
    }
    return $this;
  }

  /**
   * Change item position.
   *
   * @param int $x
   * @param int $y
   *
   * @return $this
   */
  public function setMove($x, $y) {

    $this->posX = (int) $x;
    $this->posY = (int) $y;
    $this->history = [$this->posX, $this->posY];
    return $this;
  }

}
