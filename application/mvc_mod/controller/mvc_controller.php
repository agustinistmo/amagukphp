<?php
	require_once 'application/mvc_mod/model/mvc_dao.php';
	require_once 'application/mvc_mod/model/mvc_databean.php';
	require_once 'application/mvc_mod/forms/mvc_form.php';
	
/**
 * 
 * 
 * @author http://amagukmx.wordpress.com/
 * 2013/12/03 16:18:33
 */
class mvc_controller extends Amaguk_controller {

	function __construct(){
		$this->controller_title="mvc";
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
				
		$mvc_dao = new mvc_dao();
		$mvc_form = new mvc_form();

		if ( $this->getMethod_request() == "POST"){			
			$mvc_form->bean->_setValues($_POST);
			switch ( $mvc_form->getDb_operacion() ){
				case "delete":
					$mvc_dao->delete( $mvc_form->bean );
				break;
				case "busqueda":
				break;
			}
		}
		
		$this->view->items = $mvc_dao->fetchDataBeans();
	}

	public function form_action(){
		$this->action_title="Formulario";
		//$this->layout="developer";
		$mvc_form = new mvc_form();
		$mvc_dao = new mvc_dao();
				
		$mvc_form->message_title="Vamos bien";
		$mvc_form->message_css="alert-success";
		$mvc_form->message_text ="";
		
		if ( $this->getMethod_request() == "POST"){			
			$mvc_form->bean->_setValues($_POST);
			switch ( $mvc_form->getDb_operacion() ){
				case "insert":					
					$mvc_databean = $mvc_form->bean; 
					$mvc_dao->insert( $mvc_databean );
					if ( $mvc_databean->getHistoria_id() >0 ){
						$mvc_form->setDb_operacion("update");
						$mvc_form->message_title="Agregar";
						$mvc_form->message_css="alert-success";
						$mvc_form->message_text ="Registro exitoso";						
					}else{
						$mvc_form->setDb_operacion("update");
						$mvc_form->message_title="Agregar";
						$mvc_form->message_css="alert-danger";						
						$mvc_form->message_text ="No se pudo agregar el registro";							
						}
				break;
				case "update":
					$mvc_dao->update( $mvc_form->bean );
					$mvc_form->setDb_operacion("update");
					$mvc_form->message_title="Actualizar";
					$mvc_form->message_css="alert-success";					
					$mvc_form->message_text ="Registro actualizado";						
				break;
				case "edit":
					$mvc_dao->fetchDataBean( $mvc_form->bean );
					$mvc_form->setDb_operacion("update");
				break;				
			}
		}else {
			$mvc_form->setDb_operacion("insert");
		}
		$this->view->mvc_form = $mvc_form;
	}


}
?>