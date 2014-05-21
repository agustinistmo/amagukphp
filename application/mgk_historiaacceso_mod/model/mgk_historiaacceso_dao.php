<?php
	require_once 'application/mgk_historiaacceso_mod/model/mgk_historiaacceso_databean.php';


/**
 * Data Access Object for mgk_historia_acceso
 * @author http://amagukmx.wordpress.com/
 * 2013/12/09 09:39:39
 */
class mgk_historiaacceso_dao extends Amaguk_dao {

	const TABLE_NAME='mgk_historia_acceso';


//- - - -  methods
	public function __construct(){
		parent::__construct();
		$this->table_name = self::TABLE_NAME;
	}
	/**
	 * Insertar registro en la tabla mgk_historia_acceso
	 * @param mgk_historiaacceso_databean $mgk_historia_acceso
	 */		
	public function insert( mgk_historiaacceso_databean $mgk_historiaacceso_databean){		
		$this->fields = array( 'historia_id','usuario_id','fecha_inicio','fecha_salida','direccion_id','latitud','longitud' );
		$this->_insertar( $mgk_historiaacceso_databean );
		$mgk_historiaacceso_databean->setHistoria_id( $this->db->insert_id() );
								
	}
	/**
	 * Actualizar registro de la tabla mgk_historia_acceso
	 * @param mgk_historia_acceso $mgk_historia_acceso
	 */
	public function update( mgk_historiaacceso_databean $mgk_historiaacceso_databean){
		$this->fields = array( 'historia_id','usuario_id','fecha_inicio','fecha_salida','direccion_id','latitud','longitud' );
		$this->addAndCondition(" historia_id = '". $mgk_historiaacceso_databean->getHistoria_id() ."'");
		$this->where = $this->getWhereWithout();		
		$this->_actualizar( $mgk_historiaacceso_databean );
	}
	/**
	 * Eliminar registro en la tabla mgk_historiaacceso_databean
	 * @param mgk_historiaacceso_databean $mgk_historiaacceso_databean
	 */		
	public function delete( mgk_historiaacceso_databean $mgk_historiaacceso_databean){
		$this->addAndCondition(" historia_id = '". $mgk_historiaacceso_databean->getHistoria_id() ."'");
		$this->where = $this->getWhereWithout();
		$this->_eliminar( );
	}
	/**
	 * Recupera varios registro en la tabla mgk_historia_acceso
	 * @param mgk_historiaacceso_databean $mgk_historiaacceso_databean
	 */		
	public function fetchDataBeans( mgk_historiaacceso_databean $mgk_historiaacceso_databean = null ){
		if ( $mgk_historiaacceso_databean == null )
			$mgk_historiaacceso_databean = new mgk_historiaacceso_databean();
			
		// $this->addAndCondition("");

		$where = $this->getWhere();
		$this->query = "select  t.historia_id, t.usuario_id, t.fecha_inicio, t.fecha_salida, t.direccion_id, t.latitud, t.longitud 
		from $this->table_name as t 
		$where ";
		return $this->_recuperarDataBeans( $mgk_historiaacceso_databean );
	}
	/**
	 * Recupera un registro en la tabla mgk_historia_acceso
	 * @param mgk_historiaacceso_databean $mgk_historiaacceso_databean
	 */		
	public function fetchDataBean( mgk_historiaacceso_databean $mgk_historiaacceso_databean){	
		$this->addAndCondition(" historia_id = '". $mgk_historiaacceso_databean->getHistoria_id() ."'");
		$where = $this->getWhere();
		$this->query = "select  t.historia_id, t.usuario_id, t.fecha_inicio, t.fecha_salida, t.direccion_id, t.latitud, t.longitud 
		from $this->table_name as t 
		$where limit 1 ";
		$this->_recuperarDataBean( $mgk_historiaacceso_databean );
	}

	
	public function fetchDataBeansByUsuarioId( mgk_historiaacceso_databean $mgk_historiaacceso_databean = null , $limit = 10 ){
		if ( $mgk_historiaacceso_databean == null )
			$mgk_historiaacceso_databean = new mgk_historiaacceso_databean();
			
		$this->addAndCondition(" usuario_id = '". $mgk_historiaacceso_databean->getUsuario_id() ."'");
		$this->addAndCondition(" latitud is not null ");
		$this->addAndCondition(" longitud is not null ");
	
		$where = $this->getWhere();
		$this->query = "select  t.historia_id, t.usuario_id, t.fecha_inicio, t.fecha_salida, t.direccion_id, t.latitud, t.longitud
		from $this->table_name as t
		$where limit $limit";
	
		return $this->_recuperarDataBeans( $mgk_historiaacceso_databean );
	}	
}
?>