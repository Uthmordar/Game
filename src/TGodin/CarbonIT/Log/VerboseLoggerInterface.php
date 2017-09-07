<?php

namespace TGodin\CarbonIT\Log;

use Psr\Log\LoggerInterface;

interface VerboseLoggerInterface extends LoggerInterface {

  public function setVerbosity(bool $verbose): LoggerInterface;

  public function getVerbosity(): bool;

  public function verboseInfo(string $message, array $context = []): void;

  public function verboseWarning(string $message, array $context = []): void;

  public function verboseLog(string $level, string $message, array $context = []): void;
}
