<?php

namespace TGodin\CarbonIT;

use Psr\Log\LoggerInterface;
use SplObjectStorage;
use TGodin\CarbonIT\Board\BoardInterface;
use TGodin\CarbonIT\Board\BoardCellInterface;
use TGodin\CarbonIT\Board\BoardFactoryInterface;
use TGodin\CarbonIT\Board\BoardItem\BoardItemPickableInterface;
use TGodin\CarbonIT\Board\BoardItem\MovableItem\ItemOrientation;
use TGodin\CarbonIT\Board\BoardItem\MovableItem\MovableItem;
use TGodin\CarbonIT\Board\BoardItem\MovableItem\Pawn\PawnInterface;
use TGodin\CarbonIT\Exception\GameConfigException;
use TGodin\CarbonIT\Support\String;

/**
 * Game application.
 *
 * @author tanguy
 */
class Game {

  /**
   * @var BoardFactoryInterface
   */
  protected $factory;
  /**
   * @var LoggerInterface
   */
  protected $log;

  /**
   *
   * @var BoardInterface
   */
  protected $board = null;
  /**
   *
   * @var SplObjectStorage
   */
  protected $pawns;
  /**
   *
   * @var BoardItem[]
   */
  protected $items = array();
  /**
   *
   * @var string[]
   */
  protected $rawData;

  /**
   * @param LoggerInterface $log
   * @param BoardFactoryInterface $factory
   * @param string[] $data
   */
  public function __construct(LoggerInterface $log, BoardFactoryInterface $factory, array $data) {

    $this->factory = $factory;
    $this->log = $log;
    $this->rawData = $data;
    $this->boot();
  }

  /**
   * Bootstrap game.
   *
   * @throws GameConfigException
   */
  protected function boot() {

    $this->pawns = new SplObjectStorage();

    foreach ($this->rawData as $index => $line) {

      $content = explode(' - ', $line);
      if ($content[0] == 'C' && count($content) >= 3 && empty($this->board)) {
        $this->board = $this->factory->board($content[1], $content[2]);
      } else if ($content[0] == 'M' && count($content) >= 3) {
        array_push($this->items, $this->factory->mountain($content[1], $content[2]));
      } else if ($content[0] == 'T' && count($content) >= 4) {
        array_push($this->items, $this->factory->treasure($content[1], $content[2], $content[3]));
      } else if ($content[0] == 'A' && count($content) >= 3) {
        $this->pawns->offsetSet($this->factory->pawn($content[2], $content[3], $content[4], $content[1]), String::str_split_unicode(strtoupper((string) $content[5])));
      } else {
        $this->log->emergency('Invalid item at ' . $index . ' line, skipped.');
      }
    }

    if (empty($this->board) || !count($this->pawns)) {
      throw new GameConfigException('No board or pawn declared.');
    }
  }

  /**
   * Run game initialization.
   */
  public function init() {

    foreach ($this->items as $item) {

      if ($this->board->putItem($item, $item->getX(), $item->getY())) {
        $this->log->info('Initialize item at (' . $item->getX() . ', ' . $item->getY() . ').');
      } else {
        $this->log->warning('An already existing item was at (' . $item->getX() . ', ' . $item->getY() . '), current item skipped.');
      }
    }
    $this->log->info('Fixed items (mountains, treasures) are set.');
    foreach ($this->pawns as $pawn) {

      if ($this->board->putItem($pawn, $pawn->getX(), $pawn->getY())) {
        $this->log->info('Initialize player ' . $pawn->getName() . ' at (' . $pawn->getX() . ', ' . $pawn->getY() . ').');
      } else {
        $this->log->warning('An already existing player was set at (' . $pawn->getX() . ', ' . $pawn->getY() . '), player ' . $pawn->getName() . ' skipped.');
      }
    }
  }

  /**
   * Run game.
   */
  public function play() {

    $this->log->info('Start game iterations.');
    $this->loop();
    $this->log->info('Ending game iterations.');
  }

  /**
   * Get current data as text.
   */
  public function getDataAsText() {

    $output = implode(' - ', $this->board->export()) . PHP_EOL;
    foreach ($this->items as $item)  {
      $output = $output . implode(' - ', $item->export()) . PHP_EOL;
    }
    foreach ($this->pawns as $pawn) {
      $output = $output . implode(' - ', $pawn->export()) . PHP_EOL;
    }
    return $output;
  }

  /**
   * Run game loop.
   *
   * Game will iterate until all pawns related actions have been resolved.
   */
  protected function loop() {

    do {
      $activePlayer = 0;
      foreach ($this->pawns as $pawn) {

        $apl = $this->pawns->offsetGet($pawn);
        if (!empty($apl)) {
          $activePlayer++;
        } else {
          continue;
        }

        $action = array_shift($apl);

        $this->processAction($pawn, $action);

        $this->pawns->offsetSet($pawn, $apl);
      }
    } while ($activePlayer != 0);
  }

  /**
   * Resolve pawn pick up actions on cell.
   *
   * @param PawnInterface $pawn
   * @param BoardCellInterface $cell
   */
  protected function pickUp(PawnInterface $pawn, BoardCellInterface $cell) {

    $cellItems = $cell->getItems();
    foreach ($cellItems as $cellItem) {

      if ($cellItem instanceof BoardItemPickableInterface && $cellItem->decrementPickables()) {

        // Should only take one pickables atm.
        $pawn->incrementPickables();
        break;
      }
    }
  }

  /**
   * Resolve pawn action.
   *
   * @param PawnInterface $pawn
   * @param string $action
   */
  protected function processAction(PawnInterface $pawn, $action) {

    switch ($action) {

      // Trigger pawn movement and pickup if movement is resolved.
      case 'A':

        $this->log->info('Move pawn ' . $pawn->getName());
        $cell = $this->triggerItemMove($pawn);
        if ($cell) {
          $this->pickUp($pawn, $cell);
        }
        $this->log->info('Pawn ' . $pawn->getName() . ' position is now ' . $pawn->getX() . ', ' . $pawn->getY());
        break;

      // Rotate pawn toward right.
      case 'D' :        
        $pawn->rotateRight();
        $this->log->info('Rotate right pawn ' . $pawn->getName() . ', new orientation is ' . $pawn->getOrientation() );
        break;

      // Rotate pawn toward left.
      case 'G' :        
        $pawn->rotateLeft();
        $this->log->info('Rotate left pawn ' . $pawn->getName() . ', new orientation is ' . $pawn->getOrientation());
        break;

      default:
        $this->log->warning('Undefined action ' . $action . ' skipped for ' . $pawn->getName());
    }
  }

  /**
   * Resolve item movement.
   *
   * @param MovableItem $item
   *
   * @return BoardCellInterface | null
   */
  protected function triggerItemMove(MovableItem $item) {

    $posX = $item->getX();
    $posY = $item->getY();
    $targetX = $item->getX();
    $targetY = $item->getY();

    switch ($item->getOrientation()) {

      case ItemOrientation::N :
        $targetY = $posY - 1;
        break;

      case ItemOrientation::S :
        $targetY = $posY + 1;
        break;

      case ItemOrientation::E :
        $targetX = $posX + 1;
        break;

      case ItemOrientation::W :
        $targetX = $posX - 1;
        break;
    }

    if (!$this->board->isCellAccessible($targetX, $targetY)) {
      $this->log->warning('Cell (' . $targetX . ', ' . $targetY . ') is unreachable, movement skipped.');
      return;
    }

    try {

      $this->board->removeItem($item, $posX, $posY)
          ->putItem($item, $targetX, $targetY);
      $item->setMove($targetX, $targetY);
      return $this->board->getCell($targetX, $targetY);
    } catch (GameConfigException $e) {
      $this->log->warning('Pawn movement is forbidden : ' . $e->getMessage());
    }
  }

}
