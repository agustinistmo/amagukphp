<?php
	require_once 'application/mgk_tipousuario_mod/model/mgk_tipousuario_databean.php';


/**
 * Data Access Object for mgk_tipo_usuario
 * AMAGUK_GCA_VERSION: 0.3.0
 * @author http://amagukmx.wordpress.com/
 * 2013/12/10 10:56:19
 */
class mgk_tipousuario_dao extends Amaguk_dao {

	const TABLE_NAME='mgk_tipo_usuario';


//- - - -  methods
	public function __construct(){
		parent::__construct();
		$this->table_name = self::TABLE_NAME;
	}
	/**
	 * Insertar registro en la tabla mgk_tipo_usuario
	 * @param mgk_tipousuario_databean $mgk_tipo_usuario
	 */		
	public function insert( mgk_tipousuario_databean $mgk_tipousuario_databean){		
		$this->fields = array( 'tipo_usuario_id','tipo_usuario_nombre','descripcion' );
		$this->_insertar( $mgk_tipousuario_databean );
		$mgk_tipousuario_databean->setTipo_usuario_id( $this->db->insert_id() );
								
	}
	/**
	 * Actualizar registro de la tabla mgk_tipo_usuario
	 * @param mgk_tipo_usuario $mgk_tipo_usuario
	 */
	public function update( mgk_tipousuario_databean $mgk_tipousuario_databean){
		$this->fields = array( 'tipo_usuario_id','tipo_usuario_nombre','descripcion' );
		$this->addAndCondition(" tipo_usuario_id = '". $mgk_tipousuario_databean->getTipo_usuario_id() ."'");
		$this->where = $this->getWhereWithout();		
		$this->_actualizar( $mgk_tipousuario_databean );
	}
	/**
	 * Eliminar registro en la tabla mgk_tipousuario_databean
	 * @param mgk_tipousuario_databean $mgk_tipousuario_databean
	 */		
	public function delete( mgk_tipousuario_databean $mgk_tipousuario_databean){
		$this->addAndCondition(" tipo_usuario_id = '". $mgk_tipousuario_databean->getTipo_usuario_id() ."'");
		$this->where = $this->getWhereWithout();
		$this->_eliminar( );
	}
	/**
	 * Recupera varios registro en la tabla mgk_tipo_usuario
	 * @param mgk_tipousuario_databean $mgk_tipousuario_databean
	 */		
	public function fetchDataBeans( mgk_tipousuario_databean $mgk_tipousuario_databean = null ){
		if ( $mgk_tipousuario_databean == null )
			$mgk_tipousuario_databean = new mgk_tipousuario_databean();
			
		// $this->addAndCondition("");

		$where = $this->getWhere();
		$this->query = "select  t.tipo_usuario_id, t.tipo_usuario_nombre, t.descripcion 
		from $this->table_name as t 
		$where ";
		return $this->_recuperarDataBeans( $mgk_tipousuario_databean );
	}
	/**
	 * Recupera un registro en la tabla mgk_tipo_usuario
	 * @param mgk_tipousuario_databean $mgk_tipousuario_databean
	 */		
	public function fetchDataBean( mgk_tipousuario_databean $mgk_tipousuario_databean){	
		$this->addAndCondition(" tipo_usuario_id = '". $mgk_tipousuario_databean->getTipo_usuario_id() ."'");
		$where = $this->getWhere();
		$this->query = "select  t.tipo_usuario_id, t.tipo_usuario_nombre, t.descripcion 
		from $this->table_name as t 
		$where limit 1 ";
		$this->_recuperarDataBean( $mgk_tipousuario_databean );
	}

}
?>