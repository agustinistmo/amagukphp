<?php
require_once('lib/amaguk/database/Amaguk_database_connection.php');
/**
 * Conexión con mssql server usando mssql
 * @author http://amagukmx.wordpress.com/
 *
 */	
class Amaguk_pdo_mssql_connection extends Amaguk_database_connection {
	
	public function __construct(){
		parent::__construct();
	}
		
	function __destruct() {
		parent::__destruct();
	}
	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::connec()
	 */
	public function connect() {
		// TODO Auto-generated method stub
		
		/* Connect using Windows Authentication. */
		
		if ( isset ( $_POST["__link_identifier__"] )  ){
			$this->link_identifier = $_POST["__link_identifier__"];
			return $this->link_identifier;
		}
		
		//echo " <br> Amaguk_pdo_mssql_connection :: connect <br>";
		
		try
		{
			$this->link_identifier = new PDO( "sqlsrv:server=".$this->server." ; Database=".$this->data_base_name, $this->user, $this->password );
			$this->link_identifier->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		}
		catch(Exception $e)
		{
			print('###Amaguk_pdo_mssql_connection###--001-- ERROR DE CONEXION :: ');
			die( print_r( $e->getMessage() ) );
		}
		$_POST["__link_identifier__"] = $this->link_identifier;		
		return $this->link_identifier;
	}
	
	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::close()
	 */
	public function close() {
		// TODO Auto-generated method stub
		mssql_close( $this->link_identifier );
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::begin()
	 */
	public function begin() {
		// TODO Auto-generated method stub
		
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::commit()
	 */
	public function commit() {
		// TODO Auto-generated method stub
		
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::rollback()
	 */
	public function rollback() {
		// TODO Auto-generated method stub
		
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::affected_rows()
	 */
	public function affected_rows() {
		// TODO Auto-generated method stub
		return mssql_affected_rows( $this->link_identifier );		
	}


	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::fetch_object()
	 */
	public function fetch_object() {
		// TODO Auto-generated method stub
		if ( !$this->result )
			return 0;
		$this->data = 0;
		
		if ( $this->_counter < $this->_num_rows ){
			$this->data = (object)$this->result[ $this->_counter ];
			$this->_counter ++ ;
		}
		 return $this->data;	
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::fetch_array()
	 */
	public function fetch_array() {
		// TODO Auto-generated method stub
		$this->data = mssql_fetch_array( $this->result );
		
		return $this->data;		
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::fetch_assoc()
	 */
	public function fetch_assoc() {
		// TODO Auto-generated method stub
		if ( !$this->result )
			return 0;
		$this->data = 0;
		
		if ( $this->_counter < $this->_num_rows ){
			$this->data = $this->result[ $this->_counter ];
			$this->_counter ++ ;
		}
		
		 return $this->data;
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::fetch_row()
	 */
	public function fetch_row() {
		// TODO Auto-generated method stub
		//$this->data = mssql_fetch_row( $this->result );
		if ( !$this->result )
			return 0;
		$this->data = array();
		
		if ( $this->_counter < $this->_num_rows ){
			$data = $this->result[ $this->_counter ];
			foreach ( $data as $d )
				$this->data[] = $d;
			$this->_counter ++ ;
		}
		
		 return $this->data;	
		
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::num_rows()
	 */
	public function num_rows() {
		// TODO Auto-generated method stub
		return  $this->_num_rows ;
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::num_fields()
	 */
	public function num_fields() {
		// TODO Auto-generated method stub
		return  count( $this->result[0] );
		
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::set_parameters()
	 */
	public function set_parameters($server, $user, $password, $database) {
		// TODO Auto-generated method stub
		$this->server = $server;
		$this->user = $user ;
		$this->password = $password;
		$this->data_base_name = $database;
	}
/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::query()
	 */
	public function query( $query ,$_is_query = -1 ) {
		if ( $_is_query != -1 )
			$this->_is_query = $_is_query;
		
		$this->query = str_replace("limit 1","",$query);
		
		if ( !isset( $_POST["__query__"] ))
			$_POST["__query__"]="";
		$_POST["__query__"].="<hr>".$query;
		$_POST["__query___"][]=$query;
			
		$result = $this->link_identifier->prepare( $this->query );
		//$getProducts->execute($params);
		$this->result = array();
		$this->_counter = 0;

		$this->error = "";
		$this->errno = 0;		

		try{
			$result->execute();
			if ( $this->_is_query ){
				$this->result = $result->fetchAll(PDO::FETCH_ASSOC);
			}
		}catch (Exception $e){			
			$this->error = "ERROR ::".$e ;
			$this->errno = 1;
			/* echo("Amaguk_pdo_mssql_connection.query()");
			 echo("<br><br>".$this->query."<br><br>".$e);	
			 exit; */
		}
		
		$this->query="";
		$this->_num_rows = count( $this->result );
	}
	
	public function execute( $query , $params = null) {
		if ( $params == null )
			$params = array();
		
		$this->query = $query;
		$result = $this->link_identifier->prepare( $this->query );
		
		$result->execute($params);
		return $result;
	}

	public function executeQuery( $query , $params = null) {
		if ( $params == null )
			$params = array();
		$this->query = $query;
		$result = $this->link_identifier->prepare( $this->query );
		$result->execute($params);
		$this->result = $result->fetchAll(PDO::FETCH_ASSOC);
	}
	
/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::get_link_identifier()
	 */
	public function get_link_identifier() {
		// TODO Auto-generated method stub
		return $this->link_identifier;		
	}

	/**
	 * 
	 * @return number
	 */
	public function get_errno() {
		// TODO Auto-generated method stub
		return  $this->errno;		
	}
	
	/**
	 * 
	 * @return string
	 */
	public function get_error() {
		// TODO Auto-generated method stub
		return ( $this->error);		
	}	
	
	private function fetch_fields(){
		
		$this->_fields = array();
		$i = 0 ;
		if ( count ( $this->result ) > 0 ) {
			foreach ( $this->result[0] as $key => $val )
			$this->_fields[$i++]["name"] = $key;
		}
		
		print_r( $this->_fields );
		
	}
	
	public function field_name( $field_offset ){
		if ($this->_fields == 0 )
			$this->fetch_fields();
		return $this->_fields[$field_offset]["name"];				
	}
	
	public function field_flags( $field_offset ){
		if ($this->_fields == 0 )
			$this->fetch_fields();
		return $this->_fields[$field_offset]["flags"];		
	}	
	
	public function field_length( $field_offset ){
		if ($this->_fields == 0 )
			$this->fetch_fields();
		return $this->_fields[$field_offset]["max_length"];		
	}
	
	public function field_type( $field_offset ){
		if ($this->_fields == 0 )
			$this->fetch_fields();
		return $this->_fields[$field_offset]["type"];		
	}

	public function insert_id(){
		$this->last_insert_id = $this->link_identifier->lastInsertId();
		return $this->last_insert_id;
	}
	
	public function field_is_null( $field_number ) {
		// TODO Auto-generated method stub
		
		$flags=  $this->field_flags( $field_number );
		
		$not_null = strpos($flags,"not_null");
		if ( $not_null ===false)
			return false;
		else
			return true;
	}

}

?>