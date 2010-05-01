<?php

class IndexView {
  /**
   * @var Array
   */
  protected $variables = array();
  
  public function assign( $field, $value ) {
    $this->variables[ $field ] = $value;
  }
  
  public function display() {
    $Vars = (object) $this->variables;
    include APPLICATION_PATH . "/layouts/index.phtml";
  }
}
