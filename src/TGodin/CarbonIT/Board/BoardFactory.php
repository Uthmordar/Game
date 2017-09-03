<?php

namespace TGodin\CarbonIT\Board;

use TGodin\CarbonIT\Board\BoardItem\FixedItem\Mountain;
use TGodin\CarbonIT\Board\BoardItem\FixedItem\Treasure;
use TGodin\CarbonIT\Board\BoardItem\MovableItem\Pawn\Pawn;
use TGodin\CarbonIT\Board\BoardItem\MovableItem\Pawn\PawnInterface;

/**
 * Description of BoardFactory
 *
 * @author godinta
 */
class BoardFactory implements BoardFactoryInterface {

  /**
   * @param int $width
   * @param int $height
   *
   * @return BoardInterface
   */
  public function board($width, $height) {

    return new Board($width, $height);
  }

  /**
   * @param type $x
   * @param type $y
   * @return Mountain
   */
  public function mountain($x, $y) {
    
    return new Mountain($x, $y);
  }

  /**
   * @param int $x
   * @param int $y
   * @param string $orientation
   * @param string $name
   *
   * @return PawnInterface
   */
  public function pawn($x, $y, $orientation, $name) {

    return new Pawn($x, $y, $orientation, $name);
  }

  /**
   * @param int $x
   * @param int $y
   * @param int $count
   *
   * @return Treasure
   */
  public function treasure($x, $y, $count) {

    return new Treasure($x, $y, $count);
  }

}
