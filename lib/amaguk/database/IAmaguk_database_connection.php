<?php
/**
 * 
 * Enter description here ...
 * @author http://amagukmx.wordpress.com/
 *
 */
interface IAmaguk_database_connection {
	
	public function connect();
	
	public function close();
	
	public function query($query);
	
	public function begin();
	
	public function commit();

	public function rollback();
	
	public function affected_rows();
	
	public function fetch_object();
	
	public function fetch_array();
	
	public function fetch_assoc();
	
	public function fetch_row();
	
	public function num_rows();
	
	public function num_fields();
	
	public function field_name( $field_number );
	
	public function field_type( $field_number );
	
	public function field_length( $field_number );
	
	public function get_link_identifier();
	
	public function set_parameters($server, $user, $password, $database);
	
	
}

?>