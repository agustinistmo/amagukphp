<?php
/**
 * Propiedades del sistema
 * @author agustinistmo@gmail.com
 *
 */
class Amaguk_properties {
	
	/**
	 * 
	 * @var array
	 */
	public $values;	
	public $obj;
	
	public function __construct(){						
		$this->values["mgk_db_driver"] = Amaguk_database_connection::DB_DRIVER_MYSQL;
		$this->values["mgk_db_active"] = false;
		$this->read_properties();
		$this->mgk_ambiente="";
	}
	
	private function read_properties(){
		$file_properties = MGK_PROJECT_REAL_PATH .'/_config/_properties.php';
		if ( file_exists( $file_properties )){
			$f = fopen ($file_properties, "r");
			$ln= 0;
			while ($line= fgets ($f)) {
				$pos = stripos($line,"=");
				if ( $pos !== false ){
					$key =trim(substr($line,0,$pos));
					$value = trim(substr($line,$pos+1));
					
					if ( $key == "mgk_ambiente" )
						$this->mgk_ambiente = $value;
					if ( $this->mgk_ambiente == "" )				
						$this->values[$key] = $value ;
					else
						$this->porAmbiente($key,$value);
				}
			}
			fclose ($f);
		}
		$this->obj = (object) $this->values;
	}
	
	public function getValue($key){
		return $this->values[$key];
	}
	
	private function porAmbiente($key,$value){
		$arr = explode(".",$key);
		if ( $arr[0] == $this->mgk_ambiente )
			$this->values[$arr[1]]=$value;		
	}
}
?>