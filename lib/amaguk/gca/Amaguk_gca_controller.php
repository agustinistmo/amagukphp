<?php

/**
 * Generador de controladores
 * @author agustin corona jimenez
 *
 */
class Amaguk_gca_controller {
	
	/**
	 * Arreglo con lista de campos de la tabla
	 * @var array
	 */
	public $fields;
	/**
	 * Nombre del dao
	 * @var String
	 */
	public $dao_name;
	/**
	 * Nombre del databean
	 * @var String
	 */
	public $databean_name;
	
	function __construct(){
		$this->fields = array();
		$this->dao_name = "";
		$this->databean_name = "";
	}
	
	public function create_index_action(){
		$code = "
	/* (non-PHPdoc)
	 * @see amaguk_controller_interface::index_action()
	 */		
	public function index_action() {
		// TODO Auto-generated method stub
		// Agrega todas tus variables en  el objeto \$this->myProperties y usala en la vista
		//\$this->layout=\"developer\"; // Puedes usar plantillas diferentes por cada acción
		\$this->action_title=\"Inicio\";

		\$this->message_title=\"Hola!\";
		\$this->message_css=\"alert-info\";		 
		\$this->message_text =\"Saludos\";	
				
		// Crea aquí la programación para esta acción
		
	}\n\n";
		return $code;
	}
	
	public function create_lista_action( $dao_name , $databean_name , $form_name){
		$code ="	public function lista_action() {
		// TODO Auto-generated amaguk
		//\$this->layout=\"developer\";
		\$this->action_title=\"Listado\";
		
		\$this->message_css=\"alert-success\";		
		\$this->message_title=\"Hola\";
		\$this->message_text =\"\";
				
		\$$dao_name = new $dao_name();
		\$$form_name = new $form_name();

		if ( \$this->getMethod_request() == \"POST\"){			
			\$$form_name"."->data->_setValues(\$_POST);
			switch ( \$$form_name"."->getDb_operacion() ){
				case \"delete\":
					\$$dao_name"."->delete( \$$form_name"."->data );
				break;
				case \"busqueda\":
				break;
			}
		}
		
		\$this->items = \$$dao_name"."->fetchDataBeans();
	}\n\n";
		return $code;
	}

	public function create_form_action( $fields, $dao_name , $databean_name , $form_name){
		$this->fields = $fields;
		$this->dao_name = $dao_name;
		$this->databean_name = $databean_name;
		
		$setMethod = "set".ucfirst( $fields[0]["name"] );
		$getMethod = "get".ucfirst( $fields[0]["name"] );
		
		
		$code="	public function form_action(){
		\$this->action_title=\"Formulario\";
		//\$this->layout=\"developer\";
		\$$form_name = new $form_name();
		\$$dao_name = new $dao_name();
				
		\$$form_name"."->message_title=\"Vamos bien\";
		\$$form_name"."->message_css=\"alert-success\";
		\$$form_name"."->message_text =\"\";
		
		if ( \$this->getMethod_request() == \"POST\"){			
			\$$form_name"."->data->_setValues(\$_POST);
			switch ( \$$form_name"."->getDb_operacion() ){
				case \"insert\":
					\$$dao_name"."->insert( \$$form_name"."->data );
					if ( \$$form_name"."->data"."->$getMethod() >0 ){
						\$$form_name"."->setDb_operacion(\"update\");
						\$$form_name"."->message_title=\"Agregar\";
						\$$form_name"."->message_css=\"alert-success\";
						\$$form_name"."->message_text =\"Registro exitoso\";						
					}else{
						\$$form_name"."->setDb_operacion(\"insert\");
						\$$form_name"."->message_title=\"Agregar\";
						\$$form_name"."->message_css=\"alert-danger\";						
						\$$form_name"."->message_text =\"No se pudo agregar el registro\";							
						}
				break;
				case \"update\":
					\$$dao_name"."->update( \$$form_name"."->data );
					\$$form_name"."->setDb_operacion(\"update\");
					\$$form_name"."->message_title=\"Actualizar\";
					\$$form_name"."->message_css=\"alert-success\";					
					\$$form_name"."->message_text =\"Registro actualizado\";						
				break;
				case \"edit\":
					\$$dao_name"."->fetchDataBean( \$$form_name"."->data );
					\$$form_name"."->setDb_operacion(\"update\");
				break;				
			}
		}else {
			\$$form_name"."->setDb_operacion(\"insert\");
		}
		\$this->$form_name = \$$form_name;
	}\n\n";
		return $code;
	}
	
	public function create_select( $fields,$dao_name ){
		$code ="	public function get_select() {
		// TODO Auto-generated amaguk
		require_once 'lib/amaguk/utils/Amaguk_html_select.php';
		\$$dao_name = new $dao_name();		
		
		\$options = \$$dao_name"."->fetchDataBeans();		
		\$select = new Amaguk_html_select();
		\$select->setName(\"".$fields[0]["name"]."\");
		\$select->setId(\"".$fields[0]["name"]."\");
		\$select->setSelected_value(0);
		\$select->setField_value(\"".$fields[0]["name"]."\");
		\$select->setField_description(\"".$fields[1]["name"]."\");
		\$select->setOptions(\$options);
		return \$select;
	}\n\n";
		return $code;
	}	
}
?>