<?php
/**
 * Holds the {@link Config} Singleton
 * @package Garson
 * @author Argel Arias <levhita@gmail.com>
 * @copyright Copyright (c) 2010, Argel Arias <levhita@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */
/**
 * Provides a Config abstraction in the form of a singleton
 * 
 */
class Config {
  protected static $config = array();
  protected static $loaded = false;
  protected static $filename = "";
  
  /**
   * Constructor is private so it can't be instantiated
   * @return void
   */
  private function __construct()
  {
  }
  
  /**
   * Get a single value from the config
   * 
   * In the first call, it loads the config file
   * @param string $field
   * @return string
   */
  public static function getConfig($field)
  {
    if ( !self::$loaded ){
      self::load();
      return self::$config[$field];
    } 
  }
  
  /**
   * Set a single config value
   * @param $field
   * @param $value
   * @return unknown_type
   */
  public static function setConfig($field, $value){
    return self::$config[$field]=$value;
  }
  
  /**
   * Loads the config from an ini file into an array
   * 
   * To override the default just call Config::load('filename') with your custom
   * config.
   * @param string $filename
   * @return NULL
   */
  public static function load($filename = '')
  {
    self::$filename = (empty($filename)) ? TO_ROOT . " /application/config.ini" : $filename;
    if ( !file_exists(self::$filename) ) {
      throw new RuntimeException("Couldn't load configuration file: " . self::$filename);
    }
    self::$config = parse_ini_file(self::$filename);  
  }
  
  /**
   * Saves the config from the array file into an inifile
   * 
   * To override the default just call Config::save('filename') with your custom
   * config.
   * @param string $filename
   * @return NULL
   */
  public static function save($filename = '')
  {
    $filename = (empty($filename)) ? TO_ROOT . " /application/config.ini" : $filename;
    if ( !file_exists(self::$filename) ) {
      throw new RuntimeException("Configuration file doesn't exist: " . $filename);
    }
    $config_string = '';
    foreach (self::$config AS $field => $value) {
      $config_string .= "$field=$value\n";
    }
    
    if ( file_put_contents($file_name, $config_string)==false) {
      throw new RunTimeException("Couldn't save configuration file: ". $filename);
    }  
  }
}