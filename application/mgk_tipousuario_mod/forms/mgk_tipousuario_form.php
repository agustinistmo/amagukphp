<?php
require_once 'lib/amaguk/utils/Amaguk_html_form.php';

/** 
 * AMAGUK_GCA_VERSION: 
 * @author http://amagukmx.wordpress.com/
 *
 */
class mgk_tipousuario_form extends Amaguk_html_form{
	public $data;
	
	public function  __construct(){
		parent::__construct();
		$this->data= new mgk_tipousuario_databean();
		$this->setName('mgk_tipousuario_form');
	}
	
	public function printForm(){
		if ($this->showForm)
			require_once 'mgk_tipousuario_form.html.php';
 	}
}
?>