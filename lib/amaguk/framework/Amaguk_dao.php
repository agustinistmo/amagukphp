<?php
require_once('lib/amaguk/framework/IAmaguk_dao.php');
require_once('lib/amaguk/utils/Amaguk_database_access.php');

/**
 * 
 * Data Access Object
 * @author agustin corona jimenez @agustinistmo
 * @version 2014.02.24 agustinistmo. Se agregan metodos para tomar el erro y numero de error 
 * @version 2014.01.23 agustinistmo. Se corrige error que había en metodo _recuperarDataBeanX al recuperar como objeto 
 * @version 2014.01.15
 * lib/amaguk/framework/Amaguk_dao.php
 *
 */
class Amaguk_dao implements IAmaguk_dao {
	
	public $_isAutoIncrement=true;
	
	/**
	 * objeto para manejo de base de datos
	 * @var Amaguk_pdo_mssql_connection
	 */
	public $db;
	
	/**
	 * Cadena de consulta a la base de datos
	 * @var string
	 */
	protected $query;
	/**
	 * Condiciones para la consulta sql
	 * @var string
	 */
	protected $where;
	/**
	 * arreglo de data beans
	 * @var array
	 */
	protected $data_beans;
	/**
	 * nombre de la clase de acceso a datos
	 * @var string
	 */
	protected $dao_calase_name;
	
	/**
	 * nombre de los campos que se usaran en la consulta sql
	 * @var array
	 */
	public $fields;
	
	
	/**
	 * 
	 * @var array
	 */
	public $fields_require;
	
	/**
	 *
	 * @var array
	 */
	public $tmp_fields_require;	
	
	
	/**
	 * nombre de la tabla que se maneja con el dao
	 * @var strinh
	 */
	public $table_name;
	
	
	/**
	 * @return the $where
	 */
	public function getWhere() {
		return $this->where;
	}

	public function getWhereWithout() {
		$pos = strpos(	$this->where,"where");
		if ($pos === false) {
			return $this->where;
		}else{
			return substr( $this->where,$pos+5);
		}
	}	


	/**
	 * @param string $where
	 */
	public function setWhere($where) {
		$this->where = $where;
	}

	/**
	 * @return the $query
	 */
	public function getQuery() {
		return $this->query;
	}

	/**
	 * @param string $query
	 */
	public function setQuery($query) {
		$this->query = $query;
	}

	public function __construct() {
		$this->db = new Amaguk_database_access();
		$this->db->_isAutoIncrement = $this->_isAutoIncrement;
		$this->db->connect();
		$this->fields_require = array();
	}	

	public function _recuperarDataBean( $objeto ){
		$this->db->setIs_query(true);
		$this->db->query( $this->query );
		$this->where="";
		$this->clearCondition();
		
		if  ( $this->db->fetch_assoc() ){
			$objeto->_setValues( $this->db->data);
		}
		else{
			$objeto->_clear();
		}
	}
	
	public function _recuperarDataBeanX( $query = "" ,$assoc=false){
		if ( $query != "" )
			$this->query = $query;
		$this->db->setIs_query(true);
		$this->db->query( $this->query );
		$this->clearCondition();
		
		if ($assoc)
			$data = $this->db->fetch_assoc();
		else
			$data = $this->db->fetch_object();
			
		$this->db->data = $data; 
			
		if  ( $data )
			return $this->db->data;
		else
			return 0;
	}	
	
	public function _recuperarDataBeans( $objeto ){
		$this->db->setIs_query(true);
		$this->dao_calase_name = get_class ( $objeto );
		$this->db->query( $this->query );
		$this->clearCondition();
		$this->data_beans = array();
		for ( $i=0 ; $this->db->fetch_assoc() ; $i++ ){
			$objeto = new $this->dao_calase_name();
			$objeto->_setValues( $this->db->data);
			$this->data_beans[$i] = $objeto;
		}
		$this->where="";
		return $this->data_beans;
	}
	
	public function _recuperarDataBeansX( $query = "" ,$assoc=false){
		$this->db->setIs_query(true);
		if ( $query != "")
			$this->query = $query;
		$this->db->query( $this->query );
		$this->clearCondition();
		$this->data_beans = array();
		for ( $i=0 ; ($assoc)? $this->db->fetch_assoc():$this->db->fetch_object() ; $i++ )
			$this->data_beans[$i] = $this->db->data ;
		return $this->data_beans;
	}

	protected function _create_query_insertar( $objeto ){
		$values = array();
		$fields = array();		
		if (count( $this->fields )>0)
			foreach ( $this->fields  as $key ){
					$get = "get".ucfirst($key);
					if ( $objeto->$get() != '')
					{
						$values[] = $objeto->$get();
						$fields[] = $key;
					}
			}
		$qFields = implode( "," , $fields );
		$qValues = "'".implode( "','" , $values )."'";		
		$query=" insert into $this->table_name ( $qFields ) values ( $qValues ) ";
		return $query; 		
	}

	/**
	 * Inserta un registro en la tabla _table_name
	 * En caso de trabajar con postgresq, el array de nombres de columnas debe iniciar con el nombre de la llave primaria
	 * @see amaguk_dao_interface::_insertar()
	 */
	public function _insertar($objeto) {
		$this->db->setTable_name( $this->table_name );		
		$this->db->setIs_query(false);
		
		$query = $this->_create_query_insertar( $objeto );
		// echo "<br> $query <br>\n";
		
		if ( $this->db->getDriver() == amaguk_database_connection::DB_DRIVER_POSTGRESL ){
			$this->db->setField_key_name( $this->fields[0] );
			
			$this->db->insert_query( $query );
		}else{
			$this->db->query( $query );
		}		
		
		$this->where="";
		//print $query;
		$this->clearCondition();
		
	}
	
	protected function _create_query_reemplazar($objeto){
		$values = array();
		$fields = array();		
		if (count( $this->fields )>0)
			foreach ( $this->fields  as $key ){
					$get = "get".ucfirst($key);
					if ( $objeto->$get() != '')
					{
						$values[] = $objeto->$get();
						$fields[] = $key;
					}
			}		
		$qFields = implode( "," , $fields );
		$qValues = "'".implode( "','" , $values )."'";
		
		$query=" replace into $this->table_name ( $qFields ) values ( $qValues ) ";
		return $query;		
	}
	
	public function _reemplazar($objeto) {
		// TODO Auto-generated method stub
		$query = $this->_create_query_reemplazar( $objeto );
		$this->db->query( $query );
		$this->where="";		
	}	
	
	private function prepare_is_required(){
		$this->tmp_fields_require = array();
		foreach ( $this->fields_require as $k => $v )
			$this->tmp_fields_require[$v]=true;
	}

	public function _actualizar($objeto) {
		// TODO Auto-generated method stub
		$this->db->setIs_query(false);
		
		$this->prepare_is_required();
		
		$qUpdate="";
		$arrayu = array();
		
		if (count( $this->fields )>0)
			foreach ( $this->fields  as $key ){			
					$get = "get".ucfirst($key);
					$incluir = false;
					if ( $objeto->$get() != '')
						$incluir = true;					
					
					if ( !$incluir )
						$incluir =  isset( $this->tmp_fields_require[$key] ); 

					if ( $incluir )
					{
						$dato= $objeto->$get();
						$arrayu[] = " $key = '$dato' ";
					}
			}
			
		$qUpdate = implode( "," , $arrayu );		
		$where = ( strlen( $this->where ) > 0 ) ? " where $this->where ":"";
		$this->query = "update $this->table_name 
							set $qUpdate $where ";
		//print $this->query;
		
		$this->db->query( $this->query , false);
		$this->where="";
		
		
	}

	/* (non-PHPdoc)
	 * @see amaguk_dao_interface::_eliminar()
	 */
	public function _eliminar() {
		// TODO Auto-generated method stub
		$this->db->setIs_query(false);
		
		$where = ( strlen( $this->where ) > 0 ) ? " where $this->where ":"";
		$this->query = "delete from $this->table_name 
							$where ";
		$this->db->query( $this->query );
		$this->where="";		
	}
	
	public function addAndCondition($condicion=""){
		if ($condicion == "")
			return;
		if ( $this->where == "")
			$this->where = " where $condicion ";
		else
			$this->where .= " and $condicion ";
	}
	
	public function addOrCondition($condicion=""){
		if ($condicion == "")
			return;		
		if ( $this->where == "")
			$this->where = " where $condicion ";
		else
			$this->where .= " or $condicion ";
	}
	
	public function getDb(){
		return $this->db;
	}
	
	/**
	 * Limpiar la variable $where que contiene las condiciones para la consulta
	 */
	public function clearCondition(){
		$this->where="";
	}
	
	public function getIs_query() {
		return $this->db->getIs_query();
	}
	
	public function setIs_query($flag) {
		$this->db->setIs_query($flag) ;
	}
	
	public function get_errno(){
		return $this->db->get_errno();	
	}
	
	public function get_error(){
		return $this->db->get_error();
	}	
	
	/**
	 * Devuelve el ultimo query almacenado en $_POST["__query___"]
	 */
	public function get_last_query(){
		return $_POST["__query___"][ count( $_POST["__query___"] ) - 1 ];
	}
	
	
	public function print_last_query(){
		print $_POST["__query___"][ count( $_POST["__query___"] ) - 1 ]."<br>\n";
	}	
	
	
	
}
?>