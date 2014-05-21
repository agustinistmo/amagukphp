<ul class="nav nav-tabs">
  <li><a href="<?php print MGK_HOME?>/index.php/usuario/lista">Listado</a></li>
  <li class="active"><a href="<?php print MGK_HOME?>/index.php/usuario/form">Captura</a></li>
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
			<label for="usuario_id" class="col-lg-2 control-label">ID </label>
			<div class="col-lg-10">
			<input class="form-control" type="text" name="usuario_id" id="usuario_id" placeholder="Automático" readonly value="<?php print $this->bean->getUsuario_id();?>" style="width: 300px"  >
			</div>
			</div>

			<div class="form-group">
			<label for="usuario_email" class="col-lg-2 control-label">E-mail </label>
			<div class="col-lg-10">
			<input class="form-control" type="text" name="usuario_email" id="usuario_email" placeholder="Correo electrónico" value="<?php print $this->bean->getUsuario_email();?>" style="width: 300px"  >
			</div>
			</div>

			<div class="form-group">
			<label for="usuario_password" class="col-lg-2 control-label">Password </label>
			<div class="col-lg-10">
			<input class="form-control" type="password" name="usuario_password" id="usuario_password" placeholder="Password" value="" style="width: 300px"  >
			</div>
			</div>
			
			<div class="form-group">
			<label for="usuario_password" class="col-lg-2 control-label">Confirmar password</label>
			<div class="col-lg-10">
			<input class="form-control" type="password" name="usuario_password_o" id="usuario_password_o" placeholder="Confirmar password" value="" style="width: 300px"  >
			</div>
			</div>			

			<div class="form-group">
			<label for="tipo_usuario_id" class="col-lg-2 control-label">Tipo de usuario </label>
			<div class="col-lg-10">
			<input class="form-control" type="text" name="tipo_usuario_id" id="tipo_usuario_id" placeholder="tipo" value="<?php print $this->bean->getTipo_usuario_id();?>" style="width: 300px"  >
			</div>
			</div>

			
			<div class="form-group">
			<label for="nombre" class="col-lg-2 control-label">Nombre completo</label>
			<div class="col-lg-10">
			<input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php print $this->bean->getNombre();?>" style="width: 300px"  >
			</div>
			</div>
			
			<div class="form-group">
			<label for="nombre" class="col-lg-2 control-label">Comentarios </label>
			<div class="col-lg-10">
			<textarea class="form-control" placeholder="Opcional" rows="3" style="width: 300px"></textarea>			
			</div>
			</div>
			
			<div class="form-group">
			<label for="nombre" class="col-lg-2 control-label">Notificar</label>
			<div class="col-lg-10">
		        <label class="checkbox">
		          <input type="checkbox" value="1" name="enviar_correo" id="enviar_correo" > Enviar correo electrónico al usuario 
		        </label>
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
