<?php

namespace TGodin\CarbonIT;

use Psr\Log\LoggerInterface;

/**
 * Application config.
 *
 * @author tanguy
 */
class Config {

  const COMMENT_MARKUP = '#';
  protected $data = [];
  protected $log;
  protected $path;

  /**
   *
   * @param LoggerInterface $log
   * @param string $path
   */
  public function __construct(LoggerInterface $log, $path) {

    $this->log = $log;
    $this->path = $path;
  }

  /**
   * Load data.
   */
  public function load() {

    if (!file_exists($this->path)) {
      $this->log->error('Provided configuration file did not exist, empty dataset will be used.');
      $this->data = [];
    } else {
      // Get filtered data.
      $raw = filter_var(file_get_contents($this->path), FILTER_SANITIZE_STRING);
      $commentData = explode(PHP_EOL, $raw);
      $this->data = array_filter($commentData, function($l) { return substr(trim($l), 0, 1) != self::COMMENT_MARKUP;});
    }
  }

  /**
   * Get application data.
   *
   * @return string[]
   */
  public function getConfig() {

    return $this->data;
  }

}
