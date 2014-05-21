<?php
	require_once 'application/demo_mod/model/demo_dao.php';
	require_once 'application/demo_mod/model/demo_databean.php';
	require_once 'application/demo_mod/forms/demo_form.php';
	
/**
 * 
 * 
 * @author http://amagukmx.wordpress.com/
 * 2013/12/03 17:11:51
 */
class demo_controller extends Amaguk_controller {

	function __construct(){
		$this->controller_title="Demo";
	}


	/* (non-PHPdoc)
	 * @see amaguk_controller_interface::index_action()
	 */		
	public function index_action() {
		// TODO Auto-generated method stub
		// Agrega todas tus variables en  el objeto $this->myProperties y usala en la vista
		//$this->layout="developer"; // Puedes usar plantillas diferentes por cada acción
		$this->action_title="Inicio";

		$this->message_title="Hola!";
		$this->message_css="alert-info";		/// Los estilos son de bootstrap3 
		$this->message_text ="Saludos";	/// si esta variable esta vacia no se muestra el mensaje en pantalla
				
		// Crea aquí la programación para esta acción
		
	}

	public function lista_action() {
		// TODO Auto-generated amaguk
		//$this->layout="developer";
		$this->action_title="Listado";
		
		$this->message_css="alert-success";		
		$this->message_title="Hola";
		$this->message_text ="";
				
		$demo_dao = new demo_dao();
		$demo_form = new demo_form();

		if ( $this->getMethod_request() == "POST"){			
			$demo_form->bean->_setValues($_POST);
			switch ( $demo_form->getDb_operacion() ){
				case "delete":
					$demo_dao->delete( $demo_form->bean );
				break;
				case "busqueda":
				break;
			}
		}
		
		$this->view->items = $demo_dao->fetchDataBeans();
	}

	public function form_action(){
		$this->action_title="Formulario";
		//$this->layout="developer";
		$demo_form = new demo_form();
		$demo_dao = new demo_dao();
				
		$demo_form->message_title="Vamos bien";
		$demo_form->message_css="alert-success";
		$demo_form->message_text ="";
		
		if ( $this->getMethod_request() == "POST"){			
			$demo_form->bean->_setValues($_POST);
			switch ( $demo_form->getDb_operacion() ){
				case "insert":					
					$demo_databean = $demo_form->bean; 
					$demo_dao->insert( $demo_databean );
					if ( $demo_databean->getTipo_usuario_id() >0 ){
						$demo_form->setDb_operacion("update");
						$demo_form->message_title="Agregar";
						$demo_form->message_css="alert-success";
						$demo_form->message_text ="Registro exitoso";						
					}else{
						$demo_form->setDb_operacion("update");
						$demo_form->message_title="Agregar";
						$demo_form->message_css="alert-danger";						
						$demo_form->message_text ="No se pudo agregar el registro";							
						}
				break;
				case "update":
					$demo_dao->update( $demo_form->bean );
					$demo_form->setDb_operacion("update");
					$demo_form->message_title="Actualizar";
					$demo_form->message_css="alert-success";					
					$demo_form->message_text ="Registro actualizado";						
				break;
				case "edit":
					$demo_dao->fetchDataBean( $demo_form->bean );
					$demo_form->setDb_operacion("update");
				break;				
			}
		}else {
			$demo_form->setDb_operacion("insert");
		}
		$this->view->demo_form = $demo_form;
	}

	public function lang_action(){
	
	}
	
	public function consulta_action(){
		$dao = new demo_dao();
		$this->items = $dao->consulta_manual();
	}
	
	public function plantilla1_action(){
		$this->layout="clear";
		$arreglo= array();
		$arreglo["clave"]=48;
		$arreglo["nombre"]='enrique c. rebsamen';
		$arreglo["pais"]='México';	
		$this->json = json_encode($arreglo);
		$this->items = $arreglo;
	}
	
	public function plantilla2_action(){
		$this->layout="plantilla2";
		$arreglo= array();
		$arreglo["clave"]=48;
		$arreglo["nombre"]='enrique c. rebsamen';
		$arreglo["pais"]='México';
		$this->json = json_encode($arreglo);
		$this->items = $arreglo;
	}

	public function acercade_action(){
		$this->action_title="Acerca de Amaguk PHP Framework";
		
	}

}
?>