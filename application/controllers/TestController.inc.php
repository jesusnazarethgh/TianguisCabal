<?php
/**
 * 
 * @author Argel Arias <levhita@gmail.com>
 */
class TestController {
  
  /**
   * @todo documentar
   * @param unknown_type $value
   * @return unknown_type
   */
  public function testAction($value)
  {
    include_once "../application/models/TestModel.inc.php";
    include_once "../application/views/TestView.inc.php";
    
    $TestModel = new TestModel($value);
    $TestView = new TestView();
    
    $TestView->assign('TestModel', $TestModel);
    $TestView->display();
  }
}