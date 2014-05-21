<?php
	require_once 'application/mgk_historiaacceso_mod/model/mgk_historiaacceso_dao.php';
	require_once 'application/mgk_historiaacceso_mod/model/mgk_historiaacceso_databean.php';
	require_once 'application/mgk_historiaacceso_mod/forms/mgk_historiaacceso_form.php';
	
/**
 * 
 * 
 * @author amaguk_gca
 * 2013/11/21 13:42:24
 */
class mgk_historiaacceso_controller extends amaguk_controller {


	/* (non-PHPdoc)
	 * @see amaguk_controller_interface::index_action()
	 */		
	public function index_action() {
		// TODO Auto-generated method stub
		// Agrega todas tus variables en view e imprimelas en su archivo de vista
		$this->view->saludos = "Controlador generado automaticamente";
		//$this->layout="developer";

		$this->css_mensaje="alert-success";		
		$this->tipo_mensaje="Vamos bien";
		$this->mensaje="Mensaje de bienvenida";				
		
	}

	public function lista_action() {
		// TODO Auto-generated amaguk
		//$this->layout="developer";
		
		$this->css_mensaje="alert-success";		
		$this->tipo_mensaje="Vamos bien";
		$this->mensaje="";	
				
		$mgk_historiaacceso_dao = new mgk_historiaacceso_dao();
		$mgk_historiaacceso_form = new mgk_historiaacceso_form();

		if ( $this->getMethod_request() == "POST"){			
			$mgk_historiaacceso_form->bean->_setValues($_POST);
			switch ( $mgk_historiaacceso_form->getDb_operacion() ){
				case "delete":
					$mgk_historiaacceso_dao->delete( $mgk_historiaacceso_form->bean );
				break;
				case "busqueda":
				break;
			}
		}
		
		$this->view->items = $mgk_historiaacceso_dao->fetchDataBeans();
	}

	public function form_action(){
		//$this->layout="developer";
		$mgk_historiaacceso_form = new mgk_historiaacceso_form();
		$mgk_historiaacceso_dao = new mgk_historiaacceso_dao();
		
		$mgk_historiaacceso_form->css_mensaje="alert-success";		
		$mgk_historiaacceso_form->tipo_mensaje="Vamos bien";
		$mgk_historiaacceso_form->mensaje="";
		
		if ( $this->getMethod_request() == "POST"){			
			$mgk_historiaacceso_form->bean->_setValues($_POST);
			switch ( $mgk_historiaacceso_form->getDb_operacion() ){
				case "insert":					
					$mgk_historiaacceso_databean = $mgk_historiaacceso_form->bean; 
					$mgk_historiaacceso_dao->insert( $mgk_historiaacceso_databean );
					if ( $mgk_historiaacceso_databean->getHistoria_id() >0 ){
						$mgk_historiaacceso_form->setDb_operacion("update");
						$mgk_historiaacceso_form->css_mensaje="alert-success";		
						$mgk_historiaacceso_form->tipo_mensaje="Agregar";
						$mgk_historiaacceso_form->mensaje="Registro exitoso";						
					}else{
						$mgk_historiaacceso_form->setDb_operacion("update");
						$mgk_historiaacceso_form->css_mensaje="alert-error";		
						$mgk_historiaacceso_form->tipo_mensaje="Agregar";
						$mgk_historiaacceso_form->mensaje="No se pudo agregar el registro";							
						}
				break;
				case "update":
					$mgk_historiaacceso_dao->update( $mgk_historiaacceso_form->bean );
					$mgk_historiaacceso_form->setDb_operacion("update");
					$mgk_historiaacceso_form->css_mensaje="alert-success";		
					$mgk_historiaacceso_form->tipo_mensaje="Actualizar";
					$mgk_historiaacceso_form->mensaje="Registro actualizado";						
				break;
				case "edit":
					$mgk_historiaacceso_dao->fetchDataBean( $mgk_historiaacceso_form->bean );
					$mgk_historiaacceso_form->setDb_operacion("update");
				break;				
			}
		}else {
			$mgk_historiaacceso_form->setDb_operacion("insert");
		}
		$this->view->mgk_historiaacceso_form = $mgk_historiaacceso_form;
	}


}
?>