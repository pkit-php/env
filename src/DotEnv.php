<?php

namespace Pkit;

class DotEnv
{
  static function load(string $path): bool
  {
    $lines = @file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if (!$lines)
      return false;
    foreach ($lines as $line) {
      $line = trim($line);
      if (strpos($line, '#') === 0) {
        continue;
      }
      [$name, $value] = explode('=', $line, 2);
      $name = rtrim($name);
      $value = ltrim($value);

      if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
        putenv(sprintf('%s=%s', $name, $value));
        $_ENV[$name] = $value;
        $_SERVER[$name] = $value;
      }
    }
    return true;
  }

}