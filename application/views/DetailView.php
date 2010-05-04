<?php
/**
 * @package Garson
 * @author Argel Arias <levhita@gmail.com>
 */

/**
 * Extends {@link View} to create Detail View
 */
class DetailView extends View
{
  /**
   * The Row to show
   * @var DAO
   */
  protected $_Model = Null;
  
  /**
   * @param string $templateName if not given defaults to 'detail'
   * @return DetailView
   */
  public function __construct($templateName='')
  {
    $templateName = ( empty($templateName) )?'detail':$templateName; 
    parent::__construct($templateName);
  }
  
  /**
   * Set the rows to be shown in the list of items
   * @param Array $rows
   * @throws InvalidArgumentException
   * @return NULL
   * @todo this should accept any {@link Model}, nos just {@link DAO}.
   */
  public function setModel($Model){
    if ( !($Model instanceof DAO) ) {
      throw new InvalidArgumentException('A DAO descendant was expected');
    }
    $this->_Model= $Model;
  }
  
  public function display()
  {
    $this->assign('Model', $this->_Model);
    parent::display();
  }
}