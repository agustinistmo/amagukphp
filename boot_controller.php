<?php
require_once 'lib/amaguk/utils/Amaguk_session.php';
require_once 'application/usuario_mod/model/usuario_databean.php';
require_once 'lib/amaguk/framework/Amaguk_properties.php';
 
/**
 * boot_controller.php 
 * Clase inicial al arrancar el framework
 * Copyright 2013 AGUSTIN CORONA JIMENEZ. All rights reserved.
 * agustinistmo@gmail.com 
 * http://amagukmx.wordpress.com/
 */ 
class boot_controller extends Amaguk_controller {
	
	/**
	 * Variable del lenguaje
	 * @var String
	 */
	public $language;
	
	/**
	 * Constructor de boot_controller
	 */
	public function __construct(){
		$this->start();
	}
		
	public function index_action() {
		}
		
	/**
	 * Leer si hay sesión iniciada
	 */
	public function read_session(){
		$this->session = new Amaguk_session();		
		session_start();
		if (  $this->session->is_login() )
			$this->session->usuario = $this->session->get_login();
		else
			$this->session->usuario = null;
	}

	/**
	 * Cargar las etiquetas del lenguaje definido
	 */
	public function language(){
		defined('MGK_LANGUAGE')
		    || define('MGK_LANGUAGE', $this->lang );

		$language = MGK_LANGUAGE;	
		$file_lang = MGK_APPLICATION_DIRECTORY.'/_language/'.$language.'.json';
		$this->mgkLang = new Amaguk_lang( $language );			
		$this->mgkLang->read_lang($file_lang);			
	}
	
	
	public function read_properties(){
		$this->mgkProperties = new Amaguk_properties();	  		
	}
		
	public function start(){
		$this->language();
		$this->read_session();
		$this->read_properties();
	}
}
?>