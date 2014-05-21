<?php
	require_once 'application/usuario_mod/model/usuario_dao.php';
	require_once 'application/usuario_mod/model/usuario_databean.php';
	require_once 'application/usuario_mod/forms/usuario_form.php';
	
	require_once 'lib/amaguk/utils/Amaguk_mail.php';
	
/**
 * 
 * 
 * @author amaguk_gca
 * 2013/11/19 09:37:05
 */
class usuario_controller extends Amaguk_controller {
	
	private $url = "";	
	
	function __construct(){
		$this->controller_title="Usuarios";
		$this->url = "http://".$_SERVER['HTTP_HOST'].MGK_ROOT_DIRECTORY."/";
	}


	/* (non-PHPdoc)
	 * @see amaguk_controller_interface::index_action()
	 */		
	public function index_action() {	
		if ($this->session->no_login())
			return $this->go_login();
		
		$this->message_css="alert-success";		
		$this->message_title="Vamos bien";
		$this->message_text="";
		$this->usuario = $this->session->get_login();
		
		$usuario_dao = new usuario_dao();
		$usuario_databean = new usuario_databean();	
				
		$this->view->saludos = "Controlador generado automaticamente";
		$this->require_session=true;	
		$nuevo_password="";	
		
		if ( $this->getMethod_request() == "POST"){
			$usuario_nuevo = new usuario_databean();
			$usuario_databean->_setValues($_POST);			
			$usuario_nuevo->_setValues($_POST);			
			$usuario_databean->setUsuario_id($this->session->get_login()->getUsuario_id());			
			$usuario_nuevo->setUsuario_id($this->session->get_login()->getUsuario_id());
			$usuario_dao->fetchDataBean($usuario_databean);
			$usuario_dao->fields = array( 'nombre' );
			
			if ( $usuario_nuevo->getUsuario_password()!="" ){
				if ( $usuario_databean->getUsuario_password()== md5($usuario_nuevo->getUsuario_password())){
					if ( $usuario_databean->getUsuario_password_n()== $usuario_nuevo->getUsuario_password_o()){
						$usuario_dao->fields[]="usuario_password";
						$nuevo_password = $usuario_nuevo->getUsuario_password_n();
						$usuario_nuevo->setUsuario_password( md5( $usuario_nuevo->getUsuario_password_n() ) );
						$usuario_nuevo->setUsuario_id( $usuario_databean->getUsuario_id() );
					}else{
						$this->message_css="alert-error";
						$this->message_title="Error!";
						$this->message_text="La confirmación del password es incorrecta";
						return;
					}					
				}else{
					$this->message_css="alert-error";
					$this->message_title="Error!";
					$this->message_text="El PASSWORD actual NO COINCIDE";
					return;					
				}
			}
			$this->message_css="alert-success";
			$this->message_title="Correcto!";
			$this->message_text="Sus datos se actualizaron exitosamente";
						
			$usuario_dao->update($usuario_nuevo);
			if ($nuevo_password != "")
				$this->mail_nuevo_password($usuario_databean, $nuevo_password, true );
			$usuario_dao->fetchDataBean($usuario_nuevo);
			$this->session->set_login( $usuario_nuevo );
		}
		$this->usuario = $this->session->get_login();	
		
	}

	public function lista_action() {
		if ($this->session->no_login())
			return $this->go_login();	
		
		$this->message_css="alert-success";		
		$this->message_title="Vamos bien";
		$this->message_text="";	
				
		$usuario_dao = new usuario_dao();
		$usuario_form = new usuario_form();

		if ( $this->getMethod_request() == "POST"){			
			$usuario_form->bean->_setValues($_POST);
			switch ( $usuario_form->getDb_operacion() ){
				case "delete":
					$usuario_form->bean->setUsuario_id_actualiza($this->session->get_login()->getUsuario_id());
					$usuario_dao->delete( $usuario_form->bean );
				break;
				case "busqueda":
				break;
			}
		}
		
		$this->view->items = $usuario_dao->fetchDataBeans();
	}

	public function form_action(){
		if ($this->session->no_login())
			return $this->go_login();
				
		//$this->layout="developer";
		$usuario_form = new usuario_form();
		$usuario_dao = new usuario_dao();
		
		$usuario_form->message_css="alert-success";		
		$usuario_form->message_title="Vamos bien";
		$usuario_form->message_text="";
		
		if ( $this->getMethod_request() == "POST"){			
			$usuario_form->bean->_setValues($_POST);
			$enviar_correo = $_POST["enviar_correo"];
			switch ( $usuario_form->getDb_operacion() ){
				case "insert":					
					$usuario_databean = $usuario_form->bean;
					if ( $usuario_databean->getUsuario_password() != $usuario_databean->getUsuario_password_o()){
						$this->view->usuario_form = $usuario_form;
						$usuario_form->message_css="alert-error";
						$usuario_form->message_title="Error al agregar";
						$usuario_form->message_text="El password no coincide";						
						return;
					}
					
					$pass = $usuario_databean->getUsuario_password();
					$usuario_databean->setUsuario_password( md5($pass) );
					$usuario_databean->setUsuario_id_inserta($this->session->get_login()->getUsuario_id());
					$usuario_databean->setUsuario_id_actualiza($this->session->get_login()->getUsuario_id());
					$usuario_databean->setFecha_inserta(date('Y-m-d H:i:s'));
					$usuario_databean->setFecha_actualiza($usuario_databean->getFecha_inserta());
					$usuario_dao->insert( $usuario_databean );
					if ( $usuario_databean->getUsuario_id() >0 ){
						$usuario_form->setDb_operacion("update");
						$usuario_form->message_css="alert-success";		
						$usuario_form->message_title="Agregar";
						$usuario_form->message_text="Registro exitoso.";
						if( $enviar_correo == 1 ){
							$this->mail_nuevo( $usuario_databean, $pass );
							$usuario_form->message_text= $usuario_form->message_text." Correo enviado!";
						}
					}else{
						$usuario_form->setDb_operacion("update");
						$usuario_form->message_css="alert-danger";		
						$usuario_form->message_title="Agregar";
						$usuario_form->message_text="No se pudo agregar el registro";							
						}
				break;
				case "update":
					$usuario_form->bean->setUsuario_id_actualiza($this->session->get_login()->getUsuario_id());
					$usuario_form->bean->setFecha_actualiza(date('Y-m-d H:i:s'));
					$usuario_dao->update( $usuario_form->bean );
					$usuario_form->setDb_operacion("update");
					$usuario_form->message_css="alert-success";		
					$usuario_form->message_title="Actualizar";
					$usuario_form->message_text="Registro actualizado";						
				break;
				case "edit":
					$usuario_dao->fetchDataBean( $usuario_form->bean );
					$usuario_form->setDb_operacion("update");
				break;				
			}
		}else {
			$usuario_form->setDb_operacion("insert");
		}
		$this->view->usuario_form = $usuario_form;
	}

	public function acceso_action() {
		$usuario_dao = new usuario_dao();
		$usuario_form = new usuario_form();
		$this->action_title="Control de acceso";
		
		require_once 'application/mgk_historiaacceso_mod/model/mgk_historiaacceso_dao.php';
		$historia_dao = new mgk_historiaacceso_dao();
		$historia_databean= new mgk_historiaacceso_databean();
		
		$items = $this->getItemsPath_info();
		
		if(isset($items[3]))
			$usuario_form->bean->setUsuario_email($items[3]);
		
		if ( $this->getMethod_request() == "POST"){
			$usuario_form->bean->_setValues($_POST);
						

			$usuario_dao->fetchDataBeanByLogin($usuario_form->bean);
			
			if ($usuario_form->bean->getUsuario_id() >0){
				$historia_databean->setUsuario_id($usuario_form->bean->getUsuario_id());
				$historia_databean->setDireccion_id( $this->getRemote_addr() );
				$historia_databean->setFecha_inicio(date('Y-m-d H:i:s'));
				$historia_databean->setLatitud($usuario_form->bean->getLatitud());
				$historia_databean->setLongitud($usuario_form->bean->getLongitud());
				$historia_dao->insert($historia_databean);
				$usuario_form->bean->setHistoria_id( $historia_databean->getHistoria_id());
				$this->session->set_login (  $usuario_form->bean , true );
			}
			else
				$usuario_form->bean->setUsuario_email("");
		}
		
		$this->usuario_databean = $usuario_form->bean;
	}	
	
	public function salir_action() {
		if ($this->session->no_login())
			return $this->go_login();		
		$this->layout="clear";
		
		require_once 'application/mgk_historiaacceso_mod/model/mgk_historiaacceso_dao.php';
		$historia_dao = new mgk_historiaacceso_dao();
		$historia_databean= new mgk_historiaacceso_databean();
		
		$historia_databean->setHistoria_id($this->session->get_login()->getHistoria_id());
		$historia_dao->fetchDataBean($historia_databean);
		$historia_databean->setFecha_salida(date('Y-m-d H:i:s'));	
		$historia_dao->update($historia_databean);
		
		$this->session->delete_login();
	}
	
	public function recuperar_acceso_action(){
		$usuario_databean = new usuario_databean();
		$this->message_text="";
		$this->message_css="";
		$this->message_title="";
		$this->myProperties->email ="";
		if ( $this->getMethod_request() == "POST"){
			$usuario_databean->_setValues($_POST);
			$usuario_databean->setUsuario_email(trim($usuario_databean->getUsuario_email()));
			$this->myProperties->email = $usuario_databean->getUsuario_email();
			$usuario_dao = new usuario_dao();
			$usuario_dao->fetchDataBeanByUser($usuario_databean);
				
			if ( $usuario_databean->getUsuario_id() > 0 ){
					
				if ( $usuario_databean->getToken() == "0" ){
					$token = base64_encode($usuario_databean->getUsuario_id().'-'.date('His'));
					$usuario_databean->setToken( $token );
					$usuario_dao->update( $usuario_databean );
				}else 
					$token = $usuario_databean->getToken( );
	
				$this->mail_recuperar($usuario_databean);
				$this->message_text="Por favor resiva tu correo: <strong>".$this->myProperties->email."</strong>";
				$this->message_title="Correo enviado.";
				$this->message_css="alert-success";
				$this->myProperties->email ="";
			}else{
				$this->message_title="Error";
				$this->message_text="Correo <strong>".$this->myProperties->email." </strong> no encontrado";
				$this->message_css="alert-danger";
			}
	
		}
	
	}
	
	public function nuevo_password_action(){
		$nuevo = md5(date("timestamp").date("timestamp"));
		$nuevo = substr($nuevo,0,10);
	
		$usuario_databean = new usuario_databean();
		$usuario_dao = new usuario_dao();
	
		$items= $this->getItemsPath_info();
		$usuario_databean->setToken( $items[3] );
		$usuario_dao->fetchDataBeanByToken($usuario_databean);
	
		if ( $usuario_databean->getUsuario_id() > 0  ){
			$usuario_databean->setUsuario_password( md5($nuevo) );
			$this->mail_nuevo_password($usuario_databean, $nuevo , false );
			
			$usuario_databean->setToken( "0" );
			$usuario_dao->update( $usuario_databean );
				
			$this->message_text="Se ha enviado nuevo password a su correo";
			$this->message_css="alert-success";
			$this->message_title="Nuevo password";
		}else{
			$this->message_text="El enlace ha caducado, por favor haga una ";
			$this->message_text.="<a href='".$this->url."/index.php/usuario/recuperar_acceso/'>";
			$this->message_text.="nueva solicitud </a> de password";
			$this->message_css="alert-danger";
			$this->message_title="Error";
		}
	}
	
	public function mail_nuevo_password(usuario_databean $usuario_databean, $nuevo , $b = false ){
		$email = new Amaguk_mail();
		$email->mgkProproperties = $this->mgkProperties;
		
		$to = $usuario_databean->getUsuario_email();
		$from = $this->mgkProperties->getValue("mail_from");
		$subject = "Nuevo password";
		
		$liga = $this->url."index.php/usuario/acceso/$to";
				
		if ( $b == false )
			$message = "Se ha generado un nuevo password: $nuevo <br>";
		else
			$message = "Se ha actualizado su password: $nuevo <br>";
		$message .= "<a target='_blank' href='$liga'>$liga</a>";
		$message="<div style='background-color#FBFBFB'>$message</div>";		
		$email->send_mail_smtp($to, $subject, $message, $from);
	}

	
	public function mail_recuperar(usuario_databean $usuario_databean){
		$email = new Amaguk_mail();
		$email->mgkProproperties = $this->mgkProperties;
	
		$liga = $this->url."index.php/usuario/nuevo_password/".$usuario_databean->getToken();
		
		$to = $usuario_databean->getUsuario_email();
		$from = $this->mgkProperties->getValue("mail_from");
		$subject = "Recuperar password";
		$message = "Se ha solicitado un nuevo password <br>
		Para confirmar visite la siguiente direcci&oacuten <a target='_blank' href='$liga'> $liga </a>";
		$message="<div style='background-color#FBFBFB'>$message</div>";
		$email->send_mail_smtp($to, $subject, $message, $from);
	}
	
	public function mail_nuevo(usuario_databean $usuario_databean, $pass){
		$email = new Amaguk_mail();
		$email->mgkProproperties = $this->mgkProperties;
  
		$to = $usuario_databean->getUsuario_email();
		$liga = $this->url."index.php/usuario/acceso/$to";		
		
		$from = $this->mgkProperties->getValue("mail_from");
		$subject = "Nuevo usuario";
		$message = "Usted esta registrado como nuevo usuario en el sistema,sus datos de acceso son:<br>
		Usuario: ".$usuario_databean->getUsuario_email()." <br>
		Password: ".$pass."<br>
		La dirección de acceso es la siguiente<br>
		<a target='_blank' href='$liga'>$liga</a> <br>
		Si no puede entrar al hacer click sobre el enlace por favor copie y pegue en su navegador de intenet<br><br>		
		Para soporte técnico favor de escribir un correo a: $from";	
		
		
		$email->send_mail_smtp($to, $subject, $message, $from);
	}
	
	public function ubicacion_action(){
		require_once 'application/mgk_historiaacceso_mod/model/mgk_historiaacceso_dao.php';
		$historia_dao = new mgk_historiaacceso_dao();
		$historia_databean= new mgk_historiaacceso_databean();
				
		$this->usuario = $this->session->get_login();
		$historia_databean->setUsuario_id( $this->usuario->getUsuario_id() );
		$this->items = $historia_dao->fetchDataBeansByUsuarioId($historia_databean,10);
	}
}
?>