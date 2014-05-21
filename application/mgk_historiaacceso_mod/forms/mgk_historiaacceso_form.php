<?php
require_once 'lib/amaguk/framework/clase_base/amaguk_form.php';


class mgk_historiaacceso_form extends amaguk_form{
	public $bean;
	
	public function  __construct(){
		parent::__construct();
		$this->bean= new mgk_historiaacceso_databean();
		$this->setName('mgk_historiaacceso_form');
	}
	
	public function printForm(){
		if ($this->showForm)
			require_once 'mgk_historiaacceso_form.phtml';
 	}
}
?>