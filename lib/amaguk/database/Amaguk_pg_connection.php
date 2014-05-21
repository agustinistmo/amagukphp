<?php
require_once('lib/amaguk/database/Amaguk_database_connection.php');
/**
 * Conexión con PostgreSQL
 * @author http://amagukmx.wordpress.com/
 *
 */	
class Amaguk_pg_connection extends Amaguk_database_connection {
	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::field_length()
	 */
	

	
	public function field_length( $field_number ) {
		// TODO Auto-generated method stub
		if ( $this->result )
			return pg_field_size( $this->result , $field_number );
		else
			return 0;
	}
	
	public function field_is_null( $field_number ) {
		// TODO Auto-generated method stub
		if ( $this->result )
			return pg_field_is_null( $this->result , $field_number );
		else
			return 0;
	}	
	
	

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::field_name()
	 */
	public function field_name( $field_number ) {
		// TODO Auto-generated method stub
		if ( $this->result )
			return pg_field_name( $this->result , $field_number );
		else
			return "";
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::field_type()
	 */
	public function field_type( $field_number ) {
		// TODO Auto-generated method stub
		if ( $this->result )
			return pg_field_type( $this->result , $field_number );
		else
			return "";		
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::connec()
	 */
	public function connect() {
		// TODO Auto-generated method stub
		
		$this->link_identifier = pg_connect("host=$this->server port=5432 dbname=$this->data_base_name user=$this->user password=$this->password");
	}
	
	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::close()
	 */
	public function close() {
		// TODO Auto-generated method stub
		
		pg_close( $this->link_identifier );
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
		
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::fetch_object()
	 */
	public function fetch_object() {
		// TODO Auto-generated method stub
		$this->data = null ;
		if ( $this->result )
			$this->data = pg_fetch_object( $this->result );
		
		return $this->data;
		
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::fetch_array()
	 */
	public function fetch_array() {
		// TODO Auto-generated method stub
		$this->data = pg_fetch_array( $this->result );
		
		return $this->data;		
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::fetch_assoc()
	 */
	public function fetch_assoc() {
		// TODO Auto-generated method stub

		if ($this->result)
			$this->data = pg_fetch_assoc( $this->result );
		else 
			$this->data=0;
		
		return $this->data;
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::fetch_row()
	 */
	public function fetch_row() {
		// TODO Auto-generated method stub
		if ($this->result)
			$this->data = pg_fetch_row( $this->result );
		else 
			$this->data = 0 ;
		
		return $this->data;		
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::num_rows()
	 */
	public function num_rows() {
		// TODO Auto-generated method stub
		if ($this->result)
			return pg_num_rows( $this->result );
		else
			return 0;
	}

	/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::num_fields()
	 */
	public function num_fields() {
		// TODO Auto-generated method stub
		if ($this->result)
			return pg_num_fields( $this->result );
		else
			return 0;		
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
		$this->query = trim($query);
		// TODO Auto-generated method stub
		$this->result = pg_query( $this->link_identifier , $this->query );
	}
	
	public function insert_query( $query ) {
		$this->query = trim($query);
		// TODO Auto-generated method stub
		$this->result = pg_query( $this->link_identifier , $this->query );
		//$this->pgsqlLastInsertId();
	}

	function pgsqlLastInsertId( )
	{
		$this->last_insert_id = 0;
		$query = "SELECT last_value FROM ".$this->_table_name."_".$this->_field_key_name."_seq" ;
		$this->query( $query );
		$this->fetch_object();
		if ( $this->data )
			$this->last_insert_id = $this->data->last_value;
	    return false;
	}

		
/* (non-PHPdoc)
	 * @see amaguk_database_connection_interface::get_link_identifier()
	 */
	public function get_link_identifier() {
		// TODO Auto-generated method stub
		return $this->link_identifier;		
	}

	public function insert_id(){
		$this->pgsqlLastInsertId();
		return $this->last_insert_id;
	}

}

?>