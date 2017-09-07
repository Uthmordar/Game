<?php

namespace TGodin\CarbonIT\Support;

/**
 * Description of String
 *
 * @author godinta
 */
final class String {

  /**
   * Split string into array respecting unicode.
   *
   * @param string $str
   * @param int $l
   *
   * @return string[]
   */
  public static function str_split_unicode(string $str, int $l = 0): array {
    if ($l > 0) {
      $ret = array();
      $len = mb_strlen($str, "UTF-8");
      for ($i = 0; $i < $len; $i += $l) {
        $ret[] = mb_substr($str, $i, $l, "UTF-8");
      }
      return $ret;
    }
    return preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
  }

}
