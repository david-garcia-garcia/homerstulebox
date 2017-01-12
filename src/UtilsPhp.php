<?php

namespace Sabentis\HomersTulebox;

/**
 * Php language level utilities.
 */
class UtilsPhp {

  /**
   * Create a static method call, and make sure it is valid.
   *
   * @param string $class
   * @param string $method
   *
   * @return string
   */
  public static function callbackStatic(string $class, string $method) {
    $class = new \ReflectionClass($class);
    $method = $class->getMethod($method);
    $result = $class->name . '::' . $method->name;
    return $result;
  }

  /**
   * Create an instance callback, and make sure it is valid.
   *
   * @param mixed $instance
   * @param string $method
   * 
   * @return callable
   */
  public static function callbackInstance($instance, string $method) {
    if (is_scalar($instance)) {
      throw new \InvalidArgumentException('Cannot user scalars as callback instances.');
    }
    $class = new \ReflectionClass($instance);
    if ($method = $class->getMethod($method)) {
      return [$instance, $method];
    }
    throw new \InvalidArgumentException('Invalid callback method for type ' . $class->getName());
  }

}