<?php

require_once 'lib/amaguk/gca/Amaguk_gca_dao.php';
require_once 'lib/amaguk/gca/Amaguk_gca_form.php';
require_once 'lib/amaguk/gca/Amaguk_gca_controller.php';
require_once 'lib/amaguk/gca/IAmaguk_gca.php';
require_once 'lib/amaguk/utils/Amaguk_database_access.php';

/**
 * 
 * Generador de codigo automatico
 * @author http://amagukmx.wordpress.com/
 *
 */
class Amaguk_gca_php implements IAmaguk_gca {
	
	const AMAGUK_GCA_VERSION='0.3.0';
	

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
	 * @var amaguk_pg_connection
	 */
	private $conn;
	
	private $directory;
	
	public function get_amaguk_gca_version(){
		return 1;
	}
	
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
		$this->makeFilePath( $this->alias_table_name );		
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
		
		if ($tiene_base_datos) {
			
		}
		//- - unicamente cuando es con acceso a base de datos 
		$this->conn = new Amaguk_database_access();

		$this->fields = array();
		$this->tiene_base_datos = $tiene_base_datos ;
		// - -
		$this->file_paths = array();
		//$this->directory = "../".MGK_APPLICATION_DIRECTORY."/";
		$this->directory = "./".MGK_APPLICATION_DIRECTORY."/";
		
		
		if ( isset ( $_SESSION["mgk_proyecto"] ) )
			$this->directory = "../".$_SESSION["mgk_proyecto"]."/".MGK_APPLICATION_DIRECTORY."/";
		
		
		//$directory = "/Applications/XAMPP/xamppfiles/htdocs/porconocer/application/";
		
		$this->file_paths["controller"] = $this->directory.'controller';
		$this->file_paths["dao"] = $this->directory.'model/dao';
		$this->file_paths["databean"] = $this->directory.'model/db';
		$this->file_paths["view"] = $this->directory.'views';
		$this->file_paths["form"] = $this->directory.'forms';
	}
	
	public function makeFilePath($alias_name){
		$alias_name="".$alias_name."_mod/";
		$this->file_paths["controller"] = $this->directory.$alias_name.'controller';
		$this->file_paths["dao"] = $this->directory.$alias_name.'model';
		$this->file_paths["databean"] = $this->directory.$alias_name.'model';
		$this->file_paths["view"] = $this->directory.$alias_name.'views';
		$this->file_paths["form"] = $this->directory.$alias_name.'forms';
		
		$this->file_paths["_directory"] = $this->directory.$alias_name;

		if ( !file_exists( $this->file_paths["_directory"] ) ){ 
			mkdir( $this->file_paths["_directory"] );
		}
	}
	
	
	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::fetch_fields()
	 */
	public function fetch_fields($table_name) {
		$this->table_name = $table_name;
		// TODO Auto-generated method stub
		$query="select * from $table_name limit 1";
		
	//select * from INFORMATION_SCHEMA.COLUMNS where table_name = 'demo'; //posgtres
		
		$this->conn->connect();
		$this->conn->query($query);

		$this->num_fields = $this->conn->num_fields();
		
		for ( $i=0 ; $i < $this->num_fields ; $i++){
			$this->fields[ $i ]["name"] = $this->conn->field_name( $i );
			$this->fields[ $i ]["type"] = $this->conn->field_type( $i );
			$this->fields[ $i ]["length"]  = $this->conn->field_length( $i );
			$this->fields[ $i ]["is_null"]  = $this->conn->field_is_null( $i );			
			}
	}

	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::write_file()
	 */
	public function write_file($path, $name,$content) {
		// TODO Auto-generated method stub
		$fp = fopen($path."/".$name,"w+");		
		if($fp){
			fwrite($fp, $content);
			fclose($fp);
			return true;
		}
		return false;
	}
	
	public function delete_file($path, $name) {
		unlink($path."/".$name);
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
		$code = "lista.php";
		return $code;		
	}	

	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::get_databean_name()
	 */
	public function get_databean_name($table_name) {
		// TODO Auto-generated method stub
		$code = "$table_name"."_databean";
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
		// TODO Auto-generated method stub
		/*$code ="<div id=\"nav_bar\">
	<a href=\"<?php print MGK_HOME?>/index.php/$this->alias_table_name/lista\">Lista</a> |
	<a href=\"<?php print MGK_HOME?>/index.php/$this->alias_table_name/form\">Nuevo</a>
</div>";*/
		$code =
"
<ul class=\"nav nav-tabs\">
  <li class=\"active\"><a href=\"<?php print MGK_HOME?>/index.php/$this->alias_table_name/\">Inicio</a></li>
  <li><a href=\"<?php print MGK_HOME?>/index.php/$this->alias_table_name/lista\">Listado</a></li>
  <li><a href=\"<?php print MGK_HOME?>/index.php/$this->alias_table_name/form\">Captura</a></li>
</ul>
<br/>
<?php if (\$this->message_text!=\"\"):?>
    <div class=\"alert <?php print \$this->message_css;?>\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    <strong><?php print \$this->message_title;?> </strong> <?php print \$this->message_text;?>.
    </div>
<?php endif;?>
<!-- AMAGUK_GCA_VERSION: ".Amaguk_gca_php::AMAGUK_GCA_VERSION." -->";
		return  $this->write_file($this->file_paths["view"], "index.php", $code );
	}

	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::create_edit_view()
	 */
	public function create_edit_view( $table_name = "" ) {
		// TODO Auto-generated method stub
		$code ="<?php \$this->$table_name"."_form->printForm(); ?>";
		return  $this->write_file($this->file_paths["view"], "form.php", $code );
	}
	
	public function delete_dao( $table_name = "" ) {
		$name = $this->get_dao_name( $this->alias_table_name );
		$this->delete_file($this->file_paths["dao"], $name.".php");
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
		$txt_code = $this->get_txt_doc("Data Access Object for $table_name");
		$dao_name = $this->get_dao_name( $this->alias_table_name );
		$databean_name = $this->get_databean_name( $this->alias_table_name );
		$gca_dao = new amaguk_gca_dao();
		$fields = array();
		
		foreach ( $this->fields as $field )
			$fields[] = $field["name"];
		$code = 
"<?php
	require_once 'application/".$this->alias_table_name."_mod/model/".$databean_name.".php';

$txt_code
class $this->alias_table_name"."_dao extends Amaguk_dao {

	const TABLE_NAME='$this->table_name';
";

//- - - -  methods
		$code .= "\n\n/// - - - -  methods <-- Auto-generated <-- \n";
		$code .= $gca_dao->genera_construct( $table_name );
		$code .= $gca_dao->genera_insertar( $fields , $table_name, $databean_name);
		$code .= $gca_dao->genera_actualizar( $fields , $table_name, $databean_name);
		$code .= $gca_dao->genera_eliminar( $fields , $table_name, $databean_name);		
		$code .= $gca_dao->genera_lista( $fields , $table_name, $databean_name);
		$code .= $gca_dao->genera_consulta( $fields , $table_name, $databean_name);
		$code .="	/// --> Auto-generated -->\n";
		$code .= "\n}\n?>";
		
		if (!file_exists( $this->file_paths["dao"] ))
			mkdir( $this->file_paths["dao"] );
			
		return $this->write_file($this->file_paths["dao"], $dao_name.".php", $code);		
		
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
 * AMAGUK_GCA_VERSION: ".Amaguk_gca_php::AMAGUK_GCA_VERSION." 
 * @author http://amagukmx.wordpress.com/
 * $date
 */
class $controller_name extends amaguk_controller {

";
		
		$code .= $gca_controller->create_index_action();
		$code .= "\n}\n?>";

		if ( !file_exists($this->file_paths["view"]."/".$this->alias_table_name) )
			mkdir($this->file_paths["view"]."/".$this->alias_table_name);
		$this->create_index_view($this->alias_table_name);		
		
		return $this->write_file($this->file_paths["controller"], $controller_name.".php", $code);		
	}

	public function delete_controller( $table_name = "" ) {
		$name = $this->get_controller_name( $this->alias_table_name );
		$this->delete_file($this->file_paths["controller"], $name.".php");
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
		
		$controller_name = $this->get_controller_name( $this->alias_table_name );
		$dao_name = $this->get_dao_name( $this->alias_table_name );
		$databean_name = $this->get_databean_name( $this->alias_table_name );
		$form_name = $this->get_form_name( $this->alias_table_name );
		$date = date("Y/m/d H:i:s");
		
		$gca_controller = new amaguk_gca_controller();
		$code = "<?php
	require_once 'application/".$this->alias_table_name."_mod/model/$dao_name.php';
	require_once 'application/".$this->alias_table_name."_mod/model/$databean_name.php';
	require_once 'application/$this->alias_table_name"."_mod/forms/$form_name.php';
	
/**
 * 
 * AMAGUK_GCA_VERSION: ".Amaguk_gca_php::AMAGUK_GCA_VERSION." 
 * @author http://amagukmx.wordpress.com/
 * $date
 */
class $controller_name extends Amaguk_controller {

	function __construct(){
		\$this->controller_title=\"".$this->alias_table_name."\";
	}

";
		$code .= $gca_controller->create_index_action();
		$code .= $gca_controller->create_lista_action( $dao_name , $databean_name , $form_name);
		$code .= $gca_controller->create_form_action( $this->fields, $dao_name , $databean_name , $form_name);
		$code .= $gca_controller->create_select( $this->fields, $dao_name );
		
		
		$code .= "\n}\n?>";

/*
		if ( !file_exists($this->file_paths["view"]."/".$this->alias_table_name) )
			mkdir($this->file_paths["view"]."/".$this->alias_table_name);
			*/
		if ( !file_exists($this->file_paths["view"]) ) 
			mkdir($this->file_paths["view"]);
					
		$this->create_index_view($this->alias_table_name);

		if ( !file_exists($this->file_paths["controller"]) ) 
			mkdir($this->file_paths["controller"]);		
		
		return $this->write_file($this->file_paths["controller"], $controller_name.".php", $code);		
	}
	
	public function delete_databean( $table_name = "" ) {
		$databean_name = $this->get_databean_name( $this->alias_table_name );
		$this->delete_file($this->file_paths["databean"], $databean_name.".php");
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
		$txt_code = $this->get_txt_doc("Data Bean for $table_name");
		$databean_name = $this->get_databean_name( $this->alias_table_name );
		$code = 
"<?php\n
$txt_code
class $this->alias_table_name"."_databean  extends  Amaguk_databean  {";
		$code .= "\n//- - - - properties\n";
		$code .= $this->create_class_properties( $this->fields );
		$code .= "\n\n//- - - -  GET Methods <-- Auto-generated <-- \n";
		$code .= $this->create_get_methods( $this->fields);
		$code .= "\n\n//- - - -  --> Auto-generated --> \n";
		$code .= "\n\n//- - - -  SET Methods <-- Auto-generated <-- \n";
		$code .= $this->create_set_methods( $this->fields);
		$code .= "\n\n//- - - -  --> Auto-generated --> \n";
		$code .=
"\n}\n?>";
		
		if ( !file_exists( $this->file_paths["databean"] ))
			mkdir( $this->file_paths["databean"] );
		
		return $this->write_file($this->file_paths["databean"], $databean_name.".php", $code);		
	}
	
	public function fetch_tables(){
		$tables = array();
		if ( $this->conn->getDriver() == Amaguk_database_connection::DB_DRIVER_POSTGRESL )
			$query ="SELECT table_name FROM information_schema.tables WHERE table_schema='public'";
		else 
			$query = "show tables";
		$this->conn->connect();
		$this->conn->query($query);
		while ( $this->conn->fetch_row() )
			$tables[] = $this->conn->data;
		return $tables;		
	}
	
	public function fetch_databases(){
		
	}
/* (non-PHPdoc)
	 * @see amaguk_gca_interface::create_class_properties()
	 */
	private function create_class_properties($field_name) {
		// TODO Auto-generated method stub
		
		$code = "";
		foreach ( $field_name as $field ){
			$name = $field["name"];
			$type = $field["type"];
			$code .=
"
	/**
	 * Enter description here ...
	 * @var unknown_type
	 */
	protected \$$name;
";
		}
		return $code;
	}
	
	private function get_txt_doc($txt){
		$date = date ('Y/m/d H:i:s');
		$code = 
"
/**
 * $txt
 * AMAGUK_GCA_VERSION: ".Amaguk_gca_php::AMAGUK_GCA_VERSION."
 * @author http://amagukmx.wordpress.com/
 * $date
 */";
		return $code;	
	}
	
//-- --	
	public function delete_list( $table_name = "" ) {
		$name = $this->get_list_filename( $this->alias_table_name );	
		$this->delete_file($this->file_paths["view"]."/".$this->alias_table_name, $name);
		$this->delete_file($this->file_paths["view"]."/".$this->alias_table_name, "index.php" );
		$this->delete_file($this->file_paths["view"]."/".$this->alias_table_name, "form.php" );
		rmdir($this->file_paths["view"]."/".$this->alias_table_name);
	}

	
	/* (non-PHPdoc)
	 * @see amaguk_gca_interface::create_list_view()
	*/
	public function create_list_view( $table_name = "" ){
		if ( $table_name == "")
			$table_name = $this->table_name;
		if ( $this->alias_table_name == "" )
			$this->alias_table_name = $this->table_name;
			
		$this->fetch_fields($table_name);
		$fields = $this->fields;
		
		$list_name= $this->get_list_filename($table_name);

//		$fields[$this->num_fields++]["name"] = "__edit";
//		$fields[$this->num_fields++]["name"] = "__delete";
		
		$headers = "";
		$content = "";
		
		$headers .= "\t<th style=\"width:60px\"> Editar </th> \n ";
		$item = "\$item->get".ucfirst( $fields[0]["name"] )."();";
		$content .= "\t<td  > <button class='btn btn-default' onclick='".$this->alias_table_name."_editar(\"<?php print $item ?>\")'><span class='glyphicon glyphicon-edit'></span></button> </td> \n";
		
		$headers .= "\t<th style=\"width:60px\"> Eliminar </th> \n ";
		$item = "\$item->get".ucfirst( $fields[0]["name"] )."();";
		$content .= "\t<td> <button class='btn btn-default' onclick='".$this->alias_table_name."_eliminar(\"<?php print $item ?>\")'><span class='glyphicon glyphicon-trash'></span></button> </td> \n";
		
				
		foreach ( $fields as $fieldx ){
			$field = $fieldx["name"];
			
			if ( $field == "__edit" || $field == "__delete" ){  
				if ( $field == "__edit" ){
					$headers .= "\t<th> Editar </th> \n ";
					$item = "\$item->get".ucfirst( $fields[0]["name"] )."();";					
					$content .= "\t<td> <button class='btn btn-default' onclick='".$this->alias_table_name."_editar(\"<?php print $item ?>\")'><span class='glyphicon glyphicon-edit'></span></button> </td> \n";					
				}
				else{
					$headers .= "\t<th> Eliminar </th> \n ";
					$item = "\$item->get".ucfirst( $fields[0]["name"] )."();";
					$content .= "\t<td> <button class='btn btn-default' onclick='".$this->alias_table_name."_eliminar(\"<?php print $item ?>\")'><span class='glyphicon glyphicon-trash'></span></button> </td> \n";
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
	if (!confirm('Esta seguro que desea eliminar el registro?'))
		return;
	document.".$this->alias_table_name."_form_aux.db_operacion.value =\"delete\";
	document.".$this->alias_table_name."_form_aux.".$fields[0]["name"].".value = ide;
	document.".$this->alias_table_name."_form_aux.submit();	
}
</script>\n";

$code.="
<ul class=\"nav nav-tabs\">
  <li class=\"active\"><a href=\"<?php print MGK_HOME?>/index.php/$this->alias_table_name/lista\">Listado</a></li>
  <li><a href=\"<?php print MGK_HOME?>/index.php/$this->alias_table_name/form\">Captura</a></li>
</ul>";		

/*$code .="<div id=\"nav_bar\">
	<a href=\"<?php print MGK_HOME?>/index.php/$this->alias_table_name/lista\">Lista</a> |
	<a href=\"<?php print MGK_HOME?>/index.php/$this->alias_table_name/form\">Nuevo</a>
</div>\n";*/

		$code .='
<table class="table table-striped">
	<thead>
  <tr>'."\n";
		$code.=$headers;
  $code.='</tr>
  		</thead>
  		<tbody>
<?php foreach ( $this->items as $item ) :?>
  <tr>'."\n";
		$code .= $content;
  		$code .= '</tr>
<?php endforeach;?>  
</tbody>  				
</table>';
  				
	$code.="\n<form name=\"".$this->alias_table_name."_form_aux\" action=\"\" method=\"post\">
		<input type=\"hidden\" name=\"db_operacion\" value=\"\"/>
		<input type=\"hidden\" name=\"".$fields[0]["name"]."\" value=\"\"/>
</form>";

  		return $this->write_file($this->file_paths["view"], $list_name, $code);
		}
		
	public function delete_form( $table_name = "" ) {
		$name = $this->get_form_name( $this->alias_table_name );
		$this->delete_file($this->file_paths["form"]."/".$this->alias_table_name, $name.".php");
		$this->delete_file($this->file_paths["form"]."/".$this->alias_table_name, $name.".php");
		rmdir($this->file_paths["form"]."/".$this->alias_table_name);
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
		$gca_form = new Amaguk_gca_form( $this->alias_table_name );
		$code_php = $gca_form->create_form_php($form_name, $db_name);
		$code_phtml = $gca_form->create_form_phtml_bootstrap3($this->fields , $form_name);

		if ( !file_exists($this->file_paths["form"]) )
			mkdir($this->file_paths["form"]);
		$this->create_edit_view($this->alias_table_name);
					
		$this->write_file($this->file_paths["form"], $form_name.".php", $code_php);
		return  $this->write_file($this->file_paths["form"], $form_name.".html.php", $code_phtml);
	}
}
?>