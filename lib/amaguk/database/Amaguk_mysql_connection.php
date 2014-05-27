<?php
require_once('lib/amaguk/database/Amaguk_database_connection.php');
/**
 * Conexión con mysql usando mysqli
 * @author http://amagukmx.wordpress.com/
 *
 */	
class Amaguk_mysql_connection extends Amaguk_database_connection {
	
	function __construct(){
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
		$this->link_identifier = mysqli_connect( $this->server , $this->user , $this->password, $this->data_base_name );
		if ( !$this->link_identifier)
			die('###Amaguk_mysqli_connection###--001-- ERROR DE CONEXION');
		return $this->link_identifier;
	}
	
	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::close()
	 */
	public function close() {
		// TODO Auto-generated method stub
		mysqli_close( $this->link_identifier );
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
		return mysqli_affected_rows( $this->link_identifier );		
	}


	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::fetch_object()
	 */
	public function fetch_object() {
		// TODO Auto-generated method stub
		$this->data = mysqli_fetch_object( $this->result);		
		return $this->data;		
		
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::fetch_array()
	 */
	public function fetch_array() {
		// TODO Auto-generated method stub
		$this->data = mysqli_fetch_array( $this->result );
		
		return $this->data;		
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::fetch_assoc()
	 */
	public function fetch_assoc() {
		// TODO Auto-generated method stub
		if ( !$this->result )
			return 0;
		$this->data = mysqli_fetch_assoc( $this->result );
		
		return $this->data;
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::fetch_row()
	 */
	public function fetch_row() {
		// TODO Auto-generated method stub
		$this->data = mysqli_fetch_row( $this->result );
		
		return $this->data;		
		
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::num_rows()
	 */
	public function num_rows() {
		// TODO Auto-generated method stub
		return  mysqli_num_rows( $this->result );
		
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::num_fields()
	 */
	public function num_fields() {
		// TODO Auto-generated method stub
		return  mysqli_num_fields( $this->result );
		
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
	public function query( $query ) {
		$this->query = $query;
		 //echo "::: <br> $query <br> :::";
		// TODO Auto-generated method stub
		if ( !isset( $_POST["__query__"] ))
			$_POST["__query__"]="";
		$_POST["__query__"].="<hr>".$query;		
		$this->result = mysqli_query( $this->link_identifier , $this->query);
		$this->query="";
		$this->get_errno();
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
		$this->errno = mysqli_errno( $this->link_identifier ); 
		return $this->errno;	
	}
	
	public function get_error() {
		// TODO Auto-generated method stub
		return mysqli_error( $this->link_identifier );		
	}	
	
	private function fetch_fields(){
		$finfo = mysqli_fetch_fields( $this->result );
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
		if ( $this->errno > 0 )
			return 0;
		return mysqli_insert_id($this->link_identifier);		
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