<?php
require_once 'lib/amaguk/utils/Amaguk_html_form.php';


class usuario_form extends Amaguk_html_form{
	public $bean;
	
	public function  __construct(){
		parent::__construct();
		$this->bean= new usuario_databean();
		$this->setName('usuario_form');
	}
	
	public function printForm(){
		if ($this->showForm)
			require_once 'usuario_form.html.php';
 	}
}
?>