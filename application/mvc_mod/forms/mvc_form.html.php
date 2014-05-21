
<ul class="nav nav-tabs">
  <li><a href="<?php print MGK_HOME?>/index.php/mvc/lista">Listado</a></li>
  <li class="active"><a href="<?php print MGK_HOME?>/index.php/mvc/form">Captura</a></li>
</ul>
	
<?php if ($this->message_text!=""):?>
	<div class="alert <?php print $this->message_css;?>">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong><?php print $this->message_title;?> !</strong> <?php print $this->message_text;?>.
	</div>
<?php endif;?>
	
<div id="div_<?php print $this->getName();?>">
		<form class="form-horizontal" role="form" name="<?php print $this->getName();?>" id="<?php print $this->getName();?>" action="" method="<?php print $this->getMethod();?>">
		<input type="hidden" id="form_name" name="form_name" value="<?php print $this->getName();?>" >
		<input type="hidden" id="db_operacion" name="db_operacion" value="<?php print $this->getDb_operacion();?>" >
		<fieldset>		
		

			<div class="form-group">
			<label for="historia_id" class="col-lg-2 control-label">Historia_id *</label>
			<div class="col-lg-10">
			<input maxlength="10" class="form-control" type="text" name="historia_id" id="historia_id" placeholder="Historia_id" value="<?php print $this->bean->getHistoria_id();?>" style="width: 120px"  >
			</div>
			</div>

			<div class="form-group">
			<label for="usuario_id" class="col-lg-2 control-label">Usuario_id *</label>
			<div class="col-lg-10">
			<input maxlength="10" class="form-control" type="text" name="usuario_id" id="usuario_id" placeholder="Usuario_id" value="<?php print $this->bean->getUsuario_id();?>" style="width: 120px"  >
			</div>
			</div>

			<div class="form-group">
			<label for="fecha_inicio" class="col-lg-2 control-label">Fecha_inicio *</label>
			<div class="col-lg-10">
			<input maxlength="19" class="form-control" type="text" name="fecha_inicio" id="fecha_inicio" placeholder="Fecha_inicio" value="<?php print $this->bean->getFecha_inicio();?>" style="width: 228px"  >
			</div>
			</div>

			<div class="form-group">
			<label for="fecha_salida" class="col-lg-2 control-label">Fecha_salida </label>
			<div class="col-lg-10">
			<input maxlength="19" class="form-control" type="text" name="fecha_salida" id="fecha_salida" placeholder="Fecha_salida" value="<?php print $this->bean->getFecha_salida();?>" style="width: 228px"  >
			</div>
			</div>

			<div class="form-group">
			<label for="direccion_id" class="col-lg-2 control-label">Direccion_id *</label>
			<div class="col-lg-10">
			<input maxlength="5" class="form-control" type="text" name="direccion_id" id="direccion_id" placeholder="Direccion_id" value="<?php print $this->bean->getDireccion_id();?>" style="width: 60px"  >
			</div>
			</div>

			<div class="form-group">
			<label for="latitud" class="col-lg-2 control-label">Latitud </label>
			<div class="col-lg-10">
			<input maxlength="6" class="form-control" type="text" name="latitud" id="latitud" placeholder="Latitud" value="<?php print $this->bean->getLatitud();?>" style="width: 72px"  >
			</div>
			</div>

			<div class="form-group">
			<label for="longitud" class="col-lg-2 control-label">Longitud </label>
			<div class="col-lg-10">
			<input maxlength="6" class="form-control" type="text" name="longitud" id="longitud" placeholder="Longitud" value="<?php print $this->bean->getLongitud();?>" style="width: 72px"  >
			</div>
			</div>
	
			</fieldset>			

		  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      * Requerido
    </div>
  </div>
		<div class="form-group">
	    <div class="col-lg-offset-2 col-lg-10">
				<input class='btn btn-primary' type="submit" value="Enviar"/>
				<input  class='btn btn-inverse' type="reset" value="Restablecer">
	    </div>
		</div>  
	</form>
</div>
