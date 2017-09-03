<?php

namespace TGodin\CarbonIT\Board\BoardItem\FixedItem;

use TGodin\CarbonIT\Board\BoardItem\BoardItem;

/**
 * Represents a mountain item.
 *
 * @author tanguy
 */
class Mountain extends BoardItem  {

  public function export() {

    return ['type' => 'M', 'X' => $this->posX, 'Y' => $this->posY];
  }

}
