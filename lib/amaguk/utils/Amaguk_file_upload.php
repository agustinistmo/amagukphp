<?php
/**
 * Subir Archivo
 * @author agustinistmo@gmail.com
 *
 */
class Amaguk_file_upload {
	
	protected $error;
	
	protected $tmp_name;
	
	protected $directorio;
	
	protected $nombre;
	
	protected $tipo;
	
	protected $peso;
	
	protected $binary;
	
	protected $pointer;
	
	protected $replace_force;

	/**
	 * Constructor
	 */
	public function amaguk_file_upload(){
		$this->replace_force=false;		
	}
	
	
	/**
	 * @return the $error
	 */
	public function getError() {
		return $this->error;
	}
	
	public function getReplace_force() {
		return $this->replace_force;
	}
	
	public function setReplace_force( $replace_force ) {
		$this->replace_force = $replace_force;
	}	


	/**
	 * @return the $directorio
	 */
	public function getDirectorio() {
		return $this->directorio;
	}

	/**
	 * @param field_type $directorio
	 */
	public function setDirectorio($directorio) {
		$this->directorio = $directorio;
	}

	public function getNombre(){
		return $this->nombre;
	}
	
	public function getTipo(){
		return $this->tipo;
	}
	
	public function getPeso(){
		return $this->peso;
	}
	
	public function getBynary(){
		return $this->binary;
	}
	
	public function getPointer(){
		return $this->pointer;
	}

	public function setPointer( $pointer ){
		$this->pointer = $pointer;
	}	
	
	
	public function setNombre( $nombre ){
		$this->nombre = $nombre;
	}
	
	public function setTipo( $tipo ){
		$this->tipo = $tipo;
	}
	
	public function setPeso( $peso ){
		$this->peso = $peso;
	}
	
	public function setBinary( $binary ){
		$this->binary = $binary;
	}
	
	public function unlink( ){
		unlink($this->directorio.$this->nombre);
	}	
	
	public function eraseFile( ){
		unlink($this->directorio.$this->nombre);
	}
	
	public function saveFile( $directorio="" ){
		if ( $directorio!="" )
			$this->directorio = $directorio;		
		if (file_exists ( $this->directorio.$this->nombre ) && $this->replace_force == false )
			$this->error = 1;
		else
			if (move_uploaded_file( $this->tmp_name , $this->directorio.$this->nombre ) )
				$this->error = 0;
			else
				$this->error = 2;
		return $this->error;
	}
	
	public function fseek($pos = 0 ){
		return fseek($this->pointer,$pos);
	}
	
	public function fopen($_file){
		$this->error = 0;
		$this->pointer = 0;
		if(!isset($_FILES[$_file]['tmp_name']))
		{
			$this->error=1;
			return null;
		}
		$this->tmp_name = $_FILES[$_file]['tmp_name'];
		$this->nombre = $_FILES[$_file]['name'];
		$this->peso = $_FILES[$_file]['size'];
		$this->tipo = $_FILES[$_file]['type'];

		if ( $this->nombre != "" )
			$this->pointer = fopen($this->tmp_name, "rb");		
	}

	public function readUpload($_file){
		$this->fopen($_file);		
		
		if ( $this->pointer != 0 ){
			$this->fseek(0);
			$this->binary = addslashes(fread( $this->pointer , filesize($this->tmp_name)));
			$this->fseek(0);
		}
		else
			$this->binary = "";
	}
	
	
/* (non-PHPdoc)
	 * @see amaguk_controller_interface::index_action()
	 */
	public function index_action() {
		// TODO Auto-generated method stub
		
	}

}

?>