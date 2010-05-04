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
 */
class Config {

  protected static $_instances = array();
  protected $config = array();
  protected $filename = '';
    
  /**
   * Constructor is private so it can't be instantiated
   * @return Config
   */
  protected function __construct($filename){
    $this->filename = $filename;
    if ( !file_exists($this->filename) ) {
      throw new RuntimeException("Couldn't load configuration file: " . $this->filename);
    }
    $this->config = parse_ini_file($this->filename);
  }
  
  /**
   * Loads the config from an ini file into an array
   * 
   * To override the default just call Config::load('filename') with your custom
   * config.
   * @param string $filename
   * @return Config
   */
  public static function getInstance($filename = '')
  {
    $filename = (empty($filename))? APPLICATION_PATH . "/config.ini" : $filename;
    
    if ( !(self::$_instances[$filename] instanceof self)) {
      self::$_instances[$filename] = new self($filename);
    }
    return self::$_instances[$filename];
  }
  
  /**
   * Saves the config from the array file into an inifile
   * 
   * To override the default just call Config::save('filename') with your custom
   * config.
   * @param string $filename
   * @return boolean
   */
  public function save($filename = '')
  {
    $this->filename = (empty($filename)) ? APPLICATION_PATH . "/aconfig.ini" : $filename;
    if ( !file_exists($this->filename) ) {
      throw new RuntimeException("Configuration file doesn't exist: " . $this->filename);
    }
    
    $config_string = '';
    foreach ($this->config AS $field => $value) {
      /**
       * @todo There are some characters that are forbidden as keys
       * and values, they must raise an exception
       * source: http://php.net/manual/en/function.parse-ini-file.php
       */
      $config_string .= "$field=\"$value\"\n";
    }
    
    if ( file_put_contents($this->filename, $config_string)==false) {
      throw new RunTimeException("Couldn't save configuration file: ". $this->filename);
    }
    return true;
  }
  
  /**
   * Get a single value from the config
   * 
   * In the first call, it loads the config file
   * @param string $field
   * @return string
   */
  public function __get($field) {
    return $this->config[$field];
  }
  
  /**
   * Set a single config value
   * @param $field
   * @param $value
   * @return void
   */
  public function __set($field, $value) {
    $this->config[$field] = $value;
  }
  
  public function getFilename(){
    return $this->filename;
  }
}