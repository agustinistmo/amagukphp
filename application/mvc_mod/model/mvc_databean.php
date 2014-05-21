<?php


/**
 * Data Bean for mgk_historia_acceso
 * @author http://amagukmx.wordpress.com/
 * 2013/12/03 16:19:01
 */
class mvc_databean  extends  Amaguk_databean  {
//- - - - properties

	/**
	 * Enter description here ...
	 * @var int
	 */
	protected $historia_id;

	/**
	 * Enter description here ...
	 * @var int
	 */
	protected $usuario_id;

	/**
	 * Enter description here ...
	 * @var datetime
	 */
	protected $fecha_inicio;

	/**
	 * Enter description here ...
	 * @var datetime
	 */
	protected $fecha_salida;

	/**
	 * Enter description here ...
	 * @var string
	 */
	protected $direccion_id;

	/**
	 * Enter description here ...
	 * @var string
	 */
	protected $latitud;

	/**
	 * Enter description here ...
	 * @var string
	 */
	protected $longitud;


//- - - -  methods
	
	/**
	 * @return the $historia_id
	 */
	public function getHistoria_id() {
		return $this->historia_id;
	}
	
	/**
	 * @return the $usuario_id
	 */
	public function getUsuario_id() {
		return $this->usuario_id;
	}
	
	/**
	 * @return the $fecha_inicio
	 */
	public function getFecha_inicio() {
		return $this->fecha_inicio;
	}
	
	/**
	 * @return the $fecha_salida
	 */
	public function getFecha_salida() {
		return $this->fecha_salida;
	}
	
	/**
	 * @return the $direccion_id
	 */
	public function getDireccion_id() {
		return $this->direccion_id;
	}
	
	/**
	 * @return the $latitud
	 */
	public function getLatitud() {
		return $this->latitud;
	}
	
	/**
	 * @return the $longitud
	 */
	public function getLongitud() {
		return $this->longitud;
	}
	
	/**
	 * @param field_type $historia_id
	 */
	public function setHistoria_id($historia_id) {
		$this->historia_id = $historia_id;
	}
	
	/**
	 * @param field_type $usuario_id
	 */
	public function setUsuario_id($usuario_id) {
		$this->usuario_id = $usuario_id;
	}
	
	/**
	 * @param field_type $fecha_inicio
	 */
	public function setFecha_inicio($fecha_inicio) {
		$this->fecha_inicio = $fecha_inicio;
	}
	
	/**
	 * @param field_type $fecha_salida
	 */
	public function setFecha_salida($fecha_salida) {
		$this->fecha_salida = $fecha_salida;
	}
	
	/**
	 * @param field_type $direccion_id
	 */
	public function setDireccion_id($direccion_id) {
		$this->direccion_id = $direccion_id;
	}
	
	/**
	 * @param field_type $latitud
	 */
	public function setLatitud($latitud) {
		$this->latitud = $latitud;
	}
	
	/**
	 * @param field_type $longitud
	 */
	public function setLongitud($longitud) {
		$this->longitud = $longitud;
	}

}
?>