
<ul class="nav nav-tabs">
  <li><a href="<?php print MGK_HOME?>/index.php/mgk_tipousuario/lista">Listado</a></li>
  <li class="active"><a href="<?php print MGK_HOME?>/index.php/mgk_tipousuario/form">Captura</a></li>
</ul>
	
<?php if ($this->message_text!=""):?>
	<div class="alert <?php print $this->message_css;?>">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong><?php print $this->message_title;?> !</strong> <?php print $this->message_text;?>.
	</div>
<?php endif;?>
	
<div id="div_<?php print $this->getName();?>" class="mgk_form">
		<form class="form-horizontal" role="form" name="<?php print $this->getName();?>" id="<?php print $this->getName();?>" action="" method="<?php print $this->getMethod();?>">
		<input type="hidden" id="form_name" name="form_name" value="<?php print $this->getName();?>" >
		<input type="hidden" id="db_operacion" name="db_operacion" value="<?php print $this->getDb_operacion();?>" >
		<fieldset>		
		

			<div class="form-group">
			<label for="tipo_usuario_id" class="col-lg-2 control-label">Tipo_usuario_id </label>
			<div class="col-lg-10">
			<input class="form-control" type="text" name="tipo_usuario_id" id="tipo_usuario_id" placeholder="Tipo_usuario_id" value="<?php print $this->data->getTipo_usuario_id();?>" style="width: 300px"  >
			</div>
			</div>

			<div class="form-group">
			<label for="tipo_usuario_nombre" class="col-lg-2 control-label">Tipo_usuario_nombre </label>
			<div class="col-lg-10">
			<input class="form-control" type="text" name="tipo_usuario_nombre" id="tipo_usuario_nombre" placeholder="Tipo_usuario_nombre" value="<?php print $this->data->getTipo_usuario_nombre();?>" style="width: 300px"  >
			</div>
			</div>

			<div class="form-group">
			<label for="descripcion" class="col-lg-2 control-label">Descripcion </label>
			<div class="col-lg-10">
			<input class="form-control" type="text" name="descripcion" id="descripcion" placeholder="Descripcion" value="<?php print $this->data->getDescripcion();?>" style="width: 300px"  >
			</div>
			</div>
	
			</fieldset>			

		
		<div class="form-group">
	    <div class="col-lg-offset-2 col-lg-10">
				<input class='btn btn-primary' type="submit" value="Enviar"/>
				<input  class='btn btn-inverse' type="reset" value="Restablecer">
	    </div>
		</div>  
	</form>
</div>
