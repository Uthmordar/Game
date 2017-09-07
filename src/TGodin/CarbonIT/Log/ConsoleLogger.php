<?php

namespace TGodin\CarbonIT\Log;

use TGodin\CarbonIT\Log\VerboseLoggerInterface;

class ConsoleLogger implements VerboseLoggerInterface {

  protected $verbose;

  public function __construct(bool $verbose = false): void {

    $this->verbose = $verbose;
  }

  public function setVerbosity(bool $verbose): self {

    $this->verbose = $verbose;
    return $this;
  }

  public function getVerbosity(): bool {

    return $this->verbose;
  }

  public function emergency(string $message, array $context = []): void {

    $this->output($message . PHP_EOL, '[0;31m');
  }

  public function alert(string $message, array $context = []): void {

    $this->output($message . PHP_EOL, '[0;31m');
  }

  public function critical(string $message, array $context = []): void {

    $this->output($message . PHP_EOL, '[0;31m');
  }

  public function error(string $message, array $context = []): void {

    $this->output($message . PHP_EOL, '[0;31m');
  }

  public function warning(string $message, array $context = []): void {

    $this->output($message . PHP_EOL, '[0;33m');
  }

  public function verboseWarning(string $message, array $context = []): void {

    if ($this->verbose) {
      $this->warning($message, $context);
    }
  }

  public function notice(string $message, array $context = []): void {

    $this->output($message . PHP_EOL);
  }

  public function info(string $message, array $context = []): void {

    $this->output($message . PHP_EOL, '[0;32m');
  }

  public function verboseInfo(string $message, array $context = []): void {

    if ($this->verbose) {
      $this->info($message, $context);
    }
  }

  public function debug(string $message, array $context = []): void {
    
    $this->output($message . PHP_EOL, '[0;35m');
  }

  public function log(string $level, string $message, array $context = []): void {

    if (method_exists($this, $level)) {
      call_user_func([$this, $level], $message, $context);
    }
  }

  public function verboseLog(string $level, string $message, array $context = []): void {

    if ($this->verbose) {
      $this->log($level, $message, $context);
    }
  }

  protected function output(string $message, string $marker = '[0;37m'): void {

    print chr(27) . $marker . $message . chr(27) . '[0m';
  }

}
