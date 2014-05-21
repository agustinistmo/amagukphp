<?php
/**
 * 
 * Interface Amaguk Data Bean
 * @author agustin corona jimenez http://amagukmx.wordpress.com/
 * @since 2011
 *
 */
interface IAmaguk_databean{
	
	/**
	 * 
	 * Asignar los valores del arreglo $arreglo a los atributos de la clase
	 * @param array $arreglo
	 */
	public function _setValues( $arreglo );
	
	/**
	 * 
	 * Devuelve en un arreglo los valores de los atributos de la clase
	 */
	public function _getValues( );
	
	/**
	 * 
	 * limpia el valor de los atributos de la clase
	 */
	public function _clear( );
	
}
?>