<?php

namespace TGodin\CarbonIT\Log;

use Psr\Log\LoggerInterface;

interface VerboseLoggerInterface extends LoggerInterface {

  public function setVerbosity($verbose);

  public function getVerbosity();

  public function verboseInfo($message, array $context = []);

  public function verboseWarning($message, array $context = []);

  public function verboseLog($level, $message, array $context = []);
}
