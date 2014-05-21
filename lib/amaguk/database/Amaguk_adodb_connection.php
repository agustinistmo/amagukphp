<?php
require_once('lib/amaguk/database/Amaguk_database_connection.php');
require_once 'lib/adodb/adodb.inc.php';
/**
 * Conexión con mssql server usando mssql
 * @author http://amagukmx.wordpress.com/
 *
 */	
class Amaguk_adodb_connection extends Amaguk_database_connection {
	
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
		try
		{
			$db_driver = $_POST[MGK_SESSION_NAME."_db_driver"];
			
			switch ($db_driver){
				
				case Amaguk_database_connection::DB_DRIVER_ADO_MYSQL:
					
					$this->link_identifier = NewADOConnection('mysql');
					$this->link_identifier->Connect($this->server, $this->user, $this->password, $this->data_base_name);
					
					break;
					
				case Amaguk_database_connection::DB_DRIVER_ADO_MSSQL:
					$dsn = "Driver={SQL Server};Server=".$this->server.";Database=".$this->data_base_name.";";
					$this->link_identifier = NewADOConnection('odbc_mssql');
					$this->link_identifier->Connect($dsn,$this->user,$this->password);
					
					$this->link_identifier->NLS_DATE_FORMAT =  'RRRR-MM-DD HH24:MI:SS';
						
					break;
			}
						
		}
		catch(Exception $e)
		{
			print('###Amaguk_adodb_connection###--001-- ERROR DE CONEXION :: ');
			die( print_r( $e->getMessage() ) );
		}
		return $this->link_identifier;
	}
	
	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::close()
	 */
	public function close() {
		// TODO Auto-generated method stub
		 $this->link_identifier->Close();
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
		if (!$this->result->EOF) {
			$this->data = (object)$this->result->fields;
			$this->result->MoveNext();
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
		if (!$this->result->EOF) {
			$this->data = $this->result->fields;
			$this->result->MoveNext();
		}
		
		 return $this->data;
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::fetch_row()
	 */
	public function fetch_row() {
		// TODO Auto-generated method stub
		//$this->data = mssql_fetch_row( $this->result );
		die ("Amaguk_adodb_connection. fetch_row :: en construccion ... ");
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
		// TODO Auto-generated method stub
		if ( !isset( $_POST["__query__"] ))
			$_POST["__query__"]="";
		$_POST["__query__"].="<hr>".$query;	
		//$result = $this->link_identifier->prepare( $this->query );
		//$getProducts->execute($params);
		$this->result = array();
		$this->_counter = 0;
		
				
		try{
			if ($this->getIs_query()){
				$this->link_identifier->SetFetchMode(ADODB_FETCH_ASSOC);
			}
			$this->result = $this->link_identifier->Execute( $this->query );
			
		}catch (Exception $e){
			echo "Amaguk_adodb_connection.query()";
			 echo("<br><br>".$this->query."<br><br>".$e);	
			 exit;
		}
		
		/*
		while (!$this->result->EOF) {
			for ($i=0, $max=$this->result->FieldCount(); $i < $max; $i++)
				print $this->result->fields[$i].' ';
			$this->result->MoveNext();
			print "<br>n";
		}*/
				
		$this->query="";
	}
	
/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::get_link_identifier()
	 */
	public function get_link_identifier() {
		// TODO Auto-generated method stub
		return $this->link_identifier;		
	}
	
	public function get_errno() {
		// TODO Auto-generated method stub
		return mssql_errno( $this->link_identifier );		
	}
	
	public function get_error() {
		// TODO Auto-generated method stub
		return mssql_error( $this->link_identifier );		
	}	
	
	private function fetch_fields(){
		$finfo = mssql_fetch_fields( $this->result );
		$i = 0;
		foreach ($finfo as $field){
			foreach( $field as $k => $v){
				$this->_fields[$i][$k]= $v;
			}
			$i++;
		}	
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
		if ($this->_isAutoIncrement ){
			$this->result = $this->link_identifier->Execute( "SELECT IDENT_CURRENT( '".$this->_table_name."' ) as last_id" );
			$this->last_insert_id = $this->result->fields[0];
		}
		
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