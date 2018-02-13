<?php

function fraArray($arr, $felt) {
  return isset($arr[$felt]) ? htmlspecialchars($arr[$felt]) : "";
}

?>
