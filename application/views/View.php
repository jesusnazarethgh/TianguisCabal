<?php
/**
 * @package Garson
 * @author Argel Arias <levhita@gmail.com> 
 */ 

/**
 * {@link View} Class, all custom classes are made from this one
 */
class View {
  /**
   * Holds variables to be passed to the templates
   * @var Array
   */
  protected $_variables = array();
  
  /**
   * Fullpath of the template to be shown.
   * @var string
   */
  protected $_template = '';
  
  /**
   * Constructor for class {@link View}
   * @param string $template_name
   * @return View
   */
  public function __construct($templateName)
  {
    $this->setTemplate($templateName);
  }
  
  /**
   * Sets the template to be shown
   * @param string $template_name the template name, it'll be completed with a
   * path and extension.
   * @throws InvalidArgumentException 
   * @return null
   */
  public function setTemplate($templateName)
  {
      
    $template = APPLICATION_PATH . "/layouts/$templateName.phtml";
    if ( !file_exists($template) ) {
      throw new InvalidArgumentException("Couldn't find template '$template'");
    }
    $this->_template = $template;
  }
  
  /**
   * Assigns a variable to be visible in the Template
   * @param string $field
   * @param var $value
   * @return null
   */
  public function assign( $field, $value ) {
    $this->_variables[ $field ] = $value;
  }
  
  /**
   * Displays the Template
   * @return null
   */
  public function display() {
    $Vars = (object) $this->_variables;
    include $this->_template;
  }
}