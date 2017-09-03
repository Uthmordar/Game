<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace TGodin\CarbonIT\Board;

/**
 *
 * @author godinta
 */
interface BoardFactoryInterface {

  public function board($width, $height);

  public function mountain($x, $y);

  public function pawn($x, $y, $orientation, $name);

  public function treasure($x, $y, $count);
}
