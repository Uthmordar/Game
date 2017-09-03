<?php

use TGodin\CarbonIT\Board\Board;
use TGodin\CarbonIT\Board\BoardCellInterface;

/**
 * Board test.
 *
 * @author godinta
 */
class BoardTest extends \PHPUnit_Framework_TestCase {

  protected $mockItem;

  public function setUp() {

    $this->mockItem = $this->getMock('TGodin\CarbonIT\Board\BoardItem\BoardItem', [], [1, 1]);
  }

  /**
   * test error raise on board wrong initialization.
   *
   * @dataProvider providerWrongData
   * @expectedException TGodin\CarbonIT\Exception\GameConfigException
   * @expectedExceptionMessage Board width and height should be numeric and heighter than 0.
   */
  public function testWrongInitialisation($x, $y) {

    new Board($x, $y);
  }

  public function providerWrongData() {

    return [
      ['a', 1],
      [1, 'a'],
      [0, 1],
      [1, 0]
    ];
  }

  /**
   * Check board initialization is correct.
   */
  public function testBoardCorrectInitialization() {
    
    $x = 3;
    $y = 3;

    $board = new Board($x, $y);
    $this->assertEquals($board->getWidth(), $x);
    $this->assertEquals($board->getHeight(), $y);
    $export = $board->export();
    $this->assertEquals('C - ' . $x . ' - ' . $y, implode(' - ', $export));
    return $board;
  }

  /**
   * @depends testBoardCorrectInitialization
   */
  public function testCellExistences($board) {

    $this->assertTrue($board->getCell(2, 2) instanceof BoardCellInterface);
    $this->assertTrue($board->getCell(1, 2) instanceof BoardCellInterface);
    $this->assertNull($board->getCell(-1, 2));
  }

  /**
   * @dataProvider providerWrongItemPos
   * @depends testBoardCorrectInitialization
   * @expectedException TGodin\CarbonIT\Exception\GameConfigException
   * @expectedExceptionMessage Item pos X and Y should be numeric and in board range.
   */
  public function testItemInjectionError($x, $y, $board) {

    $board->putItem($this->mockItem, $x, $y);
  }

  public function providerWrongItemPos() {

    return [
      ['a', 1],
      [1, 'a'],
      [-1, 1],
      [1, -1]
    ];
  }

  /**
   * @depends testBoardCorrectInitialization
   */
  public function testItemPresence($board) {

    $this->mockItem->expects($this->exactly(2))->method('getAccessibility')->willReturn(false);
    $this->assertTrue($board->isCellAccessible(1, 1));
    $this->assertTrue($board->putItem($this->mockItem, 1, 1));
    $cellContent = $board->getCell(1, 1)->getItems();
    $this->assertTrue($cellContent->offsetExists($this->mockItem));
    $this->assertFalse($board->isCellAccessible(1, 1));
    $board->removeItem($this->mockItem, 1, 1);
    $this->assertTrue($board->isCellAccessible(1, 1));
  }

  /**
   * @depends testBoardCorrectInitialization
   */
  public function testCellBlocking($board) {

    $this->mockItem->expects($this->exactly(2))->method('getAccessibility')->willReturn(false);
    $item2 = $this->getMock('TGodin\CarbonIT\Board\BoardItem\BoardItem', [], [1, 1]);
    $this->assertTrue($board->putItem($this->mockItem, 1, 1));
    $this->assertFalse($board->putItem($item2, 1, 1));
    $this->assertTrue($board->putItem($item2, 1, 2));
    $board->removeItem($this->mockItem, 1, 1);
  }

  /**
   * @depends testBoardCorrectInitialization
   */
  public function testCellNoBlocking($board) {

    $this->mockItem->expects($this->exactly(1))->method('getAccessibility')->willReturn(true);
    $item2 = $this->getMock('TGodin\CarbonIT\Board\BoardItem\BoardItem', [], [1, 1]);
    $this->assertTrue($board->putItem($this->mockItem, 1, 1));
    $this->assertTrue($board->putItem($item2, 1, 1));
  }

}
