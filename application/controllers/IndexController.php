<?php
/**
 * Main Controller, the one that gets shown when you don't send any parameter
 * @package TianguisCabal 
 */
class IndexController
{

  public function indexAction()
    { 
        $Category = new CategoryModel(2);
        $Category->load();
        
        $View = new DetailView();
        $View->setModel($Category);
        
        $View->display();
    } 
}
