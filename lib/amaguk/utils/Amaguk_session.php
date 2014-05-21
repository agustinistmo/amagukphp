<?php

/**
 * 
 * Enter description here ...
 * Amaguk PHP Framework. Session
 * @author agustin corona jimenez @agustinistmo
 * @since 2011
 *
 */
class Amaguk_session{
	
	private $login_session_name = "ses_login";
	
	/**
	 * 
	 * @var usuario_databean
	 */
	public $usuario;
	
	public function __construct(){
		$this->login_session_name =	MGK_SESSION_NAME;		
		if ( file_exists( MGK_APPLICATION_REAL_PATH."/usuario_mod/model/usuario_databean.php") )		
			$this->usuario = new usuario_databean();
		else
			$this->usuario=0;		
	}
	
	/**
	 * Recibe un objeto para guardarlo en la variable principal de sesión, si la variable $es_usuario es TRUE,entonces se copia el valor de $ses_login en $this->usuario
	 * @param object $ses_login
	 * @param boolean $es_usuario
	 */
	public function set_login( $ses_login , $es_usuario = false ){
		$_SESSION[$this->login_session_name] = $ses_login;
		if ( $es_usuario )
			$this->usuario = $ses_login;
	}
	
	public function delete_login(){
		unset( $_SESSION[$this->login_session_name] );
		session_destroy();
	}
	
	public function get_login( ){
		if (isset ( $_SESSION[$this->login_session_name] ))
			return $_SESSION[$this->login_session_name];
		else 
			return null;
	}

	/**
	 * usuario_databean
	 */
	public function get_session_user( ){
		if (isset ( $_SESSION[$this->login_session_name] ))
			$this->usuario =  $_SESSION[$this->login_session_name];
		else
			$this->usuario;
		return $this->usuario;
	}	
	
	public function is_login( ){
		if (isset ( $_SESSION[$this->login_session_name] ))
			return true;
		else
			return false;
	}
	
	public function no_login( ){
		return !$this->is_login();
	}
}

?>