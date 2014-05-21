<?php

require_once ('lib/amaguk/gca/IAmaguk_gca_dao.php');
require_once 'lib/amaguk/utils/Amaguk_database_access.php';

/**
 * 
 * Generador de codigo automatico para la clase DAO
 * @author agustinisc
 *
 */
class amaguk_gca_dao implements IAmaguk_gca_dao{
	
	public function __construct( ){
		
	}

	
/* (non-PHPdoc)
	 * @see amaguk_gca_dao_interface::genera_insertar()
	 */
	public function genera_insertar($fields,$table_name , $databean_name) {
		// TODO Auto-generated method stub
		$comma_separated = "'".implode("','", $fields)."'";
		$setMethod = "set".ucfirst( $fields[0] );
		$code =
	"	/**
	 * Insertar registro en la tabla $table_name
	 * @param $databean_name \$$table_name
	 */		
	public function insert( $databean_name \$$databean_name){		
		\$this->fields = array( $comma_separated );
		\$this->_insertar( \$$databean_name );
		\$$databean_name"."->$setMethod( \$this->db->insert_id() );
								
	}\n";
		return $code;
	}

/* (non-PHPdoc)
	 * @see amaguk_gca_dao_interface::genera_actualizar()
	 */
	public function genera_actualizar($fields,$table_name, $databean_name) {
		// TODO Auto-generated method stub
		$field_k =  $fields[0];
		$field_m = "\$$databean_name"."->get".ucfirst($fields[0])."()";
		
		$comma_separated = "'".implode("','", $fields)."'";
		$code =
"	/**
	 * Actualizar registro de la tabla $table_name
	 * @param $table_name \$$table_name
	 */
	public function update( $databean_name \$$databean_name){
		\$this->fields = array( $comma_separated );
		\$this->addAndCondition(\" $field_k = '\". $field_m .\"'\");
		\$this->where = \$this->getWhereWithout();		
		\$this->_actualizar( \$$databean_name );
	}\n";
		return $code;
		
	}

/* (non-PHPdoc)
	 * @see amaguk_gca_dao_interface::genera_eliminar()
	 */
	public function genera_eliminar( $fields , $table_name, $databean_name ) {
		// TODO Auto-generated method stub	
		$field_k =  $fields[0];
		$field_m = "\$$databean_name"."->get".ucfirst($fields[0])."()";
		
		$code =
"	/**
	 * Eliminar registro en la tabla $databean_name
	 * @param $databean_name \$$databean_name
	 */		
	public function delete( $databean_name \$$databean_name){
		\$this->addAndCondition(\" $field_k = '\". $field_m .\"'\");
		\$this->where = \$this->getWhereWithout();
		\$this->_eliminar( );
	}\n";
		return $code;
		
	}

/* (non-PHPdoc)
	 * @see amaguk_gca_dao_interface::genera_recuperarDataBean()
	 */
	public function genera_recuperarDataBean($objeto) {
		// TODO Auto-generated method stub
		
	}

/* (non-PHPdoc)
	 * @see amaguk_gca_dao_interface::genera_recuperarDataBeans()
	 */
	public function genera_recuperarDataBeans($objeto) {
		// TODO Auto-generated method stub
		
	}

/* (non-PHPdoc)
	 * @see amaguk_gca_dao_interface::genera_recuperarDataBeanX()
	 */
	public function genera_recuperarDataBeanX($query) {
		// TODO Auto-generated method stub
		
	}

/* (non-PHPdoc)
	 * @see amaguk_gca_dao_interface::genera_recuperarDataBeansX()
	 */
	public function genera_recuperarDataBeansX($query) {
		// TODO Auto-generated method stub
		
	}
/* (non-PHPdoc)
	 * @see amaguk_gca_dao_interface::genera_construct()
	 */
	public function genera_construct( $table_name ) {
		// TODO Auto-generated method stub
		$code =
"	
		/**
		 * <br>Auto-generated
		 */		
		public function __construct(){
		parent::__construct();
		\$this->table_name = self::TABLE_NAME;
	}\n";
		return $code;
	}
	
	
	public function genera_lista($fields,$table_name , $databean_name) {
		// TODO Auto-generated method stub
		$comma_separated = "t.".implode(", t.", $fields);	
		$code =
"	/**
	 * Recupera varios registro en la tabla $table_name
	 * @param $databean_name \$$databean_name
	 */		
	public function fetchDataBeans( $databean_name \$$databean_name = null ){
		if ( \$$databean_name == null )
			\$$databean_name = new $databean_name();
			
		// \$this->addAndCondition(\"\");

		\$where = \$this->getWhere();
		\$this->query = \"select  $comma_separated 
		from \$this->table_name as t 
		\$where \";
		return \$this->_recuperarDataBeans( \$$databean_name );
	}\n";
		return $code;		
	}
	
	public function genera_consulta($fields,$table_name , $databean_name) {
		// TODO Auto-generated method stub
		$field_k =  $fields[0];
		$field_m = "\$$databean_name"."->get".ucfirst($fields[0])."()";
				
		$comma_separated = "t.".implode(", t.", $fields);	
		$code =
"	/**
	 * Recupera un registro en la tabla $table_name
	 * @param $databean_name \$$databean_name
	 */		
	public function fetchDataBean( $databean_name \$$databean_name){	
		\$this->addAndCondition(\" $field_k = '\". $field_m .\"'\");
		\$where = \$this->getWhere();
		\$this->query = \"select  $comma_separated 
		from \$this->table_name as t 
		\$where limit 1 \";
		\$this->_recuperarDataBean( \$$databean_name );
	}\n";
		return $code;		
	}	

}

?>