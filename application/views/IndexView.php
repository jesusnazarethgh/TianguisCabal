<?php
/**
 * @package TianguisCabal
 */
/**
 * Extends [@link View} as the Index View
 */
class IndexView extends View{
  
  public function __construct()
  {
    $this->setTemplate('index');  
  }
}
