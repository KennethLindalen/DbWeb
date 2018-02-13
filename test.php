<?php

class Test {
  private static $test = "ok";

  public static function getTest() {
    return self::$test;
  }
}

echo Test::getTest();

?>
