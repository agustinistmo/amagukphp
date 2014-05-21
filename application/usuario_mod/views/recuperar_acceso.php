<link href="<?php print MGK_HOME?>/public/bootstrap3/css/signin.css" rel="stylesheet">
    
<?php if (!$this->session->is_login()):?>
<script  >
function send(){
	document.acceso.submit();	
}

function entrar(){
	document.location="<?php print MGK_HOME?>/index.php/usuario/acceso";	
}

</script>

<?php if ($this->message_text!=""):?>
    <div class="alert <?php print $this->message_css;?>">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong><?php print $this->message_title;?> </strong> <?php print $this->message_text;?>.
    </div>
<?php endif;?>
    
      <form class="form-signin" method="post" name="acceso" autocomplete="off">
        <h2 class="form-signin-heading">Recuperar acceso</h2>
        <input type="email" name="usuario_email" class="form-control" placeholder="Dirección e-mail" value="<?php print $this->myProperties->email;?>">
        <button class="btn btn-lg btn-primary btn-block" type="button" onclick="send()">Enviar</button>
		<button class="btn btn-lg btn-block" type="button" onclick="entrar()">Entrar</button>        
      </form>
  
	

<?php else:?>
Sesion iniciada<br/>
<a href="<?php print URL_HOME?>/index.php/acceso/salir">Salir*</a>
<?php endif;?>