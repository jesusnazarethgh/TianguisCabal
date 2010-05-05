<?php
class Request {
  protected static $__instance = null;
  
  protected function __construct(){}
  
  /**
   * Get a single instance of the class (Singleton)
   * @return Request
   */
  public static function getInstance() {
    if (!self::$__instance instanceof self) {
      self::$__instance = new self;
    }
    return self::$__instance;
  }
  
  public function getParams() {
    return $_GET;
  }
  
  public function __get($field)
  {
    return $_GET[$field];
  }
}