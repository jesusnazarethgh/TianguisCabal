<?php 
/**
 * Front Controller for the application
 * @package TianguisCabal
 */
 
/*
 * Paths for the application
 *
 * Copied directly from zf-tool's generated Front Controller.
 */
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) .
    '/../application'));

// Ensure library/ is on include_path
set_include_path( implode( PATH_SEPARATOR, array(
    realpath( APPLICATION_PATH . '/../library' ),
    get_include_path(),
)));

/*
 * Autoloader
 *
 * This will ensure that we don't need to include stuff; it will do it for us.
 */
function __autoload($class_name)
{
    // replace underscores for path delimiters
    $path = str_replace('_', '/', $class_name);
    
    // check for controllers
    $path = ( stristr( $class_name, 'controller' ) ) ? 'controllers/' . $path : $path;
    
    // check for views
    $path = ( stristr( $class_name, 'view' ) ) ? 'views/' . $path : $path;
    
    // check for models
    $path = ( stristr( $class_name, 'model' ) ) ? 'models/' . $path : $path;
    
    // add the application path and the php extension
    require_once APPLICATION_PATH . '/' . $path . '.php';
}

/**
 * URL = TianguisCabal/test/test/1
 * url_rewrite= TianguisCabal/index.php&controller=test&action=test&value=1
 * test => TestController
 * TEST => testAction
 */

if( !isset( $_GET['controller'] ) OR !isset( $_GET['action'] ) ) {
    $controller = "IndexController";
    $action     = "indexAction";
    $value      = '';
} else {
    $controller = ucwords( $_GET['controller'] ) . "Controller";
    $action     = strtolower( $_GET['action'] ) . "Action";
    $value      = ( isset( $_GET['value'] ) ) ? '' : $_GET['value'];
}

$Controller = new $controller();
$Controller->$action( $value );
