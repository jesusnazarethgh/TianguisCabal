<?php

#doc
#  classname:  IndexController
#  scope:    PUBLIC
#
#/doc
class IndexController
{
    protected $view, $value;
    
    public function __constructor( $value ) {
        $this->value = $value;
    }

    public function indexAction()
    { 
        $Data = new Model_Test( $this->value );
        
        $this->view = new IndexView();

        $this->view->assign( 'Value', $Data->getValue() );
        $this->view->display();
    } 
}
