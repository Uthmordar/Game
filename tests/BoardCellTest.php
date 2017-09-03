<?php

use TGodin\CarbonIT\Board\BoardCell;

/**
 * Board test.
 *
 * @author godinta
 */
class BoardCellTest extends \PHPUnit_Framework_TestCase {

  protected $mockItem;
  protected $cell;

  public function setUp() {

    $this->mockItem = $this->getMock('TGodin\CarbonIT\Board\BoardItem\BoardItem', [], [1, 1]);
    $this->cell = new BoardCell();
  }

  public function testItemPresenceBlock() {

    $this->mockItem->expects($this->exactly(2))->method('getAccessibility')->willReturn(false);    
    $this->assertTrue($this->cell->isAccessible());
    $this->assertTrue($this->cell->addItem($this->mockItem));
    $this->assertEquals(count($this->cell->getItems()), 1);
    $this->assertFalse($this->cell->isAccessible());
    $this->cell->removeItem($this->mockItem);
    $this->assertTrue($this->cell->isAccessible());
  }

  public function testItemPresenceNoBlock() {

    $this->mockItem->expects($this->exactly(1))->method('getAccessibility')->willReturn(true);    
    $this->assertTrue($this->cell->addItem($this->mockItem));
    $this->assertTrue($this->cell->isAccessible());
  }

}
