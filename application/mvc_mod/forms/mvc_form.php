<?php
require_once 'lib/amaguk/utils/Amaguk_html_form.php';


class mvc_form extends Amaguk_html_form{
	public $bean;
	
	public function  __construct(){
		parent::__construct();
		$this->bean= new mvc_databean();
		$this->setName('mvc_form');
	}
	
	public function printForm(){
		if ($this->showForm)
			require_once 'mvc_form.html.php';
 	}
}
?>