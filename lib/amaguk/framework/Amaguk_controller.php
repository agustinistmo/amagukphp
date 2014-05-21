<?php
require_once('lib/amaguk/framework/IAmaguk_controller.php');
require_once 'lib/amaguk/framework/Amaguk_properties.php';
require_once 'lib/amaguk/utils/Amaguk_functions.php';

/**
 * 
 * Controllador
 * @author agustin corona jimenez http://amagukmx.wordpress.com/
 * @since 2011
 *
 */
abstract class Amaguk_controller implements IAmaguk_controller {
	
	/**
	 * Bandera que indica si es necesaria tener iniciada una sesiï¿½n para continuar
	 * @var boolean
	 */
	public $require_session=false;
	
	
	/**
	 * 
	 * @var estatus_controller
	 */
	public $estatus_controller;
	
	/**
	 * Variable auxiliar para guardar texto que pudiera usarse en la impresion de la vista o cualquier lugar que se necesite
	 * @var String
	 */
	public $_aux_salida_ ="";
	
	/**
	 * Variable donde se guarda la sesiï¿½n principal de acceso
	 * @var Amaguk_session
	 */
	public $session;
	
	/**
	 * Iniciales del idioma utilizado
	 * @var String
	 */
	public $lang;
	
	/**
	 * Objeto que contiene las etiquetas del lengueje
	 * @var Amaguk_lang
	 */
	public $mgkLang;
	
	/**
	 * Bandera auxiliar para indicar si se debe mostrar el elemento breadcrumb en la plantilla activa
	 * @var boolean
	 */
	public $breadcrumb = true ;
	
	public $content_html_id = "" ;	
	
	/// - - -

	/**
	 * Nombre de la plantilla para ser desplegada
	 * @var String
	 */
	public $layout = "index" ;
	
	/**
	 * Ruta completa de la plantilla
	 * @var String
	 */
	public $layout_file_name = "" ;
	
	/**
	 * Bandera que indica si se usa plantilla al ejecutar una acciï¿½n
	 * @var boolean
	 */
	public $layout_on = true ;
	
	/**
	 * Nombre del directorio donde se encuentra la plantilla a ejecutar
	 * @var String
	 */
	public $layout_directory= "/" ;
	
	/**
	 * 
	 * @var Amaguk_functions
	 */
	public $mgkFun;
	
	/// - - -
	
	/**
	 * Nombre de la acciï¿½n solicitada
	 * @var String
	 */
	public $action ;
	/**
	 * Directorio donde se encuentra el archivo de la vista correspondiente a la acciï¿½n
	 * @var String
	 */
	public $action_directory ;
	/**
	 * Ruta completa del archivo correspondiente a la vista de la acciï¿½n
	 * @var String
	 */
	public $action_file_name ;
	/**
	 * Bandera que indica si se incluye el archivo de la vista correspondiente a la acciï¿½n solicitada
	 * @var boolean
	 */
	public $action_on = true ;
	/**
	 * Texto para mostrar como tï¿½tulo cuando se ejecuta la acciï¿½n. (opcional, depende si se incluye en la plantilla)
	 * @var String
	 */
	public $action_title;
	
	
	
	
	/**
	 * Nombre del controlador solicitado
	 * @var String
	 */
	public $controller;
	/**
	 * Texto para mostrar como tï¿½tulo cuando se ejecuta el controlador. (opcional, depende si se incluye en la plantilla) 
	 * @var String
	 */
	public $controller_title;
	
	public $controller_link;
	
	/// - - -
	
	/**
	 * Mensaje principal para mostrar
	 * @var String
	 */
	public $message_text = "" ;	
	/**
	 * Titulo corto del mensaje
	 * @var String
	 */
	public $message_title = "" ;
	/**
	 * Estilo CSS del mensaje
	 * @var String
	 */
	public $message_css = "" ;
	/**
	 * Bandera para indicar si el mensaje tambien aparecera en una ventana de alerta o ventana modal
	 * @var boolean
	 */	
	public $message_show_alert = false ;
	
	
	
	/**
	 * Bandera que indica que el contenido no estï¿½ permitido
	 * @var boolen
	 */
	public $is_forbidden = false ;
	/**
	 * Propiedades del sistema
	 * @var Amaguk_properties
	 */
	public $mgkProperties ;
	
	/**
	 * Propiedades del sistema en base de datos
	 * @var Amaguk_properties
	 */
	public $mgkParameters;
	
	/**
	 * Propiedades locales de la clase, generalmente para cachar variables enviadas por post o get
	 * @var object
	 */	
	public $myProperties ;
	
	
	/**
	 * Bandera para indicar si se imprime el log SQL, El layout requiere el codigo. if ($this->is_print_log_sql) print $_POST["__query__"];
	 * @var boolean
	 */
	public $is_print_log_sql = false;
	
	
	public function getController_title(){
		return ( $this->controller_title == "" ) ? $this->controller : $this->controller_title;
	}
	
	public function getAction_title(){
		return ( $this->action_title == "" ) ? $this->action : $this->action_title;
	}
	
	public function getController_link(){
		return ( $this->controller_link == "" ) ? $this->controller : $this->controller_link;
	}		
	
	public function __construct(){
		$this->mgkFun = new Amaguk_functions();
	}
	
	public function show(){
		$this->likns();
				
		if (!$this->layout_on){
			$this->content();
			return;
		}
				
		$layout_file_name = $this->layout_directory.$this->layout.".php";
		if ($this->layout_file_name == "" )
			$this->layout_file_name = $layout_file_name;

		if ($this->require_session)
			if(!$this->session->is_login())
				$this->go_login();
		
		if ( $this->is_forbidden )
			$this->go_forbidden();
		
		if( file_exists($this->layout_file_name))
			require_once $this->layout_file_name;
		else
			print "Amaguk PHP Framework :: amaguk_controller :: Error 003 : Layout not found. $this->layout_file_name";
	}
	public function likns(){
		if ( $this->controller_link == "" )
			$this->controller_link = MGK_HOME."/index.php/".$this->controller; 
			
	}
	
	public function content(){
		if (!$this->action_on)
			return;
		
		if ( $this->content_html_id == "" )
			$this->content_html_id = $this->controller;
			 
		
		$action_file_name = $this->action_directory.$this->action.".php";
		if ($this->action_file_name == "")
			$this->action_file_name = $action_file_name;

		if( file_exists($this->action_file_name))
			require_once $this->action_file_name;
		else
			print "Amaguk PHP Framework :: amaguk_controller :: Error 002 : Archivo no encontrado:: $this->action_file_name";
				
		if ( MGK_SHOW_INFO && strlen( $this->message_info ) > 0 )
			print "<hr/>".get_class($this)."::".$this->message_info."<br>\n";
	}

	public function forbidden(){
		$this->is_forbidden = true;
	}
	
	public function go_login(){
		$this->layout_file_name = $this->layout_directory."_forbidden.login.php";
	}	
	public function go_forbidden(){
		$this->layout_file_name = $this->layout_directory."_forbidden.php";
		$this->action_on = false;
	}
	
	public function replace_layout($directory,$template){
		$directory="templates/$directory";
				
		$template_html = $directory."/html/".$template.".html";
		$template_replace = $directory."/html/".$template.".replace.php";		
		$template_php = $directory."/php/".$template.".php";
		$template_tmp = $directory."/php/".$template.".tmp";		
		
		if (file_exists($template_tmp)) {
			$fecha_leida = file_get_contents($template_tmp);			
	    	$fecha_archivo = date ("Y-m-d H:i:s", filemtime($template_html));			
			if ( $fecha_leida != $fecha_archivo) 
				$this->hacer_plantilla($template_html,$template_replace,$template_php,$template_tmp);
		}
		else {
			$this->hacer_plantilla($template_html,$template_replace,$template_php,$template_tmp);
		}
		require_once $template_php;
	}
	
	public function hacer_plantilla($template_html,$template_replace,$template_php,$template_tmp){
			$contenido_html = file_get_contents($template_html);
			require_once ($template_replace);
			$contenido_html = str_ireplace($search, $replace, $contenido_html);
			$fh = fopen($template_php, 'w+') or die("can't open file");
			fwrite($fh, $contenido_html );
			fclose($fh);
			$fecha_archivo = date ("Y-m-d H:i:s", filemtime($template_html));
			$fh = fopen($template_tmp, 'w') or die("can't open file");
			fwrite($fh, $fecha_archivo );
			fclose($fh);		
	}
	
	public function component($name){
		$file = MGK_APPLICATION_REAL_PATH."/com_".$name."/index.php";
		include( $file );
	}		

	/**
	 * @return the REQUEST_METHOD
	 */
	public function getMethod_request() {
		return $_SERVER["REQUEST_METHOD"];
	}
	
	public function getPath_info() {
		return $_SERVER["PATH_INFO"];
	}
	
	public function getItemsPath_info() {
		return explode("/",$_SERVER["PATH_INFO"]);
	}

	/**
	 * Retorna IP remota del cliente
	 * @return String
	 */
	public function getRemote_addr() {
		return $_SERVER["REMOTE_ADDR"];
	}
	
	public function info($message){
//		if (self::INFO_SHOW)
//			print get_class($this)."::".$message."<br>\n";
		$this->message_info .= get_class($this)."::".$message."<br>\n";
	}
	
	public function render($file){
		include $file;
	}
	
	/**
	 * Activa la bandera 'layout_on' para utilizar un layout 
	 */
	public function layoutShow(){
		$this->layout_on = true;
	}
	
	/**
	 * Apaga la bandera 'layout_on' para no utilizar un layout
	 */
	public function layoutHide(){
		$this->layout_on = false;
	}
	
	/**
	 * Activa la bandera 'action_on' para utilizar vista de la accion
	 */
	public function actionShow(){
		$this->action_on = true;
	}
	
	/**
	 * Apaga la bandera 'action_on' para no utilizar archivo de vista de la accion
	 */
	public function actionHide(){
		$this->action_on = false;
	}
	
	public function get_class_name(){
		return get_class( $this );
	}
	
	
}
?>