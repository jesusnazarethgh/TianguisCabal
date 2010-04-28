<?php 
/**
 * Main Controller for the application
 * @package TianguisCabal
 */
<<<<<<< HEAD
 
/* vim: et ts=2: */
=======

/*
 * @todo set includepath
 * ini_set('include_path', '');
 */
include_once "../application/controllers/TestController.inc.php";

/**
 * URL = TianguisCabal/test/test/1
 * url_rewrite= TianguisCabal/index.php&controller=test&method=test&value=1
 * test => TestController
 * TEST => testAction
 */

if(isset($_GET['controller']) OR isset($_GET['action']) ) {
  $controller = "indexController";
  $method     = "indexAction";
  $value = '';
} else {
  $controller = ucwords($_GET['controller'])."Controller";
  $method     = strtolower($_GET['method']). "Action";
  $value      = (isset($_GET['value']))?'':$_GET['value'];
}

$Controller = new $controller();
$Controller->$method($value);
>>>>>>> upstream/master
