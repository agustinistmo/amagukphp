<?php
$search = array(
	"#contenido#",
	"#home#",
	"../../..",

	);
	
	
$replace = array(
	'<?php  $this->content(); ?>',
	MGK_HOME,
	MGK_HOME,
); 
?>