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

  public function __construct(): void {

    $this->content = new SplObjectStorage();
  }

  public function addItem(BoardItem $item): bool {

    if (!$this->blocked || $item->getAccessibility()) {

      $this->content->attach($item);
      if (!$item->getAccessibility()) {
        $this->blocked = true;
      }
      return true;
    }
    return false;
  }

  public function isAccessible(): bool {
    return !$this->blocked;
  }

  public function getItems(): SplObjectStorage {

    return $this->content; 
  }

  public function removeItem(BoardItem $item): self {

    $this->content->detach($item);
    if (!$item->getAccessibility()) {
      $this->blocked = false;
    }
    return $this;
  }

}
