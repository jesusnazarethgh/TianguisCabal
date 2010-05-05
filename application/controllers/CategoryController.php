<?php
/**
 * Category Controller
 * @package TianguisCabal 
 */
class CategoryController extends Controller
{

  public function detailAction()
  { 
    $Category = new CategoryModel((int)$this->_request->value);
    $Category->load();
     
    $View = new DetailView();
    $View->setModel($Category);
        
    $View->display();
  }

  public function listAction()
  { 
    $DbConnection = DbConnection::getInstance();
    
    $sql= "SELECT * FROM categoria";
    $categories = $DbConnection->getAll($sql);
    $View = new ListView();
    $View->setRows($categories);

    $View->display();
  } 
}
