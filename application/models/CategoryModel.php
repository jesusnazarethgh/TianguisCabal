<?php
/**
 * @package TianguisCabal
 * @author Argel Arias <levhita@gmail.com>
 */

/**
 * Extends DAO to provide Category Specific functionality 
 */
class CategoryModel extends DAO {
  public function __construct($id){
    parent::__construct('categoria', $id);
    parent::setIdField('CatID');
  }
}