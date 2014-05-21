<?php

/**
 * Data Bean for mgk_usuario
 * @author amaguk.ngupisoft.com/gca 
 * 2013/11/19 09:37:05
 */
class usuario_databean  extends  Amaguk_databean  {
//- - - - properties

	/**
	 * Enter description here ...
	 * @var int
	 */
	protected $usuario_id;
	
	protected $usuario_id_inserta;
	
	protected $usuario_id_actualiza;

	/**
	 * Enter description here ...
	 * @var string
	 */
	protected $usuario_email;

	/**
	 * Enter description here ...
	 * @var string
	 */
	protected $usuario_password;
	
	protected $usuario_password_o;
	
	protected $comentarios;
	
	protected $usuario_password_n;

	/**
	 * Enter description here ...
	 * @var int
	 */
	protected $tipo_usuario_id;

	/**
	 * Enter description here ...
	 * @var string
	 */
	protected $nombre;
	
	protected $token;
	
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
	
	/**
	 * Fecha de insert en base de datos
	 * @var datetime
	 */
	protected $fecha_inserta;
	
	/**
	 * Fecha de inicio del usuario en la empresa
	 * @var date
	 */
	protected $fecha_inicio;
	
	/**
	 * 
	 * @var datetime
	 */
	protected $fecha_elimina;
	
	protected $historia_id;



//- - - -  methods
	
	/**
	 * @return the $usuario_id
	 */
	public function getUsuario_id() {
		return $this->usuario_id;
	}
	
	
	public function getHistoria_id() {
		return $this->historia_id;
	}	
	
	public function getUsuario_id_inserta() {
		return $this->usuario_id_inserta;
	}
	
	public function getUsuario_id_actualiza() {
		return $this->usuario_id_actualiza;
	}
	
	/**
	 * 
	 * @return datetime
	 */
	public function getFecha_inserta() {
		return $this->fecha_inserta;
	}
	
	public function getFecha_elimina() {
		return $this->fecha_elimina;
	}	

	/**
	 * 
	 * @return date
	 */
	public function getFecha_inicio() {
		return $this->fecha_inicio;
	}

	public function getFecha_actualiza() {
		return $this->fecha_actualiza;
	}
	
	public function getComentarios() {
		return $this->comentarios;
	}
	
	public function getToken() {
		return $this->token;
	}	
	
	/**
	 * @return the $usuario_email
	 */
	public function getUsuario_email() {
		return $this->usuario_email;
	}
	
	/**
	 * @return the $usuario_password
	 */
	public function getUsuario_password() {
		return $this->usuario_password;
	}
	
	public function getUsuario_password_n() {
		return $this->usuario_password_n;
	}
	
	public function getUsuario_password_o() {
		return $this->usuario_password_o;
	}
	
	/**
	 * @return the $tipo_usuario_id
	 */
	public function getTipo_usuario_id() {
		return $this->tipo_usuario_id;
	}
	
	/**
	 * @return the $nombre
	 */
	public function getNombre() {
		return $this->nombre;
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
	 * @param field_type $usuario_id
	 */
	public function setUsuario_id($usuario_id) {
		$this->usuario_id = $usuario_id;
	}
	
	public function setUsuario_id_inserta($usuario_id_inserta) {
		$this->usuario_id_inserta = $usuario_id_inserta;
	}
	
	public function setUsuario_id_actualiza($usuario_id_actualiza) {
		$this->usuario_id_actualiza = $usuario_id_actualiza;
	}	
	
	/**
	 * @param field_type $usuario_email
	 */
	public function setUsuario_email($usuario_email) {
		$this->usuario_email = $usuario_email;
	}
	
	/**
	 * @param field_type $usuario_password
	 */
	public function setUsuario_password($usuario_password) {
		$this->usuario_password = $usuario_password;
	}
	
	public function setUsuario_password_o($usuario_password_o) {
		$this->usuario_password_o = $usuario_password_o;
	}
	
	public function setUsuario_password_n($usuario_password_n) {
		$this->usuario_password_n = $usuario_password_n;
	}	
	
	/**
	 * @param field_type $tipo_usuario_id
	 */
	public function setTipo_usuario_id($tipo_usuario_id) {
		$this->tipo_usuario_id = $tipo_usuario_id;
	}
	
	/**
	 * @param field_type $nombre
	 */
	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}
	
	public function setToken($token) {
		$this->token = $token;
	}	
	
	/**
	 * 
	 * @param datetime $fecha_inserta
	 */
	public function setFecha_inserta($fecha_inserta) {
		$this->fecha_inserta = $fecha_inserta;
	}
	
	public function setFecha_actualiza($fecha_actualiza) {
		$this->fecha_actualiza = $fecha_actualiza;
	}	

	/**
	 * 
	 * @param date $fecha_inicio
	 */
	public function setFecha_inicio($fecha_inicio) {
		$this->fecha_inicio = $fecha_inicio;
	}	
	
	/**
	 * 
	 * @param datetime $fecha_elimina
	 */
	public function setFecha_elimina($fecha_elimina) {
		$this->fecha_elimina = $fecha_elimina;
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
	
	public function setHistoria_id($historia_id) {
		$this->historia_id = $historia_id;
	}
	
	public function setComentarios( $comentarios ) {
		$this->comentarios = $comentarios;
	}

}
?>