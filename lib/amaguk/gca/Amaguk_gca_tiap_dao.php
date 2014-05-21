<?php

require_once ('lib/amaguk/gca/interfaces/amaguk_gca_dao_interface.php');
require_once 'lib/amaguk/comun/database_connection.php';

/**
 * 
 * Generador de codigo automatico para la clase DAO
 * @author http://amagukmx.wordpress.com/
 *
 */
class amaguk_gca_tiap_dao implements amaguk_gca_dao_interface {
	
	public function __construct( ){
		
	}

	
/* (non-PHPdoc)
	 * @see amaguk_gca_dao_interface::genera_insertar()
	 */
	public function genera_insertar($fields,$table_name , $databean_name) {
		// TODO Auto-generated method stub
		$comma_separated = "'".implode("','", $fields)."'";	
		$code =
"	/**
	 * Insertar registro en la tabla $table_name
	 * @param $databean_name \$$table_name
	 */
	this.insertar = function( $databean_name ){
		this.db_insert( $databean_name ); 
	};\n\n";
		return $code;
	}
	
	public function genera_reemplazar($fields,$table_name , $databean_name) {
		// TODO Auto-generated method stub
		$comma_separated = "'".implode("','", $fields)."'";	
		$code =
"	/**
	 * Reemplaza registro en la tabla $table_name
	 * @param $databean_name \$$table_name
	 */
	this.reemplazar = function( $databean_name ){
		this.db_replace( $databean_name ); 
	};\n\n";
		return $code;
	}	

/* (non-PHPdoc)
	 * @see amaguk_gca_dao_interface::genera_actualizar()
	 */
	public function genera_actualizar($fields,$table_name, $databean_name) {
		// TODO Auto-generated method stub
		$key = $fields[0];
		$method = "get".ucfirst( $key );
		$comma_separated = "'".implode("','", $fields)."'";
		$code =
"	/**
	 * Actualizar registro de la tabla $table_name
	 * @param $table_name \$$table_name
	 */
	 this.actualizar = function ( $databean_name ){
		this._where = ' where $key = ' + $databean_name.$key;
		this.db_update( $databean_name );
	};\n\n";
		return $code;
		
	}

/* (non-PHPdoc)
	 * @see amaguk_gca_dao_interface::genera_eliminar()
	 */
	public function genera_eliminar( $fields , $table_name, $databean_name ) {
		// TODO Auto-generated method stub	
		$field_k =  $fields[0];
		$field_m = "\$$databean_name"."->get".ucfirst($fields[0])."()";
		
		$code =
"	/**
	 * Eliminar registro en la tabla $databean_name
	 * @param $databean_name \$$databean_name
	 */
	this.eliminar = function ( $databean_name ) {
		this._where = ' where $field_k = ' + $databean_name.$field_k;
		this.db_delete( $databean_name );
	};\n\n";
		return $code;
		
	}

/* (non-PHPdoc)
	 * @see amaguk_gca_dao_interface::genera_recuperarDataBean()
	 */
	public function genera_recuperarDataBean($objeto) {
		// TODO Auto-generated method stub
		
	}

/* (non-PHPdoc)
	 * @see amaguk_gca_dao_interface::genera_recuperarDataBeans()
	 */
	public function genera_recuperarDataBeans($objeto) {
		// TODO Auto-generated method stub
		
	}

/* (non-PHPdoc)
	 * @see amaguk_gca_dao_interface::genera_recuperarDataBeanX()
	 */
	public function genera_recuperarDataBeanX($query) {
		// TODO Auto-generated method stub
		
	}

/* (non-PHPdoc)
	 * @see amaguk_gca_dao_interface::genera_recuperarDataBeansX()
	 */
	public function genera_recuperarDataBeansX($query) {
		// TODO Auto-generated method stub
		
	}
/* (non-PHPdoc)
	 * @see amaguk_gca_dao_interface::genera_construct()
	 */
	public function genera_construct( $table_name ) {
		// TODO Auto-generated method stub
		$code =
"	public function __construct(){
		parent::__construct();
		\$this->table_name = \"$table_name\";
	}\n\n";
		return $code;
	}
	
	public function genera_lista($fields,$table_name , $databean_name) {
		// TODO Auto-generated method stub
		$comma_separated = "t.".implode(", t.", $fields);	
		$code =
"	/**
	 * Recupera varios registro en la tabla $table_name
	 * @param $databean_name \$$databean_name
	 */
	this.leer_filas = function( ){
		var $databean_name = new ".$this->databean_class_name."();
		return this.db_retrieve_beans( $databean_name ); 
	};\n\n";
		return $code;		
	}

	public function genera_consulta($fields,$table_name , $databean_name) {
		// TODO Auto-generated method stub
		$field_k =  $fields[0];
		$field_m = "\$$databean_name"."->get".ucfirst($fields[0])."()";
				
		$comma_separated = "t.".implode(", t.", $fields);	
		$code =
"	/**
	 * Recupera un registro en la tabla $table_name
	 * @param $databean_name \$$databean_name
	 */
	this.leer_registro = function( $databean_name ){
		this._where = ' where demo_id = ' + $databean_name.$field_k;
		$databean_name =  this.db_retrieve_bean( $databean_name );
		return $databean_name;
	};\n\n";
		return $code;		
	}	

}

?>