<?php
/**
 * Funciones genericas
 * @author agustin corona jimenez http://amagukmx.wordpress.com/
 * @version 0.4.0 2014-01-29 se agrega la función addTime para sumar horas
 * @-version 0.3.2 2013-12-19
 * @-version 0.3.1 2013-12-17 
 *
 */
class Amaguk_functions {
	
	/**
	 * 
	 * @var Amaguk_properties
	 */
	public $mgkProperties;
	
	public function dateDisToDb($date){
		if ( strlen($date)<10)
			return $date;		
		$date= substr($date,6,4)."-".substr($date,3,2)."-".substr($date,0,2);
		return $date; 		
	}
	
	public function dateDbToDis($date,$separator=""){
		if ( $separator == "")
			$separator="-";
		if ( strlen($date)<10)
			return $date;
		$date= substr($date,8,2).$separator.substr($date,5,2).$separator.substr($date,0,4);
		return $date; 		
	}
	
	/**
	 * Devuelve la marca de tiempo Unix correspondiente a la fecha dada 
	 * @param String $date fecha en formato yyyy-mm-dd
	 * @return int mktime
	 * @since version 0.3.2
	 */
	public function mktimeFromDateDb($date){
		if ( strlen($date)<10)
			return $date;			
		return mktime(0,0,0, substr($date,5,2) , substr($date,8,2) , substr($date,0,4) );
	}
	
	
	// removes files and non-empty directories
	function rrmdir($dir) {
	  if (is_dir($dir)) {
	    $files = scandir($dir);
	    foreach ($files as $file)
	    if ($file != "." && $file != "..") $this->rrmdir("$dir/$file");
	    rmdir($dir);
	  }
	  else if (file_exists($dir)) unlink($dir);
	} 

	// copies files and non-empty directories
	function rcopy($src, $dst) {
	  if (file_exists($dst)) $this->rrmdir($dst);
	  if (is_dir($src)) {
	    mkdir($dst);
	    $files = scandir($src);
	    foreach ($files as $file)
	    if ($file != "." && $file != "..") $this->rcopy("$src/$file", "$dst/$file"); 
	  }
	  else if (file_exists($src)) copy($src, $dst);
	}

	public function write_file($path, $name,$content,$mode="w+") {
		// TODO Auto-generated method stub
		$fp = fopen($path."/".$name,$mode);		
		if($fp){
			fwrite($fp, $content);
			fclose($fp);
			return true;
		}
		return false;
	}
	function eliminar_acentos($str){
		$a = array('Ã€','Ã�','Ã‚','Ãƒ','Ã„','Ã…','Ã†','Ã‡','Ãˆ','Ã‰','ÃŠ','Ã‹','ÃŒ','Ã�','ÃŽ','Ã�','Ã�','Ã‘','Ã’','Ã“','Ã”','Ã•','Ã–','Ã˜','Ã™','Ãš','Ã›','Ãœ','Ã�','ÃŸ','Ã ','Ã¡','Ã¢','Ã£','Ã¤','Ã¥','Ã¦','Ã§','Ã¨','Ã©','Ãª','Ã«','Ã¬','Ã­','Ã®','Ã¯','Ã±','Ã²','Ã³','Ã´','Ãµ','Ã¶','Ã¸','Ã¹','Ãº','ï¿½Â»','Ã¼','Ã½','Ã¿','Ä€','Ä�','Ä‚','Äƒ','Ä„','Ä…','Ä†','Ä‡','Äˆ','Ä‰','ÄŠ','Ä‹','ÄŒ','Ä�','ÄŽ','Ä�','Ä�','Ä‘','Ä’','Ä“','Ä”','Ä•','Ä–','Ä—','Ä˜','Ä™','Äš','Ä›','Äœ','Ä�','Äž','ÄŸ','Ä ','Ä¡','Ä¢','Ä£','Ä¤','Ä¥','Ä¦','Ä§','Ä¨','Ä©','Äª','Ä«','Ä¬','Ä­','Ä®','Ä¯','Ä°','Ä±','Ä²','Ä³','Ä´','Äµ','Ä¶','Ä·','Ä¹','Äº','ï¿½Â»','Ä¼','Ä½','Ä¾','Ä¿','Å€','Å�','Å‚','Åƒ','Å„','Å…','Å†','Å‡','Åˆ','Å‰','ÅŒ','Å�','ÅŽ','Å�','Å�','Å‘','Å’','Å“','Å”','Å•','Å–','Å—','Å˜','Å™','Åš','Å›','Åœ','Å�','Åž','ÅŸ','Å ','Å¡','Å¢','Å£','Å¤','Å¥','Å¦','Å§','Å¨','Å©','Åª','Å«','Å¬','Å­','Å®','Å¯','Å°','Å±','Å²','Å³','Å´','Åµ','Å¶','Å·','Å¸','Å¹','Åº','ï¿½Â»','Å¼','Å½','Å¾','Å¿','Æ’','Æ ','Æ¡','Æ¯','Æ°','Çº','ï¿½Â»','Ç¼','Ç½','Ç¾','Ç¿');
		$b = array('A','A','A','A','A','A','AE','C','E','E','E','E','I','I','I','I','D','N','O','O','O','O','O','O','U','U','U','U','Y','s','a','a','a','a','a','a','ae','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y','A','a','A','a','A','a','C','c','C','c','C','c','C','c','D','d','D','d','E','e','E','e','E','e','E','e','E','e','G','g','G','g','G','g','G','g','H','h','H','h','I','i','I','i','I','i','I','i','I','i','IJ','ij','J','j','K','k','L','l','L','l','L','l','L','l','l','l','N','n','N','n','N','n','n','O','o','O','o','O','o','OE','oe','R','r','R','r','R','r','S','s','S','s','S','s','S','s','T','t','T','t','T','t','U','u','U','u','U','u','U','u','U','u','U','u','W','w','Y','y','Y','Z','z','Z','z','Z','z','s','f','O','o','U','u','A','a','I','i','O','o','U','u','A','a','AE','ae','O','o');
		return str_replace($a, $b, $str);
	}
	
	public function arrayToObject($array){
		$object = new stdClass();
		foreach ($array as $key => $value)
			$object->$key = $value;
		return $object;
	}
	
	public function arrayToTableHtml($array, $opcional = ""){
		$border="";
		if ( $opcional == "" )
			$border =" border='1' ";
		$html="<table $border $opcional >\n";
		
		if ($array!=null)
		foreach ($array as $fila){
			$html.="\t<tr>\n";
			foreach ($fila as $name=>$value){
				$html.="\t\t<th>$name</th>\n";
			}
			$html.="\t</tr>\n";
			break;
		}
		if ($array!=null)
		foreach ($array as $fila){
			$html.="\t<tr>\n";
			foreach ($fila as $dato)
				$html.="\t\t<td>".( (trim($dato)=="")?"&nbsp":$dato )."</td>\n";
			$html.="\t</tr>\n";
		}
		$html.="</table>\n";
		return $html;
	}	
	
	public function dir_if_not_exists_array( $arreglo ) {
		$d = "";
		foreach( $arreglo as $k => $v ){
			$d.=$v."";
			if ( !file_exists( $d ) )
				mkdir( $d );
		}
		return $d;
	}
	
	/**
	 * 
	 * @param time hh:mm:ss $time1
	 * @param time hh:mm:ss $time2
	 * @return time hh:mm:ss
	 */
	public function addTime($time1, $time2){		
		$hh=0;
		$mm=0;
		$ss=0;
		
		try{
			$items1 = explode(":",$time1);
			$items2 = explode(":",$time2);
			if ( count($items1) < 3 || count($items2) < 3)			
				return "$hh:$mm:$ss";
			
			if ( $items1[1] > 60 ) $items1[1] = 60;			
			if ( $items1[1] <  0 ) $items1[1] = 0;
			if ( $items1[2] > 60 ) $items1[2] = 60;
			if ( $items1[2] <  0 ) $items1[2] = 0;
			
			if ( $items2[1] > 60 ) $items2[1] = 60;
			if ( $items2[1] <  0 ) $items2[1] = 0;
			if ( $items2[2] > 60 ) $items2[2] = 60;
			if ( $items2[2] <  0 ) $items2[2] = 0;
			
			$ss = $items1[2] + $items2[2] ;
			if ( $ss >= 60 ){
				$mm++;
				$ss -= 60;
			}			
			$mm += $items1[1] + $items2[1] ;			
			if ( $mm >= 60 ){
				$hh++;
				$mm -= 60;
			}
			$hh = $items1[0] + $items2[0] ;			
		}catch(Exception $e){
		}
		
		return "$hh:$mm:$ss";
	}
	
	public function is_in_simple_array($valor,$arreglo){
		foreach ($arreglo as $item ){
			if ($valor == $item )
				return true;
		}
		return false;
	}
	

	/**
	 * Busca los elementos del arreglo1 dentro del arreglo2 si encuentra alguno retorna TRUE
	 * @param array $arreglo1 arreglo simple para buscar
	 * @param array $arreglo2 arreglo simple donde sera buscado
	 * @return boolean
	 */
	public function array_in_array( $arreglo1 , $arreglo2 ){
		foreach ($arreglo2 as $a2 ){
			foreach ( $arreglo1 as $a1){
				if ($a1 == $a2 )
					return true;
			}
		}
		return false;
	}	
	
	/**
	 * Devuelve la fecha actual con el formato en _properties.php : mgk_date_format
	 * @return string date
	 */
	public function getCurrent_date(){
		return date( $this->mgkProperties->values["mgk_date_format"] );
	}
	
	/**
	 * Devuelve la fecha actual con el formato en _properties.php : mgk_time_format
	 * @return string time
	 */
	public function getCurrent_time(){
		if( $this->mgkProperties == 0 )
			$this->mgkProperties= new Amaguk_properties();
		//mgk_datetime_format
		//return date( $this->mgkProperties->values["mgk_time_format"] );
		
		return date("Y-m-d H:i:s");
	}	
	
	/**
	 * Devuelve la fecha actual con el formato en _properties.php : mgk_datetime_format
	 * @return string datetime
	 */
	public function getCurrent_datetime($mgk_datetime_format = ""){
		if( $this->mgkProperties == 0 )
			$this->mgkProperties= new Amaguk_properties();
		if ( $mgk_datetime_format == "")
			return date( $this->mgkProperties->values["mgk_datetime_format"] );
		else
			return date( $mgk_datetime_format );
	}

	/**
	 * Las llaves que existen en $target las toma de $source, si $create es TRUE, agrega las nuevas llaves de $source
	 * @param array $target
	 * @param array $source
	 * @param boolean $create
	 * @return array
	 */
	public function setValues( $target, $source ,$create = false ){
		foreach ($source as $k => $v ){
			if ( $create || array_key_exists( $k , $target) ){
				$target[$k] = $v;
			}
		}
		return $target;				
	}
	

	/**
	 * 
	 * @param unknown_type $array
	 * @return string
	 */
	public function utf8_encode_array( $array ){
		$in="UTF-16";
		$out="UTF-8";
		foreach ( $array as $k => $v )
			$array[$k] = utf8_encode( $array[$k] );
		return $array;
	}

	/**
	 * 
	 * @param string $num
	 * @return number
	 */
	public function numeric_sap($num){
		$num = trim( $num );
		$numero = $num;
		$pos = strpos($num, "-");
		if ( $pos !== false )
			$numero = "-".str_replace("-", "", $num);		 
		return $numero;
	}
	
}





?>