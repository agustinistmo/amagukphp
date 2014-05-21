<?php

/**
 * 
 * @author agustin corona jimenez agustinistmo@gmail.com
 *
 */
class index_controller extends amaguk_controller {
	
	function __construct(){
		$this->controller_title="Inicio";
	}

	public function index_action() {
		$this->action_title="Bienvenido";
	}
	
	public function hola_mundo_action() {
		$this->action_title="Bienvenido";
	}	

}
?>