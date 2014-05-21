<?php

/**
 * 
 * Interface para el generador de codigo automatico
 * @author http://amagukmx.wordpress.com/
 *
 */
interface IAmaguk_gca_dao{
	
	public function genera_construct( $table_name );

	/**
	 * Inserta un registro en la tabla de la clase $objeto
	 * @param unknown_type $objeto
	 */
	public function genera_insertar($fields,$table_name,$databean_name);

	/**
	 * Actualiza registros en la tabla de la clase $objeto
	 * @param unknown_type $objeto
	 */
	public function genera_actualizar($fields,$table_name,$databean_name);

	/**
	 * Elimina registros en la tabla de la clase $objeto
	 * @param array $fields
	 * @param String $table_name
	 * @param String $databean_name
	 */
	public function genera_eliminar( $fields , $table_name, $databean_name );	

	/**
	 * Extrar un registros en la tabla de la clase $objeto
	 * @param unknown_type $objeto
	 */
	function genera_recuperarDataBean($objeto);

	/**
	 * Extrar varios registros en la tabla de la clase $objeto
	 * @param unknown_type $objeto
	 */
	function genera_recuperarDataBeans($objeto);
	
	/**
	 * Recuperar Databean sin pertenecer a una clase especifica, el objeto depende del $query
	 * @param String $query
	 */
	function genera_recuperarDataBeanX( $query );
	
	/**
	 * Recuperar Data beans sin pertenecer a una clase especifica, los objetos depende del $query
	 * @param string $query
	 */
	function genera_recuperarDataBeansX( $query );
	
}
?>