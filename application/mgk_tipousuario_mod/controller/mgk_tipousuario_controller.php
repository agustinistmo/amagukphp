<?php
	require_once 'application/mgk_tipousuario_mod/model/mgk_tipousuario_dao.php';
	require_once 'application/mgk_tipousuario_mod/model/mgk_tipousuario_databean.php';
	require_once 'application/mgk_tipousuario_mod/forms/mgk_tipousuario_form.php';
	
/**
 * 
 * AMAGUK_GCA_VERSION: 0.3.0 
 * @author http://amagukmx.wordpress.com/
 * 2013/12/10 10:56:18
 */
class mgk_tipousuario_controller extends Amaguk_controller {

	function __construct(){
		$this->controller_title="mgk_tipousuario";
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
				
		$mgk_tipousuario_dao = new mgk_tipousuario_dao();
		$mgk_tipousuario_form = new mgk_tipousuario_form();

		if ( $this->getMethod_request() == "POST"){			
			$mgk_tipousuario_form->bean->_setValues($_POST);
			switch ( $mgk_tipousuario_form->getDb_operacion() ){
				case "delete":
					$mgk_tipousuario_dao->delete( $mgk_tipousuario_form->bean );
				break;
				case "busqueda":
				break;
			}
		}
		
		$this->items = $mgk_tipousuario_dao->fetchDataBeans();
	}

	public function form_action(){
		$this->action_title="Formulario";
		//$this->layout="developer";
		$mgk_tipousuario_form = new mgk_tipousuario_form();
		$mgk_tipousuario_dao = new mgk_tipousuario_dao();
				
		$mgk_tipousuario_form->message_title="Vamos bien";
		$mgk_tipousuario_form->message_css="alert-success";
		$mgk_tipousuario_form->message_text ="";
		
		if ( $this->getMethod_request() == "POST"){			
			$mgk_tipousuario_form->data->_setValues($_POST);
			switch ( $mgk_tipousuario_form->getDb_operacion() ){
				case "insert":					
					$mgk_tipousuario_databean = $mgk_tipousuario_form->data; 
					$mgk_tipousuario_dao->insert( $mgk_tipousuario_databean );
					if ( $mgk_tipousuario_databean->getTipo_usuario_id() >0 ){
						$mgk_tipousuario_form->setDb_operacion("update");
						$mgk_tipousuario_form->message_title="Agregar";
						$mgk_tipousuario_form->message_css="alert-success";
						$mgk_tipousuario_form->message_text ="Registro exitoso";						
					}else{
						$mgk_tipousuario_form->setDb_operacion("update");
						$mgk_tipousuario_form->message_title="Agregar";
						$mgk_tipousuario_form->message_css="alert-danger";						
						$mgk_tipousuario_form->message_text ="No se pudo agregar el registro";							
						}
				break;
				case "update":
					$mgk_tipousuario_dao->update( $mgk_tipousuario_form->data );
					$mgk_tipousuario_form->setDb_operacion("update");
					$mgk_tipousuario_form->message_title="Actualizar";
					$mgk_tipousuario_form->message_css="alert-success";					
					$mgk_tipousuario_form->message_text ="Registro actualizado";						
				break;
				case "edit":
					$mgk_tipousuario_dao->fetchDataBean( $mgk_tipousuario_form->data );
					$mgk_tipousuario_form->setDb_operacion("update");
				break;				
			}
		}else {
			$mgk_tipousuario_form->setDb_operacion("insert");
		}
		$this->mgk_tipousuario_form = $mgk_tipousuario_form;
	}


}
?>