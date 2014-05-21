<?php
///require_once('lib/amaguk/database/Amaguk_adodb_connection.php');
require_once('lib/amaguk/database/Amaguk_mssql_connection.php');
require_once('lib/amaguk/database/Amaguk_pdo_mssql_connection.php');
require_once 'lib/amaguk/database/Amaguk_pg_connection.php';
require_once('lib/amaguk/database/Amaguk_mysql_connection.php');
require_once 'lib/amaguk/framework/Amaguk_properties.php';

$properties = new Amaguk_properties();
$db_driver = $properties->getValue("mgk_db_driver");

/*
if ( $db_driver == Amaguk_database_connection::DB_DRIVER_MYSQL ){
	class DynamicParent extends Amaguk_mysql_connection {};
}
else{
	class DynamicParent extends Amaguk_pg_connection {};	
} */

$_POST[MGK_SESSION_NAME."_db_driver"] = $db_driver;

switch ($db_driver){
	case Amaguk_database_connection::DB_DRIVER_ADO_MSSQL:
		class DynamicParent extends Amaguk_adodb_connection {};
		break;	
	
	case Amaguk_database_connection::DB_DRIVER_POSTGRESL:
		class DynamicParent extends Amaguk_pg_connection {};
	break;
	case Amaguk_database_connection::DB_DRIVER_MSSQL:
		class DynamicParent extends Amaguk_mssql_connection {};
	break;
	case Amaguk_database_connection::DB_DRIVER_PDO_MSSQL:
		class DynamicParent extends Amaguk_pdo_mssql_connection {};
		break;
	case Amaguk_database_connection::DB_DRIVER_MYSQL:
	default: 
		class DynamicParent extends Amaguk_mysql_connection {};
	break;
		
}


/**
 * Conexion a base de datos
 * Amaguk PHP Framework
 * @author agustin corona jimenez @agustinistmo
 * @since 2011
 *
 */
class Amaguk_database_access extends DynamicParent  {
	
	public function __construct(){	
		parent::__construct();
					
		global $properties ;
		
		$this->driver = $properties->values["mgk_db_driver"];
		$this->server = $properties->values["mgk_db_server"];
		$this->user = $properties->values["mgk_db_user"];
		$this->password = $properties->values["mgk_db_password"];
		$this->data_base_name = $properties->values["mgk_db_name"];		 
	}
}
?>