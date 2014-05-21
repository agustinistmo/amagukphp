<?php
	require_once('lib/amaguk/framework/Amaguk_lang.php');
	require_once('lib/amaguk/framework/Amaguk_controller.php');
	require_once('lib/amaguk/framework/Amaguk_databean.php');
	require_once('lib/amaguk/framework/Amaguk_dao.php');
	require_once('lib/amaguk/framework/IAmaguk_framework.php');

/** 
 * 
 * Amaguk PHP Framework. Clase principal del framework
 * @author agustin corona jimenez @agustinistmo
 * 
 */
class Amaguk_framework implements IAmaguk_framework {

	/**
	 * Variable del lenguaje
	 * @var String
	 */
	private $lang="es";
	/**
	 * Objeto de sesión
	 * @var Amaguk_session
	 */
	private $session=0;
	/**
	 * Objeto con las propiedades del sistema
	 * @var Amaguk_properties
	 */
	private $mgkProperties;

	/**
	 * Constructor Amaguk_framework
	 */
	public function __construct() {		
		
		require_once "boot_controller.php";
		
		$this->boot_controller = new boot_controller();
		
		/*$this->session = $boot_controller->session;
		$this->mgkLang = $boot_controller->mgkLang;
		$this->mgkProperties = $boot_controller->mgkProperties;
		$this->mgkFun = $boot_controller->mgkFun;
		$this->mgkParameters =  $boot_controller->mgkParameters;
		$this->estatus_dao = $boot_controller->estatus_dao;*/ 
	}

	/**
	 * Aquí inicia la ejecución del framework
	 * @see IAmaguk_framework::run()
	 */
	function run(){
		$PATH_INFO = "";
		if ( isset ( $_SERVER["PATH_INFO"] ) )
			$PATH_INFO = $_SERVER["PATH_INFO"];
		if ( $PATH_INFO == "")
			header("Location: index.php/");
		$items_path_info = explode("/", $PATH_INFO );
		
		$this->controller = ( isset($items_path_info[1]))?(($items_path_info[1]!="")?$items_path_info[1]:"index"):"index";
		$this->action = ( isset($items_path_info[2]))?(($items_path_info[2]!="")?$items_path_info[2]:"index"):"index";
		$this->controller_name = ($this->controller=="")?'index_controller':$this->controller.'_controller';
		$this->action_name = ($this->action=="")?'index_action':$this->action.'_action';
		$controller_file_name = MGK_APPLICATION_REAL_PATH."/".MGK_WORK_DIRECTORY.$this->controller."_mod/controller/".$this->controller_name.".php";

		if ( !file_exists($controller_file_name)){
			print "Amaguk PHP Framework :: Error.001 : Controlador no encontrado : $this->controller <br>";
			print $controller_file_name;
		}
		else{
			require_once "$controller_file_name";
			$ctrl = new $this->controller_name();
			
			$ctrl->session = $this->boot_controller->session;
			$ctrl->mgkLang = $this->boot_controller->mgkLang;
			$ctrl->mgkProperties = $this->boot_controller->mgkProperties;
			$ctrl->mgkFun = $this->boot_controller->mgkFun;
			$ctrl->mgkParameters = $this->boot_controller->mgkParameters;
			$ctrl->estatus_controller = $this->boot_controller->estatus_controller;
			
			$ctrl->controller = $this->controller;
			$ctrl->action = $this->action;
			$ctrl->layout_directory = MGK_APPLICATION_REAL_PATH."/".MGK_WORK_DIRECTORY."_layouts/";
			$ctrl->layout="index";
			$ctrl->action_directory = MGK_APPLICATION_REAL_PATH."/".MGK_WORK_DIRECTORY.$this->controller."_mod/views/";			
			$action_name = $this->action_name;
			if( method_exists ($ctrl,$action_name))
				$ctrl->$action_name();
			else
				$ctrl->action_name=0;
			$ctrl->show();			
		}
	}
	
	/**
	 * Ejecutar esa funcion cuando se trate de un componente.
	 * // en construccion
	 */
	function component_run(){
		$this->path_info = $_SERVER["PATH_INFO"];
		if ( $this->path_info == "" )
			header("Location: index.php/");
		$atributos = explode("/", $this->path_info);
		$component = ( isset($atributos[1]))?$atributos[1]:"index";
		include MGK_APPLICATION_REAL_PATH."/com_".$component."/index.phtml";
	}	
}
?>