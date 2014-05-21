<?php
require_once 'lib/amaguk/utils/Amaguk_html_form.php';


class demo_form extends Amaguk_html_form{
	public $bean;
	
	public function  __construct(){
		parent::__construct();
		$this->bean= new demo_databean();
		$this->setName('demo_form');
	}
	
	public function printForm(){
		if ($this->showForm)
			require_once 'demo_form.html.php';
 	}
}
?>