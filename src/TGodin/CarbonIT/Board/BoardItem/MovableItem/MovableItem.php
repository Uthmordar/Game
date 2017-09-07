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

  public function __construct(int $posX, int $posY, string $orientation): void {

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
  public function getOrientation(): string {

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
  public function setOrientation(string $orientation): self {

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
  public function rotateLeft(): self {

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
  public function rotateRight(): self {

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
  public function setMove(int $x, int $y): self {

    $this->posX = $x;
    $this->posY = $y;
    $this->history = [$this->posX, $this->posY];
    return $this;
  }

}
