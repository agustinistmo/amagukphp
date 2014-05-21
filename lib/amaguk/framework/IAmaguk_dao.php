<?php
/**
 * 
 * Interface Amaguk Data access object
 * @author agustin corona jimenez @agustinistmo
 *
 */
interface IAmaguk_dao{
	public function __construct();

	/**
	 * Inserta un registro en la tabla de la clase $objeto
	 * @param unknown_type $objeto
	 */
	public function _insertar($objeto);

	/**
	 * Actualiza registros en la tabla de la clase $objeto
	 * @param unknown_type $objeto
	 */
	public function _actualizar($objeto);
	
	/**
	 * Elimina registros en la tabla de la clase $objeto
	 * @param unknown_type $objeto
	 */
	public function _eliminar();	

	/**
	 * Extrar un registros en la tabla de la clase $objeto
	 * @param unknown_type $objeto
	 */
	function _recuperarDataBean($objeto);

	/**
	 * Extrar varios registros en la tabla de la clase $objeto
	 * @param unknown_type $objeto
	 */
	function _recuperarDataBeans($objeto);
	
	/**
	 * Recuperar Databean sin pertenecer a una clase especifica, el objeto depende del $query
	 * @param String $query
	 */
	function _recuperarDataBeanX( $query = ""  );
	
	/**
	 * Recuperar Data beans sin pertenecer a una clase especifica, los objetos depende del $query
	 * @param string $query
	 */
	function _recuperarDataBeansX( $query = ""  );
}
?>