<?php

/**
 * 
 * Formulario 
 * @author agustinisc.ngupisoft.com
 *
 */
class Amaguk_html_form {	
	
	protected $method="post";
	protected $name="";
	protected $form_name="";
	protected $class="";
	
	protected $db_operacion="";
	
	protected $mensajes;
	protected $request_method="";
	protected $showForm=true;
	
	/**
	 * Nombre del formulario phtml que se debe cargar, se recomienda que el nombre sea igual que el archivo
	 * @var String
	 */
	protected $html_form="";	
	
	/**
	 * @return the $html_form
	 */
	public function getHtml_form() {
		return $this->html_form;
	}

	/**
	 * @param String $html_form
	 */
	public function setHtml_form($html_form) {
		$this->html_form = $html_form;
	}

	/**
	 * @return the $form_name
	 */
	public function getForm_name() {
		return $this->form_name;
	}

	/**
	 * @param field_type $form_name
	 */
	public function setForm_name($form_name) {
		$this->form_name = $form_name;
	}

	public function getTxtOperacion(){
		switch($this->db_operacion){
			case 'insert': 
				return 'Nuevo';
			break;
			case 'update': 
				return 'Editar';
			break;
		}
	}
	
	/**
	 * @return the $request_method
	 */
	public function getRequest_method() {
		return $this->request_method;
	}

	/**
	 * @return the $showForm
	 */
	public function getShowForm() {
		return $this->showForm;
	}

	/**
	 * @param field_type $request_method
	 */
	public function setRequest_method($request_method) {
		$this->request_method = $request_method;
	}

	/**
	 * @param field_type $showForm
	 */
	public function setShowForm($showForm) {
		$this->showForm = $showForm;
	}

	public function isValid($values){
		return true;
	}
	
	public function isPost(){
		if ($this->request_method=="POST")
			return true;
		return false;		
	}
	
	public function getPost(){
		return $_POST;
	}
	 
	
	public function __construct(){
		$this->request_method = $_SERVER["REQUEST_METHOD"];
		if ( isset($_REQUEST["db_operacion"] ))
			$this->db_operacion = $_REQUEST["db_operacion"];
		if ( isset($_REQUEST["form_name"] ))
			$this->form_name = $_REQUEST["form_name"];

		$this->mensajes=array();
	}

	/**
	 * @return the $mensajes
	 */
	public function getMensajes() {
		return $this->mensajes;
	}

	/**
	 * @param field_type $mensajes
	 */
	public function setMensajes($mensajes) {
		$this->mensajes = $mensajes;
	}
	
	/**
	 * @param field_type $mensajes
	 */
	public function add_mensaje($key,$mensaje) {
		$this->mensajes[$key] = $mensaje;
	}
	
	public function fetch_mensaje($key) {
		if (isset($this->mensajes[$key]))
			return $this->mensajes[$key];
		else
			return "";
	}	
	
	

	public function validData($expresionRegular,$string){
		if (preg_match($expresionRegular, $string)){
			return true;
		}
		else{
			return false;
		}		
	}
	
	/**
	 * @return the $db_operacion
	 */
	public function getDb_operacion() {
		return $this->db_operacion;
	}

	/**
	 * @param field_type $db_operacion
	 */
	public function setDb_operacion($db_operacion) {
		$this->db_operacion = $db_operacion;
	}

	/**
	 * @return the $class
	 */
	public function getClass() {
		return $this->class;
	}

	/**
	 * @param field_type $class
	 */
	public function setClass($class) {
		$this->class = $class;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param field_type $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @return the $method
	 */
	public function getMethod() {
		return $this->method;
	}

	/**
	 * @param field_type $method
	 */
	public function setMethod($method) {
		$this->method = $method;
	}
	
	
	public function show(){
		$this->printForm();
		
	}
/* (non-PHPdoc)
	 * @see amaguk_controller_interface::index_action()
	 */
	public function index_action() {
		// TODO Auto-generated method stub
		
	}



	
	
}

?>