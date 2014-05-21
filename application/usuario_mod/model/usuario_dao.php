<?php
	require_once 'application/usuario_mod/model/usuario_databean.php';


/**
 * Data Access Object for mgk_usuario
 * @author amaguk.ngupisoft.com/gca 
 * 2013/11/19 09:44:59
 */
class usuario_dao  extends  Amaguk_dao  {

	const TABLE_NAME='mgk_usuario';


//- - - -  methods
	public function __construct(){
		parent::__construct();
		$this->table_name = self::TABLE_NAME;
	}
	/**
	 * Insertar registro en la tabla mgk_usuario
	 * @param usuario_databean $mgk_usuario
	 */		
	public function insert( usuario_databean $usuario_databean){
		$this->fields = array( 'usuario_id','usuario_email','usuario_password','tipo_usuario_id','nombre','fecha_inserta','fecha_inicio','fecha_actualiza','usuario_id_inserta','usuario_id_actualiza','comentarios' );
		$this->_insertar( $usuario_databean );
		$usuario_databean->setUsuario_id( $this->db->insert_id() );
								
	}
	/**
	 * Actualizar registro de la tabla mgk_usuario
	 * @param mgk_usuario $mgk_usuario
	 */
	public function update( usuario_databean $usuario_databean){
		$this->fields = array( 'usuario_id','usuario_email','usuario_password','tipo_usuario_id','nombre','token' );
		$this->where="usuario_id = ".$usuario_databean->getUsuario_id();
		$this->_actualizar( $usuario_databean );
	}
	/**
	 * Eliminación LOGICA registro en la tabla usuario_databean
	 * @param usuario_databean $usuario_databean
	 */		
	public function delete( usuario_databean $usuario_databean){
		$usuario_databean->setFecha_actualiza(date('Y-m-d H:i:s'));
		$usuario_databean->setFecha_elimina($usuario_databean->getFecha_actualiza());
				
		$this->fields = array( 'fecha_actualiza','fecha_elimina','usuario_id_actualiza' );
		$this->where=" usuario_id = ".$usuario_databean->getUsuario_id();
		$this->_actualizar( $usuario_databean );
	}
	
	/*public function delete( usuario_databean $usuario_databean){
		$this->where = " usuario_id = '". $usuario_databean->getUsuario_id() ."'";
		$this->_eliminar( );
	}*/	
	
	
	/**
	 * Recupera varios registro en la tabla mgk_usuario
	 * @param usuario_databean $usuario_databean
	 */		
	public function fetchDataBeans( usuario_databean $usuario_databean = null ){
		if ( $usuario_databean == null )
			$usuario_databean = new usuario_databean();
		$this->addAndCondition("t.fecha_elimina is null");
		$where = $this->getWhere();
		$this->query = "select  t.usuario_id, t.usuario_email, t.usuario_password, t.tipo_usuario_id, t.nombre ,t.token,t.fecha_inserta,t.fecha_inicio,t.fecha_elimina,t.usuario_id_inserta,t.usuario_id_actualiza,t.comentarios
		from $this->table_name as t 
		$where ";
		return $this->_recuperarDataBeans( $usuario_databean );
	}
	/**
	 * Recupera un registro en la tabla mgk_usuario
	 * @param usuario_databean $usuario_databean
	 */		
	public function fetchDataBean( usuario_databean $usuario_databean){	
		$this->addAndCondition(" t.usuario_id = '". $usuario_databean->getUsuario_id() ."'");
		$this->addAndCondition("t.fecha_elimina is null");
		$where = $this->getWhere();
		$this->query = "select  t.usuario_id, t.usuario_email, t.usuario_password, t.tipo_usuario_id, t.nombre ,t.token,t.fecha_inserta,t.fecha_inicio,t.fecha_elimina,t.usuario_id_inserta,t.usuario_id_actualiza,t.comentarios
		from $this->table_name as t 
		$where limit 1 ";
		$this->_recuperarDataBean( $usuario_databean );
	}
	
	public function fetchDataBeanByLogin( usuario_databean $usuario_databean){
		$this->addAndCondition("t.fecha_elimina is null");
		$this->addAndCondition(" MD5(usuario_email) = '". $usuario_databean->getUsuario_email() ."'");
		$this->addAndCondition(" t.usuario_password = '". $usuario_databean->getUsuario_password() ."'");
		$where = $this->getWhere();
		$this->query = "select  t.usuario_id, t.usuario_email, t.usuario_password, t.tipo_usuario_id, t.nombre,t.token,t.fecha_inserta,t.fecha_inicio,t.fecha_elimina,t.usuario_id_inserta,t.usuario_id_actualiza,t.comentarios
		from $this->table_name as t
		$where limit 1 ";
		$this->_recuperarDataBean( $usuario_databean );
	}
	
	public function fetchDataBeanByUser( usuario_databean $usuario_databean){
		$this->addAndCondition("t.fecha_elimina is null");
		$this->addAndCondition(" t.usuario_email = '". $usuario_databean->getUsuario_email() ."'");
		$where = $this->getWhere();
		$this->query = "select  t.usuario_id, t.usuario_email, t.usuario_password, t.tipo_usuario_id, t.nombre,t.token,t.fecha_inserta,t.fecha_inicio,t.fecha_elimina,t.usuario_id_inserta,t.usuario_id_actualiza,t.comentarios
		from $this->table_name as t
		$where limit 1 ";
		$this->_recuperarDataBean( $usuario_databean );
	}
	
	public function fetchDataBeanByToken( usuario_databean $usuario_databean){
		$this->addAndCondition("t.fecha_elimina is null");
		$this->addAndCondition(" t.token = '". $usuario_databean->getToken() ."'");
		$where = $this->getWhere();
		$this->query = "select  t.usuario_id, t.usuario_email, t.usuario_password, t.tipo_usuario_id, t.nombre,t.token,t.fecha_inserta,t.fecha_inicio,t.fecha_elimina,t.usuario_id_inserta,t.usuario_id_actualiza,t.comentarios
		from $this->table_name as t
		$where limit 1 ";
		$this->_recuperarDataBean( $usuario_databean );
	}	

}
?>