<?php

require_once 'lib/amaguk/gca/implementation/amaguk_gca_tiap_dao.php';
//require_once 'lib/amaguk/gca/implementation/amaguk_gca_form.php';
//require_once 'lib/amaguk/gca/implementation/amaguk_gca_controller.php';
require_once 'lib/amaguk/gca/interfaces/amaguk_gca_interface.php';
require_once 'lib/amaguk/comun/database_connection.php';

require_once 'lib/amaguk/utils/amaguk_functions.php';

/**
 * 
 * Generador de codigo automatico
 * @author http://amagukmx.wordpress.com/
 *
 */
class amaguk_gca_tiap implements IAmaguk_gca {
	

	/**
	 * nombre de la tabla
	 * @var String
	 */
	private $table_name;
	
	private $alias_table_name="";
	
	/**
	 * Base de datos de donde se generara el codigo automatico
	 * @var string
	 */
	private $database;
	
	/**
	 * 
	 * Contiene el nombre de los campos de una tabla
	 * @var array
	 */
	private $fields;
	
	/**
	 * Numero de columnas de la tabla
	 * @var int
	 */
	private $num_fields;
	
	/**
	 * Si la bandera es true, tambien se genera codigo para acceso a datos,
	 * por defecto el valor es false
	 * @var boolean
	 */
	private $tiene_base_datos;
	
	/**
	 * Rutas de los archivos
	 * @var array
	 */
	private $file_paths;
	
	/**
	 * 
	 * Enter description here ...
	 * @var amaguk_mysql_connection
	 */
	private $conexion_db;
	
	
	private $author;
	
	/**
	 * @return the $table_name
	 */
	public function getTable_name() {
		return $this->table_name;
	}

	/**
	 * @return the $alias_table_name
	 */
	public function getAlias_table_name() {
		return $this->alias_table_name;
	}

	/**
	 * @param String $table_name
	 */
	public function setTable_name($table_name) {
		$this->table_name = trim ($table_name);
	}

	/**
	 * @param field_type $alias_table_name
	 */
	public function setAlias_table_name($alias_table_name) {
		$this->alias_table_name = trim ($alias_table_name);
	}

	/**
	 * @return the $database
	 */
	public function getDatabase() {
		return $this->database;
	}

	/**
	 * @param string $database
	 */
	public function setDatabase($database) {
		$this->database = $database;
	}

	public function __construct($tiene_base_datos = false){
		
		$this->alias_table_name="";
		$this->author = "amaguk.engupisoft.com";
		
		if ($tiene_base_datos) {
			
		}
		//- - unicamente cuando es con acceso a base de datos
		$dbc = new database_connection();
		$this->conn = $dbc->conn;
		$this->conexion_db = $this->conn;

		$this->fields = array();
		$this->tiene_base_datos = $tiene_base_datos ;
		// - -
		$this->file_paths = array();
		$directory = "../resources/application/";
		//$directory = "";
		
		$this->file_paths["controller"] = 'controller/';
		$this->file_paths["dao"] = 'model/';
		$this->file_paths["databean"] = 'model/';
		$this->file_paths["view"] = 'ui/';
		$this->file_paths["form"] = 'form/';
		$this->file_paths["application"] = 'application/';
		$this->file_paths["resources"] = 'resources/';
		
		$this->file_paths["root"] = $directory;
		
		$this->fun = new amaguk_functions();
	}
	
	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::fetch_fields()
	 */
	public function fetch_fields($table_name) {
		$this->table_name = $table_name;
		// TODO Auto-generated method stub
		$query="select * from $table_name limit 0,1";
		$this->conexion_db->connect();
		$this->conexion_db->query($query);		

		$this->num_fields = $this->conexion_db->num_fields();
		
		for ( $i=0 ; $i < $this->num_fields ; $i++){
			$this->fields[ $i ]["name"] = $this->conexion_db->field_name( $i );
			$this->fields[ $i ]["type"] = $this->conexion_db->field_type( $i );
			$this->fields[ $i ]["length"]  = $this->conexion_db->field_length( $i );
			$this->fields[ $i ]["flags"]  = $this->conexion_db->field_flags( $i );
			}
			
		//print_r ( $this->fields[ $i ]["name"]  );
	}

	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::write_file()
	 */
	public function write_file($path, $name,$content) {
		// TODO Auto-generated method stub
		$fp = fopen($path."/".$name,"w+");		
		
		echo "file:: ".$path." --.-- ".$name."<br>";
		
		if($fp){
			fwrite($fp, $content);
			fclose($fp);
			return true;
		}
		return false;
	}

	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::create_get_method()
	 */
	public function create_get_method($field_name) {
		// TODO Auto-generated method stub
		$method_name = ucfirst($field_name);
		$code=
"	
	/**
	 * @return the \$$field_name
	 */
	public function get$method_name() {
		return \$this->$field_name;
	}
";
	return $code;
	}

	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::create_set_method()
	 */
	public function create_set_method($field_name) {
		// TODO Auto-generated method stub
		$method_name = ucfirst($field_name);
		$code=
"	
	/**
	 * @param field_type \$$field_name
	 */
	public function set$method_name(\$$field_name) {
		\$this->$field_name = \$$field_name;
	}
";
	return $code;
	}

	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::create_get_methods()
	 */
	public function create_get_methods($fields) {
		// TODO Auto-generated method stub
		$code = "";
		foreach ( $this->fields as $field )
			$code .= $this->create_get_method($field["name"]);
		return $code;
	}

	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::create_set_methods()
	 */
	public function create_set_methods($fields) {
		// TODO Auto-generated method stub
		$code = ""; 
		foreach ( $this->fields as $field )
			$code .= $this->create_set_method($field["name"]);
		return $code;
	}

	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::get_dao_name()
	 */
	public function get_dao_name($table_name) {
		// TODO Auto-generated method stub
		$code = "$table_name"."_dao";
		return $code;		
	}
	
	
	public function get_form_name($table_name) {
		// TODO Auto-generated method stub
		$code = "$table_name"."_form";
		return $code;		
	}	
	
	
	public function get_list_filename($table_name) {
		// TODO Auto-generated method stub
		$code = "lista.phtml";
		return $code;		
	}	

	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::get_databean_name()
	 */
	public function get_databean_name($table_name) {
		// TODO Auto-generated method stub
		$code = "$table_name"."Db";
		return $code;
	}
	
	public function get_ui_name($table_name) {
		// TODO Auto-generated method stub
		$code = "$table_name"."UI";
		return $code;
	}	
	
	public function get_databean_class_name($table_name) {
		// TODO Auto-generated method stub
		$code = "$table_name"."_db";
		return $code;
	}	

	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::get_controller_name()
	 */
	public function get_controller_name($table_name) {
		// TODO Auto-generated method stub
		$code = "$table_name"."_controller";
		return $code;		
	}

	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::create_index_view()
	 */
	public function create_index_view( $table_name = "" ) {
		if ( $table_name == "")
			$table_name = $this->table_name;
		if ( $this->alias_table_name == "" )
			$this->alias_table_name = $this->table_name;
		
		$this->fetch_fields($table_name);
		
		$controller_name = $this->get_controller_name( $this->alias_table_name );
		$dao_name = $this->get_dao_name( $this->alias_table_name );
		$databean_name = $this->get_databean_name( $this->alias_table_name );
		$form_name = $this->get_form_name( $this->alias_table_name );
		$ui_name = $this->get_ui_name( $this->alias_table_name );
		
		$date = date("Y/m/d H:i:s");
		
		$controller_name_ = ucwords ($controller_name);
		$ui_name_ = ucwords ($ui_name);
		$dao_name_ = ucwords ($dao_name);
		$databean_name_ = ucwords ($databean_name);
		
		
		$gca_controller = new amaguk_gca_controller();
		
		$code =
		"
		var	Window = require('lib/engupi/common/winGeneric');
		var $ui_name_ = require('appx/".$this->alias_table_name."/ui/$ui_name_');
		
		// var $dao_name_ = require('appx/".$this->alias_table_name."/model/$dao_name.js';
		// var $databean_name_ = require('appx/".$this->alias_table_name."/model/$databean_name.js';
		
		/**
		*
		*
		* @author $this->author
		* $date
		*/
		
		var $controller_name_ = function( navController ){
		this.navController=navController;
		}
		
		module.exports = $controller_name_;";
		
		$d = $this->fun->dir_if_not_exists_array( array( "../".$this->file_paths["resources"] ,
				$this->file_paths["application"],
				$this->alias_table_name."/",
				$this->file_paths["view"]) );
		
		return $this->write_file($d , $controller_name.".js", $code);		

		return $this->write_file($d, $ui_name_.".js", $code );
	}

	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::create_edit_view()
	 */
	public function create_edit_view( $table_name = "" ) {
		// TODO Auto-generated method stub
		$code ="Formulario:<br>
<?php \$this->view->$table_name"."_form->printForm(); ?>";
		return  $this->write_file($this->file_paths["view"]."/".$table_name, "form.phtml", $code );
	}

	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::create_list_view()
	 */
	public function create_list_view( $table_name = "" ) {
		// TODO Auto-generated method stub
		
	}

	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::create_dao()
	 */
	public function create_dao( $table_name = "" ) {
		// TODO Auto-generated method stub
		
		if ( $table_name == "")
			$table_name = $this->table_name;
		if ( $this->alias_table_name == "" )
			$this->alias_table_name = $this->table_name;
					
		$this->fetch_fields($table_name);
		$gca_dao = new amaguk_gca_tiap_dao();
		
		$txt_code = $this->get_txt_doc("Data Access Object for $table_name");
		
		$controller_name = $this->get_controller_name( $this->alias_table_name );
		$dao_name = $this->get_dao_name( $this->alias_table_name );
		$databean_name = $this->get_databean_name( $this->alias_table_name );
		$form_name = $this->get_form_name( $this->alias_table_name );
		$ui_name = $this->get_ui_name( $this->alias_table_name );
		
		$controller_name_ = ucwords ($controller_name);
		$ui_name_ = ucwords ($ui_name);
		$dao_name_ = ucwords ($dao_name);
		$databean_name_ = ucwords ($databean_name);
				
		
		$gca_dao->databean_class_name = $this->get_databean_class_name( $this->alias_table_name );
		
		$fields = array();
		foreach ( $this->fields as $field )
			$fields[] = $field["name"];
		$code = 
"Ti.include( Titanium.Filesystem.resourcesDirectory + 'com/ngupisoft/model/DataBean.js' );
Ti.include( Titanium.Filesystem.resourcesDirectory + 'com/ngupisoft/model/Dao.js' );

$txt_code
function $dao_name_"."_dao()  {

	this._table_name= '$table_name';";

		$code .= "\n\n//- - - -  methods\n";
		//$code .= $gca_dao->genera_construct( $table_name );
		$code .= $gca_dao->genera_insertar( $fields , $table_name, $databean_name );
		$code .= $gca_dao->genera_actualizar( $fields , $table_name, $databean_name );
		$code .= $gca_dao->genera_eliminar( $fields , $table_name, $databean_name );		
		$code .= $gca_dao->genera_lista( $fields , $table_name, $databean_name );
		$code .= $gca_dao->genera_consulta( $fields , $table_name, $databean_name );
		$code .= "\n}\n";
		
		$code .= "$dao_name.prototype = new Dao();";

		$d = $this->fun->dir_if_not_exists_array( array( "../".$this->file_paths["resources"] ,
				$this->file_paths["application"],
				$this->alias_table_name."/",
				$this->file_paths["databean"]) );
		
		return $this->write_file($d , $dao_name.".js", $code);
		
		//return $this->write_file($this->file_paths["dao"], $dao_name.".js", $code);		
		
	}
	
	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::create_controller()
	 */
	public function create_controller_u( $table_name = "" ) {
		// TODO Auto-generated method stub
		
		$this->alias_table_name = $table_name;
		
		$controller_name = $this->get_controller_name( $this->alias_table_name );
		$date = date("Y/m/d H:i:s");
		
		$gca_controller = new amaguk_gca_controller();
		$code = "<?php
	
/**
 * 
 * 
 * @author $this->author
 * $date
 */
 
var $controller_name = function(){

	}

exports.module = $controller_name;


";

		if ( !file_exists($this->file_paths["view"]."/".$this->alias_table_name) )
			mkdir($this->file_paths["view"]."/".$this->alias_table_name);
		$this->create_index_view($this->alias_table_name);		
		
		return $this->write_file($this->file_paths["controller"], $controller_name.".php", $code);		
	}	

	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::create_controller()
	 */
	public function create_controller( $table_name = "" ) {
		// TODO Auto-generated method stub
		
		if ( $table_name == "")
			$table_name = $this->table_name;
		if ( $this->alias_table_name == "" )
			$this->alias_table_name = $this->table_name;

		$this->fetch_fields($table_name);
		$date = date("Y/m/d H:i:s");
		$controller_name = $this->get_controller_name( $this->alias_table_name );
		$dao_name = $this->get_dao_name( $this->alias_table_name );
		$databean_name = $this->get_databean_name( $this->alias_table_name );
		$form_name = $this->get_form_name( $this->alias_table_name );
		$ui_name = $this->get_ui_name( $this->alias_table_name );

		$controller_name_ = ucwords ($controller_name);
		$ui_name_ = ucwords ($ui_name);
		$dao_name_ = ucwords ($dao_name);
		$databean_name_ = ucwords ($databean_name);

		
		$gca_controller = new amaguk_gca_controller();
		
		$code = 
"
var	Window = require('lib/engupi/common/winGeneric');
var $ui_name_ = require('appx/".$this->alias_table_name."/ui/$ui_name_');

// var $dao_name_ = require('appx/".$this->alias_table_name."/model/$dao_name.js';
// var $databean_name_ = require('appx/".$this->alias_table_name."/model/$databean_name.js';
	
/**
 * 
 * 
 * @author $this->author
 * $date
 */

var $controller_name_ = function( navController ){
	this.navController=navController;
}

module.exports = $controller_name_;";
		
		$d = $this->fun->dir_if_not_exists_array( array( "../".$this->file_paths["resources"] ,
				$this->file_paths["application"],
				$this->alias_table_name."/",
				$this->file_paths["controller"]) );
		
		return $this->write_file($d , $controller_name_.".js", $code);
	}

	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::create_databean()
	 */
	public function create_databean( $table_name = "" ) {
		// TODO Auto-generated method stub
		
		if ( $table_name == "")
			$table_name = $this->table_name;
		if ( $this->alias_table_name == "" )
			$this->alias_table_name = $this->table_name;
					
		$this->fetch_fields($table_name);
		$txt_code = "Ti.include( Titanium.Filesystem.resourcesDirectory + 'com/ngupisoft/model/DataBean.js' );\n";
		$txt_code .= $this->get_txt_doc("Data Bean for $table_name");
		
		$databean_name = $this->get_databean_class_name( $this->alias_table_name );
		$code ="$txt_code
function $this->alias_table_name"."_db() {";
		$code .= "\n//- - - - properties\n";
		$code .= $this->create_class_properties( $this->fields );
		//$code .= $this->create_clear_properties( $this->fields );
		$code .="\n}\n\n";		
		$code .=$this->alias_table_name."_db.prototype = new DataBean();";

		
		
		$d = $this->fun->dir_if_not_exists_array( array( "../".$this->file_paths["resources"] ,
				$this->file_paths["application"],
				$this->alias_table_name."/",
				$this->file_paths["databean"]) );
		
		return $this->write_file($d , $databean_name.".js", $code);
		// return $this->write_file($this->file_paths["databean"], $databean_name.".js", $code);		
		
	}
	
	public function fetch_tables(){
		$tables = array();
		$query = "show tables";
		$this->conexion_db->connect();
		$this->conexion_db->query($query);
		while ( $this->conexion_db->fetch_row() )
			$tables[] = $this->conexion_db->data;
		
		return $tables;		
	}
	
	public function fetch_databases(){
		
	}
/* (non-PHPdoc)
	 * @see amaguk_gca_interface::create_class_properties()
	 */
	private function create_class_properties($fields_name) {
		// TODO Auto-generated method stub

		$arr = array();
		foreach ( $fields_name as $field )
			$arr[] = $field["name"];
		$_atributos = implode('","', $arr );
		
		$code = '	this._atributos = Array ("'.$_atributos.'");'."\n\n";	

		foreach ( $fields_name as $field ){
			$name = $field["name"];
			$type = $field["type"];
			$code .="	this.$name=\"\";\n";
		}
		return $code;
	}
	
	private function create_clear_properties($field_name) {
		// TODO Auto-generated method stub
		
		$code = "\n\tfunction clear(){\n";
		foreach ( $field_name as $field ){
			$name = $field["name"];
			$type = $field["type"];
			$code .="\t\tthis.$name=\"\";\n";
		}
		$code .= "\t}";
		return $code;
	}	
	
	private function get_txt_doc($txt){
		$date = date ('Y/m/d H:i:s');
		$code = 
"
/**
 * $txt
 * @author amaguk.ngupisoft.com/gca
 * $date
 */";
		return $code;	
	}
	
//-- --	
	public function create_list( $table_name = "" ){
		
		if ( $table_name == "")
			$table_name = $this->table_name;
		if ( $this->alias_table_name == "" )
			$this->alias_table_name = $this->table_name;

			
		$this->fetch_fields($table_name);
		$fields = $this->fields;
		
		$list_name= $this->get_list_filename($table_name);

		$fields[$this->num_fields++]["name"] = "__edit";
		$fields[$this->num_fields++]["name"] = "__delete";
		
		$headers = "";
		$content = "";
		foreach ( $fields as $fieldx ){
			$field = $fieldx["name"];
			
			if ( $field == "__edit" || $field == "__delete" ){  
				if ( $field == "__edit" ){
					$headers .= "\t<th> Editar </th> \n ";
					$item = "\$item->get".ucfirst( $fields[0]["name"] )."();";					
					$content .= "\t<td> <input type='button' value='editar' onclick='".$this->alias_table_name."_editar(\"<?php print $item ?>\")'>  </td> \n";					
				}
				else{
					$headers .= "\t<th> Eliminar </th> \n ";
					$item = "\$item->get".ucfirst( $fields[0]["name"] )."();";
					$content .= "\t<td> <input type='button' value='eliminar' onclick='".$this->alias_table_name."_eliminar(\"<?php print $item ?>\")'>  </td> \n";
				}
			}
			else {
				$headers .= "\t<th> $field </th> \n ";
				$item = "\$item->get".ucfirst($field)."();";
				$content .= "\t<td>  <?php print $item ?> </td> \n";				
			}			
		}
		$code ="<script type=\"text/javascript\">
function $this->alias_table_name"."_editar(ide){
	document.".$this->alias_table_name."_form_aux.action =\"../".$this->alias_table_name."/form\";
	document.".$this->alias_table_name."_form_aux.db_operacion.value =\"edit\";
	document.".$this->alias_table_name."_form_aux.".$fields[0]["name"].".value = ide;
	document.".$this->alias_table_name."_form_aux.submit();
}

function $this->alias_table_name"."_eliminar( ide ){
	document.".$this->alias_table_name."_form_aux.db_operacion.value =\"delete\";
	document.".$this->alias_table_name."_form_aux.".$fields[0]["name"].".value = ide;
	document.".$this->alias_table_name."_form_aux.submit();	
}
</script>
<form name=\"".$this->alias_table_name."_form_aux\" action=\"\" method=\"post\">
	<input type=\"hidden\" name=\"db_operacion\" value=\"\"/>
	<input type=\"hidden\" name=\"".$fields[0]["name"]."\" value=\"\"/>
</form>\n";
		
$code .="<div id=\"nav_bar\">
	<a href=\"<?php print URL_BASE?>index.php/$this->alias_table_name/lista\">Lista</a> |
	<a href=\"<?php print URL_BASE?>index.php/$this->alias_table_name/form\">Nuevo</a>
</div>\n";

		$code .='
<table width="90%" border="0" cellspacing="0" cellpadding="0">
  <tr>'."\n";
		$code.=$headers;
  $code.='</tr>
<?php foreach ( $this->view->items as $item ) :?>
  <tr>'."\n";
		$code .= $content;
  		$code .= '</tr>
<?php endforeach;?>  
</table>';
  		
  		return $this->write_file($this->file_paths["view"]."/".$this->alias_table_name."/", $list_name, $code);
  		
		}
		
	public function create_form( $table_name = "" ){
		
		if ( $table_name == ""){
			$table_name = $this->table_name;
		}
		else
			$this->table_name = $table_name;
		
		if ( $this->alias_table_name == "" )
			$this->alias_table_name = $this->table_name;

			
		$this->fetch_fields($table_name);
		
		$form_name = $this->get_form_name( $this->alias_table_name );
		$db_name = $this->get_databean_name( $this->alias_table_name );
		$gca_form = new amaguk_gca_form( $this->alias_table_name );
		$code_php = $gca_form->create_form_php($form_name, $db_name);
		$code_phtml = $gca_form->create_form_phtml($this->fields , $form_name);

		if ( !file_exists($this->file_paths["form"]."/".$this->alias_table_name) )
			mkdir($this->file_paths["form"]."/".$this->alias_table_name);
			
		$this->create_edit_view($this->alias_table_name);
					
		$this->write_file($this->file_paths["form"]."/".$this->alias_table_name."/", $form_name.".php", $code_php);
		return  $this->write_file($this->file_paths["form"]."/".$this->alias_table_name."/", $form_name.".phtml", $code_phtml);
	}
}
?>