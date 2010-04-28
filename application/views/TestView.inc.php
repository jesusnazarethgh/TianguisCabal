<?php

class TestView {
  /**
   * @var Array
   */
  protected $variables = array();
  
  public function assign($field, $value){
    $this->variables[$field] = $value;
  }
  
  public function display(){
    $Vars = (object) $this->variables;
    include "../application/layouts/test.phtml";
    
    
    
  }
}