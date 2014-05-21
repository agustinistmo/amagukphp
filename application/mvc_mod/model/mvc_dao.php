<?php
	require_once 'application/mvc_mod/model/mvc_databean.php';


/**
 * Data Access Object for mgk_historia_acceso
 * @author http://amagukmx.wordpress.com/
 * 2013/12/03 16:19:01
 */
class mvc_dao extends Amaguk_dao {

	const TABLE_NAME='mgk_historia_acceso';

//- - - -  methods
	public function __construct(){
		parent::__construct();
		$this->table_name = self::TABLE_NAME;
	}
	/**
	 * Insertar registro en la tabla mgk_historia_acceso
	 * @param mvc_databean $mgk_historia_acceso
	 */		
	public function insert( mvc_databean $mvc_databean){		
		$this->fields = array( 'historia_id','usuario_id','fecha_inicio','fecha_salida','direccion_id','latitud','longitud' );
		$this->_insertar( $mvc_databean );
		$mvc_databean->setHistoria_id( $this->db->insert_id() );
								
	}
	/**
	 * Actualizar registro de la tabla mgk_historia_acceso
	 * @param mgk_historia_acceso $mgk_historia_acceso
	 */
	public function update( mvc_databean $mvc_databean){
		$this->fields = array( 'historia_id','usuario_id','fecha_inicio','fecha_salida','direccion_id','latitud','longitud' );
		$this->addAndCondition(" historia_id = '". $mvc_databean->getHistoria_id() ."'");
		$this->where = $this->getWhereWithout();		
		$this->_actualizar( $mvc_databean );
	}
	/**
	 * Eliminar registro en la tabla mvc_databean
	 * @param mvc_databean $mvc_databean
	 */		
	public function delete( mvc_databean $mvc_databean){
		$this->addAndCondition(" historia_id = '". $mvc_databean->getHistoria_id() ."'");
		$this->where = $this->getWhereWithout();
		$this->_eliminar( );
	}
	/**
	 * Recupera varios registro en la tabla mgk_historia_acceso
	 * @param mvc_databean $mvc_databean
	 */		
	public function fetchDataBeans( mvc_databean $mvc_databean = null ){
		if ( $mvc_databean == null )
			$mvc_databean = new mvc_databean();
			
		// $this->addAndCondition("");

		$where = $this->getWhere();
		$this->query = "select  t.historia_id, t.usuario_id, t.fecha_inicio, t.fecha_salida, t.direccion_id, t.latitud, t.longitud 
		from $this->table_name as t 
		$where ";
		return $this->_recuperarDataBeans( $mvc_databean );
	}
	/**
	 * Recupera un registro en la tabla mgk_historia_acceso
	 * @param mvc_databean $mvc_databean
	 */		
	public function fetchDataBean( mvc_databean $mvc_databean){	
		$this->addAndCondition(" historia_id = '". $mvc_databean->getHistoria_id() ."'");
		$where = $this->getWhere();
		$this->query = "select  t.historia_id, t.usuario_id, t.fecha_inicio, t.fecha_salida, t.direccion_id, t.latitud, t.longitud 
		from $this->table_name as t 
		$where limit 1 ";
		$this->_recuperarDataBean( $mvc_databean );
	}

}
?>