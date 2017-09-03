<?php

namespace TGodin\CarbonIT\Log;

use TGodin\CarbonIT\Log\VerboseLoggerInterface;

class ConsoleLogger implements VerboseLoggerInterface {

  protected $verbose;

  public function __construct($verbose = false) {

    $this->verbose = (bool) $verbose;
  }

  public function setVerbosity($verbose) {

    $this->verbose = (bool) $verbose;
    return $this;
  }

  public function getVerbosity() {

    return $this->verbose;
  }

  public function emergency($message, array $context = []) {

    $this->output($message . PHP_EOL, '[0;31m');
  }

  public function alert($message, array $context = []) {

    $this->output($message . PHP_EOL, '[0;31m');
  }

  public function critical($message, array $context = []) {

    $this->output($message . PHP_EOL, '[0;31m');
  }

  public function error($message, array $context = []) {

    $this->output($message . PHP_EOL, '[0;31m');
  }

  public function warning($message, array $context = []) {

    $this->output($message . PHP_EOL, '[0;33m');
  }

  public function verboseWarning($message, array $context = []) {

    if ($this->verbose) {
      $this->warning($message, $context);
    }
  }

  public function notice($message, array $context = []) {

    $this->output($message . PHP_EOL);
  }

  public function info($message, array $context = []) {

    $this->output($message . PHP_EOL, '[0;32m');
  }

  public function verboseInfo($message, array $context = []) {

    if ($this->verbose) {
      $this->info($message, $context);
    }
  }

  public function debug($message, array $context = []) {
    
    $this->output($message . PHP_EOL, '[0;35m');
  }

  public function log($level, $message, array $context = []) {

    if (method_exists($this, $level)) {
      call_user_func([$this, $level], $message, $context);
    }
  }

  public function verboseLog($level, $message, array $context = []) {

    if ($this->verbose) {
      $this->log($level, $message, $context);
    }
  }

  protected function output($message, $marker = '[0;37m') {

    print chr(27) . $marker . $message . chr(27) . '[0m';
  }

}
