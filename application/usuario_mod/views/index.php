<ul class="breadcrumb">
		<li><a href="<?php print MGK_HOME?>/index.php">Inicio</a> <span class="divider">/</span></li>
		<li><a href="<?php print MGK_HOME?>/index.php/usuario/">usuario</a> <span class="divider">/</span></li>
		<li class="active">Formulario</li>
		</ul>
		
<?php if ($this->message_text!=""):?>
    <div class="alert <?php print $this->message_css;?>">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong><?php print $this->message_title;?> !</strong> <?php print $this->message_text;?>.
    </div>
<?php endif;?>

		<div id="form_content">
		<form class="form-horizontal" role="form" name="ind" id="ind" action="" method="post">
		<input type="hidden" id="form_name" name="form_name" value="dd" >
		<fieldset class="stylized"  >
		<legend>ID Usuario : [ <?php print $this->usuario->getUsuario_id();?> ] </legend>
		<input type="hidden" id="db_operacion" name="db_operacion" value="dd" >	
		
	    <div class="row">
   		<div class="col-lg-6">

			<input type="hidden" name="usuario_id" id="usuario_id" placeholder="Automático" readonly value="<?php print $this->usuario->getUsuario_id();?>" style="width: 300px"  >    			

			<div class="form-group">
			<label for="usuario_email" class="col-lg-4 control-label">E-mail </label>
			<div class="col-lg-8">
			<div class="form-control" readonly="readonly" style="width: 300px" ><?php print $this->usuario->getUsuario_email();?></div>
			</div>
			</div>
			
			<div class="form-group">
			<label for="nombre" class="col-lg-4 control-label">Nombre completo</label>
			<div class="col-lg-8">
			<input class="form-control" type="text" name="nombre" id="nombre" placeholder="Nombre completo" value="<?php print $this->usuario->getNombre();?>" style="width: 300px"  >
			</div>
			</div>
			

    	</div>

		<div class="col-lg-6">
		    
			<div class="form-group">
			<label for="usuario_password" class="col-lg-4 control-label">Password actual</label>
			<div class="col-lg-8">
			<input class="form-control" maxlength=45 type="password" name="usuario_password" id="usuario_password" value="" style="width: 300px" >
			</div>
			</div>
					    
			<div class="form-group">
			<label for="usuario_password_n" class="col-lg-4 control-label">Nuevo password</label>
			<div class="col-lg-8">
			<input class="form-control" maxlength=45 type="password" name="usuario_password_n" id="usuario_password_n" value="" style="width: 300px" >
			</div>
			</div>
			
			<div class="form-group">
			<label for="usuario_password_o" class="col-lg-4 control-label">Confirmar password</label>
			<div class="col-lg-8">
			<input class="form-control" maxlength=45 type="password" name="usuario_password_o" id="usuario_password_o" value="" style="width: 300px" >
			</div>
			</div>
    
		    </div>
    </div>	
	
	
</fieldset>
				
 <div class="form-group">
<div class="controls">
<input class='btn btn-primary' type="submit" value="Enviar"/>				
<input  class='btn btn-inverse' type="reset" value="Restablecer">
</div>
</div>
</form>
</div>