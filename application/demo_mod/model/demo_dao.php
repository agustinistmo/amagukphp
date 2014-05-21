<?php
	require_once 'application/demo_mod/model/demo_databean.php';


/**
 * Data Access Object for mgk_tipo_usuario
 * @author http://amagukmx.wordpress.com/
 * 2013/12/03 17:11:52
 */
class demo_dao extends Amaguk_dao {

	const TABLE_NAME='mgk_tipo_usuario';


//- - - -  methods
	public function __construct(){
		parent::__construct();
		$this->table_name = self::TABLE_NAME;
	}
	/**
	 * Insertar registro en la tabla mgk_tipo_usuario
	 * @param demo_databean $mgk_tipo_usuario
	 */		
	public function insert( demo_databean $demo_databean){		
		$this->fields = array( 'tipo_usuario_id','tipo_usuario_nombre','descripcion' );
		$this->_insertar( $demo_databean );
		$demo_databean->setTipo_usuario_id( $this->db->insert_id() );
								
	}
	/**
	 * Actualizar registro de la tabla mgk_tipo_usuario
	 * @param mgk_tipo_usuario $mgk_tipo_usuario
	 */
	public function update( demo_databean $demo_databean){
		$this->fields = array( 'tipo_usuario_id','tipo_usuario_nombre','descripcion' );
		$this->addAndCondition(" tipo_usuario_id = '". $demo_databean->getTipo_usuario_id() ."'");
		$this->where = $this->getWhereWithout();		
		$this->_actualizar( $demo_databean );
	}
	/**
	 * Eliminar registro en la tabla demo_databean
	 * @param demo_databean $demo_databean
	 */		
	public function delete( demo_databean $demo_databean){
		$this->addAndCondition(" tipo_usuario_id = '". $demo_databean->getTipo_usuario_id() ."'");
		$this->where = $this->getWhereWithout();
		$this->_eliminar( );
	}
	/**
	 * Recupera varios registro en la tabla mgk_tipo_usuario
	 * @param demo_databean $demo_databean
	 */		
	public function fetchDataBeans( demo_databean $demo_databean = null ){
		if ( $demo_databean == null )
			$demo_databean = new demo_databean();
			
		// $this->addAndCondition("");

		$where = $this->getWhere();
		$this->query = "select  t.tipo_usuario_id, t.tipo_usuario_nombre, t.descripcion 
		from $this->table_name as t 
		$where ";
		return $this->_recuperarDataBeans( $demo_databean );
	}
	/**
	 * Recupera un registro en la tabla mgk_tipo_usuario
	 * @param demo_databean $demo_databean
	 */		
	public function fetchDataBean( demo_databean $demo_databean){	
		$this->addAndCondition(" tipo_usuario_id = '". $demo_databean->getTipo_usuario_id() ."'");
		$where = $this->getWhere();
		$this->query = "select  t.tipo_usuario_id, t.tipo_usuario_nombre, t.descripcion 
		from $this->table_name as t 
		$where limit 1 ";
		$this->_recuperarDataBean( $demo_databean );
	}
	
	/**
	 * Hace una consulta SQL con las funciones propias de PHP
	 * @return array
	 */
	public function consulta_manual(){
		$link = $this->db->getLink_identifier();
		$query ="select * from mgk_tipo_usuario";	
		$result = mysqli_query($link , $query );
		$items = array();
		while ($row = mysqli_fetch_array($result)) {
			$items[]= $row;
		}
		return $items;
	}

}
?>