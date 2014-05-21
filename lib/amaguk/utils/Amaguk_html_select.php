<?php
/** 
 * Clase para Select HTML 
 * @version 0.4.2
 * <br>2014-01-08 correccion para cuando los valores son de un array 
 * <br>2013-12-26 para el metodo show si lleva parametro adicional, se suma al que tenía la clase
 * <br>2013-12-10
 * @author agustinistmo
 */
class Amaguk_html_select{

	private $name;
	private $id;
	private $options;
	private $aditional;
	private $field_value;
	private $field_description;
	private $field_label;
	private $selected_value;
	public $from_array = false ;

	/**
	 * @return the $field_value
	 */
	public function getField_value() {
		return $this->field_value;
	}
	
	public function getField_label() {
		return $this->field_label;
	}	

	/**
	 * @return the $field_description
	 */
	public function getField_description() {
		return $this->field_description;
	}

	/**
	 * @param field_type $field_value
	 */
	public function setField_value($field_value) {
		$this->field_value = $field_value;
	}
	
	public function setField_label($field_label) {
		$this->field_label = $field_label;
	}	

	/**
	 * @param field_type $field_description
	 */
	public function setField_description($field_description) {
		$this->field_description = $field_description;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $options
	 */
	public function getOptions() {
		return $this->options;
	}

	/**
	 * @return the $aditional
	 */
	public function getAditional() {
		return $this->aditional;
	}

	/**
	 * @param field_type $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param field_type $options
	 */
	public function setOptions($options) {
		$this->options = $options;
	}

	/**
	 * @param field_type $aditional
	 */
	public function setAditional($aditional) {
		$this->aditional = $aditional;
	}
	
	public function __construct(){

	}
	
	public function setParameters(array $parametros){
		$this->id = $parametros["id"];
		$this->name= $parametros["name"];
		$this->field_description = $parametros["field_description"];
		$this->field_value= $parametros["field_value"]; 
	}
	
	public function show($aditional = "" ){
		if ( trim ( $aditional) != "")
			$this->aditional .= " ".$aditional;
		$from_array = $this->from_array;
		
		
		
		if ( $this->name  == "grupo_cliente" ){
			echo  $this->name ."-".$this->selected_value;
			echo "get".ucfirst($this->field_value);
			
		}
		
		print "<select id='$this->id' name='$this->name' $this->aditional >\n";		
		foreach( $this->options as $key => $option){
			$field_label_txt="";
			if ( $this->field_label != ""){
				if ( !$from_array){
					$field_label = "get".ucfirst($this->field_label);
					$field_label_txt = "label = '".$option->$field_label()."'";
				}
			}
			if ( !$from_array){
				$field_value = "get".ucfirst($this->field_value);
				$value = $option->$field_value();
				
				if ( $this->name  == "grupo_cliente" ){
					echo "$field_value , $value <br> ";
					
				}

				
			}else{
				if ( $this->field_value == "")
					$value = $key;//$option;
				else 
					$value = $option[$this->field_value];
			}
			
			if ( !$from_array){
				$field_description = "get".ucfirst($this->field_description);
				$description = $option->$field_description();
			}else{
				if ( $this->field_description == "" )
					$description = $option;
				else
					$description = $option[$this->field_description];
			}
						
			$selected="";
			echo " $value <br> ";
			if ( $value == $this->selected_value )
				$selected= 'selected="selected"';			
			print "\t<option value='".trim($value)."' $field_label_txt $selected> ".trim($description)." </option>\n";
		}
		print "  </select>\n";
	}
	/**
	 * @return the $selected_value
	 */
	public function getSelected_value() {
		return $this->selected_value;
	}

	/**
	 * @param field_type $selected_value
	 */
	public function setSelected_value($selected_value) {
		$this->selected_value = $selected_value;
	}


	/**
	 * retorna el valor de la variable: from_array 
	 * @return boolean
	 */
	public function getIs_array() {
		return $this->from_array;
	}
	

	/**
	 * asigna el valor para la variable : from_array 
	 * @param boolean $is_array
	 */
	public function setIs_array($is_array) {
		$this->from_array = $is_array;
	}
	
	
		
}

?>