<?php
/**
 * Holds the {@link DataAccessObject} model
 * @package Garson
 * @author Argel Arias <levhita@gmail.com>
 * @copyright Copyright (c) 2010, Argel Arias <levhita@gmail.com>
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 */

require_once TO_ROOT . "/application/model/DbConnection.inc.php";

/**
 * Provides a database abstraction of a Row, simplyfing data access and modification
 * @package Garson
 */
class DataAccessObject {
  
  protected $table_name   = '';
  protected $id_field     = '';
  protected $id           = 0;
  protected $data         = array();
  protected $loaded       = false;

  /**
   * Holds the DbConnection
   *
   * @var DbConnection
   */
  protected $DbConnection   = null;
  protected $assert_message = "Class Instance isn't Loaded";
    
  /**
   * Creates DataAccessObject Instance 
   * @param string $table_name
   * @param string $id
   * @return DataAccessObject
   */
  public function __construct($table_name, $id) {
    if (!is_string($table_name)) {
      throw new InvalidArgumentException("table_name isn't an string");
    }
    
    if (!is_integer($id)) {
      throw new InvalidArgumentException("id isn't an integer");
    }
    
    $this->$DbConnection = DbConnection::getInstance();
    
    $this->table_name   = $table_name;
    $this->id           = $id;
    $this->id_field     = "{$table_name}_id";
  }

  /**
   * Loads the data from the database, remember to load before do anything.
   * @return boolean
   */
  public function load()
  {
    if ( $this->id != 0 ) {
      $sql = "SELECT *
              FROM $this->table_name
              WHERE $this->id_field=$this->id;";
      if ( !$this->data = $this->DbConnection->getOneRow($sql) ) {
        return false;
      }
      $this->loaded = true;
      return true;
    }
    return false;
  }
  
  /**
   * Seter for the 
   * @param string $field
   * @param string $value
   * @return NULL
   */
  public function setData($field, $value)
  {
    $this->data[$field] = $value;  
  }
  
  public function getData($field)
  {
    return $this->data[$field];
  }
  
  /**
   * Returns all the data of the row in a convenient array
   * @return array
   */
  public function getAllData()
  {
    return $this->data;
  }
  
  /**
   * Gets Database Structure as returned by MySQL
   * @return array
   */
  public function getStructure() {
    $structure = $this->DbConnection->getAllRows("DESCRIBE $this->table_name;");
    return $structure;
  }
    
  public function getId(){
    return $this->id;
  }
  
  /**
   * Saves the data into the database, checking whether is a new row or an old
   * one that just needs an update
   * @return boolean
   */
  public function save()
  {
    if ( !$this->id ) {
      $fields = array_keys($this->data);
      $fields_string = implode(', ', $fields);
      
      $values = array_values($this->data);
      $aux = array();
      foreach($values as $value)
      {
        $aux[] = "'" . mysql_escape_string($value) . "'";
      }
      $values = implode(', ', $aux);
      
      $sql = "INSERT INTO
              {$this->table_name}($fields_string)
              VALUES($values);";
      if ( !$this->DbConnection->executeQuery($sql) ) {
        return false;
      }
      $this->id = $this->DbConnection->getLastId();
      $this->data[$this->id_field] = $this->id;
    } else {
      $fields_strings = array();
      foreach($this->data as $field => $value)
      {
        $fields_strings[] = "$field='" . mysql_escape_string($value) . "'";
      }
      $field_string = implode(', ', $fields_strings);
      
      $sql = "UPDATE $this->table_name
              SET $field_string
              WHERE $this->id_field=$this->id
              LIMIT 1;";
      if ( !$this->DbConnection->executeQuery($sql) ) {
        return false;
      }
    }
    if ( !$this->loaded ){
      $this->loaded=true;
    }
    return true;
  }
 
  /**
   * Deletes the row on the database, if it violates referential-integrity as
   * defined at database level it will simply return false constraints. 
   * @return boolean
   */
  public function delete()
  {
    $sql = "DELETE FROM $this->table_name
            WHERE $this->id_field=$this->id
            LIMIT 1;";
    if ( !$this->DbConnection->executeQuery($sql) ) {
      return false;
    }
    return true;
  }
  
  /**
   * Asserts that the DataAccessObject is Loaded
   * @return boolean
   */
  protected function assertLoaded()
  {
    if ( !$this->isLoaded() ) {
      throw new RunTimeException($this->assert_message);
    }
    return true;
  }
  
  /**
   * Returns if the class instance is loaded
   * @return boolean
   */
  public function isLoaded()
  {
    return $this->loaded;
  }
}

/* vim: et ts=2: */
