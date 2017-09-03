<?php

namespace TGodin\CarbonIT\Board;

use SplObjectStorage;
use TGodin\CarbonIT\Board\BoardItem\BoardItem;

/**
 * Description of BoardCell
 *
 * @author godinta
 */
class BoardCell implements BoardCellInterface {

  /**
   *
   * @var SplObjectStorage
   */
  protected $content;
  protected $blocked = false;

  public function __construct() {

    $this->content = new SplObjectStorage();
  }

  public function addItem(BoardItem $item) {

    if (!$this->blocked || $item->getAccessibility()) {

      $this->content->attach($item);
      if (!$item->getAccessibility()) {
        $this->blocked = true;
      }
      return true;
    }
    return false;
  }

  public function isAccessible() {
    return !$this->blocked;
  }

  public function getItems() {

    return $this->content; 
  }

  public function removeItem(BoardItem $item) {

    $this->content->detach($item);
    if (!$item->getAccessibility()) {
      $this->blocked = false;
    }
    return $this;
  }

}
