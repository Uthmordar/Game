<?php

namespace TGodin\CarbonIT\Board;

use TGodin\CarbonIT\Board\BoardItem\FixedItem\Mountain;
use TGodin\CarbonIT\Board\BoardItem\FixedItem\Treasure;
use TGodin\CarbonIT\Board\BoardItem\MovableItem\Pawn\Pawn;

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
   * @return Board
   */
  public function board(int $width, int $height): Board {

    return new Board($width, $height);
  }

  /**
   * @param int $x
   * @param int $y
   *
   * @return Mountain
   */
  public function mountain(int $x, int $y): Mountain {
    
    return new Mountain($x, $y);
  }

  /**
   * @param int $x
   * @param int $y
   * @param string $orientation
   * @param string $name
   *
   * @return Pawn
   */
  public function pawn(int $x, int $y, string $orientation, string $name): Pawn {

    return new Pawn($x, $y, $orientation, $name);
  }

  /**
   * @param int $x
   * @param int $y
   * @param int $count
   *
   * @return Treasure
   */
  public function treasure(int $x, int $y, int $count): Treasure {

    return new Treasure($x, $y, $count);
  }

}
