<?php

/**
 * 
 * Interface para el generador de codigo automatico
 * @author http://amagukmx.wordpress.com/
 *
 */
interface IAmaguk_gca {
	
	/**
	 * Obtiene el número de versión del Amaguk GCA con que se está generando el código automático
	 */
	function get_amaguk_gca_version();
	
	/**
	 * obtener las columnas de una tabla
	 * @param string $table_name
	 */
	function fetch_fields($table_name);
	
	/**
	 * Escribir archivo $file_name en la ruta $path
	 * @param string $path
	 * @param string $file_name
	 * @param string $content
	 */
	function write_file($path, $file_name, $content);
	
	/**
	 * crear metodo get para el campo $field_name
	 * @param string $field_name
	 */
	function create_get_method($field_name);
	
	/**
	 * Crear metodo set para el campo $field_name 
	 * @param string $field_name
	 */
	function create_set_method($field_name);
	
	/**
	 * Crear el metodo get para todos los campos del arreglo $field
	 * @param array $fields
	 */
	function create_get_methods($fields);
	
	/**
	 * Crear el metodo get para todos los campos del arreglo $field
	 * @param array $fields
	 */
	function create_set_methods($fields);
	
	/**
	 * Genera el nombre de la clase dao para la tabla $table_name
	 * @param string $table_name
	 */
	function get_dao_name($table_name);
	
	/**
	 * Genera el nombre de la clase databean para la tabla $table_name
	 * @param string $table_name
	 */
	function get_databean_name($table_name);
	
	/**
	 * Genera el nombre de la clase controlador para la tabla $table_name
	 * @param string $table_name
	 */
	function get_controller_name($table_name);
	
	/**
	 * Crear la vista para la accion index del controlador de la tabla $table_name
	 * @param string $table_name
	 */
	function create_index_view( $table_name = "" );
	
	/**
	 * Crear la vista para la accion edit del controlador de la tabla $table_name,
	 * Por defecto, se genera un formulario 
	 * @param string $table_name
	 */
	function create_edit_view( $table_name = "" );
	
	/**
	 * Crear la vista para la accion list del controlador de la tabla $table_name,
	 * Por defecto se genera un listado 
	 * @param unknown_type $table_name
	 */
	function create_list_view( $table_name = "" );
	
	/** 
	 * Crear la clase dao para la tabla $table_name,
	 * @param string $table_name
	 */
	function create_dao( $table_name = "" );
	
	/**
	 * Crear la clase controller para la tabla $table_name,
	 * @param string $table_name
	 */
	function create_controller( $table_name = "" );
	
	/**
	 * Crear la clase databean para la tabla $table_name,
	 * @param string $table_name
	 */
	function create_databean( $table_name = "" );
	
}
?>