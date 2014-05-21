<?php

require_once('lib/amaguk/database/IAmaguk_database_connection.php');
/**
 * 
 * @author http://amagukmx.wordpress.com/
 *
 */
abstract class Amaguk_database_connection implements IAmaguk_database_connection{

	const DB_DRIVER_POSTGRESL="postgresql";
	const DB_DRIVER_MYSQL="mysql";
	const DB_DRIVER_MSSQL="mssql";
	const DB_DRIVER_PDO_MSSQL="pdo_mssql";
	
	const DB_DRIVER_ADO_MSSQL="ado_mssql";
	const DB_DRIVER_ADO_MYSQL="ado_mysql";
	
	protected $server;
	protected $user;
	protected $password;
	protected $data_base_name;
	
	protected $link_identifier;
	protected $_query;
	protected $_table_name;
	protected $_field_key_name;
	protected $result;
	protected $driver;
	protected $last_insert_id;
	protected $_fields;
	protected $_counter;
	protected $_num_rows;
	
	protected $_is_query;
	
	/**
	 * Bandera para indicar si la tabla contiene un campo auto incrementable
	 * @var int
	 */
	public $_isAutoIncrement;
	
	/**
	 * Numero de error
	 * @var int
	 */
	protected $errno;
	
	/**
	 * Descripcion del error
	 * @var String
	 */
	protected $error;
	
	
	public $data;
	
	public function __construct(){
		$this->link_identifier=null;
		$this->_fields = 0;
		$this->_is_query = true ;
		$this->_isAutoIncrement = true ;
		$this->error = "";
		$this->errno = 0;
	}
	
	function __destruct(){
		if ( $this->link_identifier != null )
			if ( $this->driver != Amaguk_database_access::DB_DRIVER_PDO_MSSQL )
				 $this->close();
	}	
	
	/**
	 * @return the $_field_key_name
	 */
	public function getField_key_name() {
		return $this->_field_key_name;
	}
	
	public function getIs_query() {
		return $this->_is_query;
	}
	
	public function setIs_query($flag) {
		$this->_is_query = $flag ;
	}	

	/**
	 * @param field_type $_field_key_name
	 */
	public function setField_key_name($_field_key_name) {
		$this->_field_key_name = $_field_key_name;
	}

	/**
	 * @return the $_table_name
	 */
	public function getTable_name() {
		return $this->_table_name;
	}

	/**
	 * @param field_type $_table_name
	 */
	public function setTable_name($_table_name) {
		$this->_table_name = $_table_name;
	}

	/**
	 * @return the $driver
	 */
	public function getDriver() {
		return $this->driver;
	}

	/**
	 * @param field_type $driver
	 */
	public function setDriver($driver) {
		$this->driver = $driver;
	}

	/**
	 * @return the $query
	 */
	public function getQuery() {
		return $this->_query;
	}

	/**
	 * @return the $result
	 */
	public function getResult() {
		return $this->result;
	}

	/**
	 * @param field_type $query
	 */
	public function setQuery($query) {
		$this->_query = $query;
	}

	/**
	 * @param field_type $result
	 */
	public function setResult($result) {
		$this->result = $result;
	}

	/**
	 * @return the $user
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * @return the $password
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * @return the $data_base_name
	 */
	public function getData_base_name() {
		return $this->data_base_name;
	}

	/**
	 * @return the $server
	 */
	public function getServer() {
		return $this->server;
	}

	/**
	 * @return the $link_identifier
	 */
	public function getLink_identifier() {
		return $this->link_identifier;
	}

	/**
	 * @param field_type $server
	 */
	public function setServer($server) {
		$this->server = $server;
	}

	/**
	 * @param field_type $link_identifier
	 */
	public function setLink_identifier($link_identifier) {
		$this->link_identifier = $link_identifier;
	}

	/**
	 * @param field_type $user
	 */
	public function setUser($user) {
		$this->user = $user;
	}

	/**
	 * @param field_type $password
	 */
	public function setPassword($password) {
		$this->password = $password;
	}

	/**
	 * @param field_type $data_base_name
	 */
	public function setData_base_name($data_base_name) {
		$this->data_base_name = $data_base_name;
	}
}
?>