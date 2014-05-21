<?php print $this->view->saludos;?>
<h3>Este es el index de mgk_historiaacceso </h3><div id="nav_bar">
	<a href="<?php print URL_HOME?>/index.php/mgk_historiaacceso/lista">Lista</a> |
	<a href="<?php print URL_HOME?>/index.php/mgk_historiaacceso/form">Nuevo</a>
</div>

		<?php if ($this->mensaje!=""):?>
		    <div class="alert <?php print $this->css_mensaje;?>">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
		    <strong><?php print $this->tipo_mensaje;?> !</strong> <?php print $this->mensaje;?>.
		    </div>
		<?php endif;?>
		
		
