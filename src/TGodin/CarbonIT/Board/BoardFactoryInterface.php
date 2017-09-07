<?php

namespace TGodin\CarbonIT\Board;

use TGodin\CarbonIT\Board\BoardInterface;
use TGodin\CarbonIT\Board\BoardItem\BoardItemInterface;
use TGodin\CarbonIT\Board\BoardItem\BoardItemPickableInterface;
use TGodin\CarbonIT\Board\BoardItem\MovableItem\Pawn\PawnInterface;

/**
 *
 * @author godinta
 */
interface BoardFactoryInterface {

  public function board(int $width, int $height): BoardInterface;

  public function mountain(int $x, int $y): BoardItemInterface;

  public function pawn(int $x, int $y, string $orientation, string $name): PawnInterface;

  public function treasure(int $x, int $y, int $count): BoardItemPickableInterface;
}
