<?php

namespace TGodin\CarbonIT;

/**
 *
 * @author tanguy
 */
interface ExportableInterface {

  /**
   * @return []
   */
  public function export(): array;
}
