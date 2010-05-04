<?php
/**
 * @package Garson
 * @author Argel Arias <levhita@gmail.com>
 */

/**
 * Extends {@link View} to create list of items
 */
class ListView extends View
{
  /**
   * Rows to be shown in the template
   * @var Array
   */
  protected $_rows = array();
  
  /**
   * @param string $templateName if not given defaults to 'list'
   * @return ListView
   */
  public function __construct($templateName='')
  {
    $templateName = ( empty($templateName) )?'list':$templateName; 
    parent::__construct($templateName);
  }
  
  /**
   * Set the rows to be shown in the list of items
   * @param Array $rows
   * @throws InvalidArgumentException
   * @return NULL
   */
  public function setRows($rows){
    if ( !is_array($rows) ) {
      throw new InvalidArgumentException('A multiple Array was expected');
    }
    $this->_rows= $rows;
  }
  
  public function display()
  {
    $this->assign('rows', $this->_rows);
    parent::display();
  }
}