<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "vendor" . DIRECTORY_SEPARATOR . "autoload.php";

if (php_sapi_name() !== PHP_SAPI) {
  echo 'Only accessible via cli';
  die();
}

// Load .env file in $_ENV.
$dotenv = new Dotenv\Dotenv(__DIR__ . DIRECTORY_SEPARATOR . '..');
$dotenv->load();

use TGodin\CarbonIT\Config;
use TGodin\CarbonIT\Game;
use TGodin\CarbonIT\Board\BoardFactory;
use TGodin\CarbonIT\Exception\GameConfigException;
use TGodin\CarbonIT\Log\ConsoleLogger;

// Try to gather config files path from env or use default.
$envInput = filter_var($_ENV['INPUT_FILE'], FILTER_SANITIZE_URL);
$envOutput = filter_var($_ENV['OUTPUT_FILE'], FILTER_SANITIZE_URL);

$input = !empty($envInput) ? $envInput : __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "input.txt";
$output = !empty($envOutput) ? $envOutput : __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "public" . DIRECTORY_SEPARATOR . "output.txt";

// Init services.
$log = new ConsoleLogger();
$factory = new BoardFactory();
$config = new Config($log, $input);
$config->load();

// Start game.
try {

  // Bootstrap game.
  $game = new Game($log, $factory, $config->getConfig());
  $game->init();
  // Run game.
  $game->play();
  // Gather result as text.
  $result = $game->getDataAsText();
  file_put_contents($output, $result);

} catch (GameConfigException $e) {

  $log->error( 'An error occured due to game wrong configuration: ' . $e->getMessage());
}
