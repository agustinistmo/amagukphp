<?php

require_once('lib/amaguk/framework/IAmaguk_databean.php');


/**
 * 
 * Enter description here ...
 * Amaguk PHP Framework. Data Bean
 * @author agustin corona jimenez http://amagukmx.wordpress.com/
 * @since 2011
 *
 */
abstract class Amaguk_databean implements IAmaguk_databean {
	
	public function _setValues( $arreglo){
		foreach ( $arreglo as $key => $dato){
				if ( property_exists($this,$key)){
					//echo ""; 
					$method_name = "set".ucfirst($key);
					if (method_exists($this, $method_name))
						$this->$method_name( $dato ) ;
				}
		}
	}
	
	public function _getValues(  ){
		$class_vars = get_class_vars ( get_class ( $this ) );
		$class_methods = get_class_methods( get_class ( $this ) );		

		$values=array();
		foreach ( $class_methods as $name => $value ){			
			$pos = strrpos($value, "get");
			if ($pos === 0){
				$v=substr($value,3);
				if (ord($v[0]) >= 65 && ord($v[0]) <=90 )
					$v[0]=chr(ord($v[0])+32);
				$values[$v]=$this->$value();
			}
		}
		return $values;
	}
	
	public function _clear(  ){
		$class_vars = get_class_vars ( get_class ( $this ) );
		$class_methods = get_class_methods( get_class ( $this ) );
		foreach ( $class_methods as $name  ){
			if (strlen($name) >3)
				if ( substr($name, 0,3 ) == "set" ){
					$this->$name("");
			}
		}
	}
	
	public function _boolean( $key ){
		if ( property_exists($this,$key)){
			//echo "";
			$method_name = "get".ucfirst($key);
			if (method_exists($this, $method_name)){
				$dato = $this->$method_name( ) ;
				$method_name = "set".ucfirst($key);
				if ( $dato == "" )
					$dato='0';
				$this->$method_name( $dato ) ;
			}
		}
	}
	
}