<?php
/**
 * 
 * Manejo de idioma
 * @author agustin corona jimenez @agustinistmo
 * @since 2011
 *
 */
class Amaguk_lang {
	
	/**
	 * Nombre del lenguaje utilizado
	 * @var String
	 */
	private $lang;
	/**
	 * objeto con las etiquedas cargadas 
	 * @var object
	 */
	private $items;
	
	function __construct( $lang ){
		$this->lang = $lang;
	}

	
	/**
	 * @return the $lan
	 */
	public function getLang() {
		return $this->lang;
	}

	/**
	 * @param field_type $lan
	 */
	public function setLang($lang) {
		$this->lang = $lang;
	}
	
	public function read_lang( $file_lang ){
		if ( file_exists( $file_lang ) ){
			$json_lang = file_get_contents( $file_lang );
			$this->items = json_decode( $json_lang );
		}
	}
	
	public function label($id){
		if ( isset ( $this->items->{"$id"} ))
			return $this->items->{"$id"};
		return $id;
	}	

	public function L($id){
		print $this->label($id);
	}
	
}

?>