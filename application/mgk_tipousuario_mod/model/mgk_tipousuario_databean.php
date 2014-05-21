<?php


/**
 * Data Bean for mgk_tipo_usuario
 * AMAGUK_GCA_VERSION: 0.3.0
 * @author http://amagukmx.wordpress.com/
 * 2013/12/10 10:56:18
 */
class mgk_tipousuario_databean  extends  Amaguk_databean  {
//- - - - properties

	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	protected $tipo_usuario_id;

	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	protected $tipo_usuario_nombre;

	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	protected $descripcion;


//- - - -  methods
	
	/**
	 * @return the $tipo_usuario_id
	 */
	public function getTipo_usuario_id() {
		return $this->tipo_usuario_id;
	}
	
	/**
	 * @return the $tipo_usuario_nombre
	 */
	public function getTipo_usuario_nombre() {
		return $this->tipo_usuario_nombre;
	}
	
	/**
	 * @return the $descripcion
	 */
	public function getDescripcion() {
		return $this->descripcion;
	}
	
	/**
	 * @param field_type $tipo_usuario_id
	 */
	public function setTipo_usuario_id($tipo_usuario_id) {
		$this->tipo_usuario_id = $tipo_usuario_id;
	}
	
	/**
	 * @param field_type $tipo_usuario_nombre
	 */
	public function setTipo_usuario_nombre($tipo_usuario_nombre) {
		$this->tipo_usuario_nombre = $tipo_usuario_nombre;
	}
	
	/**
	 * @param field_type $descripcion
	 */
	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}

}
?>