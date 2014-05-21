<link href="<?php print MGK_HOME?>/public/bootstrap3/css/signin.css" rel="stylesheet">

<?php if (!$this->session->is_login()):?>
<script src="<?php print MGK_HOME?>/public/js/md5.js"></script>
<script >
function send(){
	document.acceso.usuario_email.value = calcMD5(document.acceso.usuario_email_x.value);
	document.acceso.usuario_password.value = calcMD5(document.acceso.usuario_password_x.value);
	
	document.acceso.usuario_password_x.value = "";
	document.acceso.usuario_password_x.value="";
	if ( document.acceso.ubicacion.checked == true && document.getElementById("latitud").value=="" )
		requestPosition();
	else{
		document.getElementById("latitud").value="";
		document.getElementById("longitud").value="";	
		document.acceso.submit();
	}	
}

function recuperar(){
	document.location="<?php print MGK_HOME?>/index.php/usuario/recuperar_acceso";
}

function enter(e){
	if (e.keyCode == 13)
		send();
}


</script>

<script type="text/javascript">

    var nav = null; 

    function requestPosition() {
        if (nav == null) {
            nav = window.navigator;
        }

        var geoloc = nav.geolocation;
        if (geoloc != null) {
            geoloc.getCurrentPosition(successCallback, errorCallback);
        }

    }

    function successCallback(position) {
        document.getElementById("latitud").value = position.coords.latitude;
        document.getElementById("longitud").value = position.coords.longitude;        
        document.acceso.submit();
    }

    function errorCallback(error) {
        var strMessage = "";

        // Check for known errors
        switch (error.code) {
            case error.PERMISSION_DENIED:
                strMessage = "Access to your location is turned off. "  +
                    "Change your settings to turn it back on.";
                break;
            case error.POSITION_UNAVAILABLE:
                strMessage = "Data from location services is " + 
                    "currently unavailable.";
                break;
            case error.TIMEOUT:
                strMessage = "Location could not be determined " +
                    "within a specified timeout period.";
                break;
            default:
                break;
        }

        document.getElementById("status").innerHTML = strMessage;
    }

</script>

      <form class="form-signin" method="post" name="acceso" autocomplete="off">
        <h2 class="form-signin-heading"><?php $this->mgkLang->L("login.acceso");?></h2>
        <input type="text" class="form-control" placeholder="No empleado" required autofocus name="usuario_email_x" value="<?php print $this->usuario_databean->getUsuario_email();?>">
        <input type="password" class="form-control" placeholder="Password" required name="usuario_password_x" onkeypress="enter(event)">
        <button class="btn btn-lg btn-primary btn-block" type="button" onclick="send()" >Entrar</button>
        <button class="btn btn-lg btn-block" type="button" onclick="recuperar()">Recuperar contraseña</button>
        
        <input type="hidden" name="usuario_email">
        <input type="hidden" name="usuario_password">        
        <input type="hidden" name="latitud" id="latitud" value="<?php print $this->usuario_databean->getLatitud();?>">
        <input type="hidden" name="longitud" id="longitud" value="<?php print $this->usuario_databean->getLongitud();?>">
        <label class="checkbox">
          <input type="checkbox" value="1" name="ubicacion" id="ubicacion" > Permitir ubicación geográfica
        </label>
        
      </form>
	  
        <div class="alert alert-warning">
		user: <strong>admin@localhost </strong><br/>
		password: <strong>admin</strong><br>
		<br>
		modificar: <i><?php print MGK_HOME?>/usuario_mod/views/acceso.php</i>
		</div>	 	  

<?php else:?>
<script>
document.location="<?php print MGK_HOME?>/index.php"
</script>
Sesion iniciada<br/>
<a href="<?php print MGK_HOME?>/index.php/usuario/salir">Salir</a>
<?php endif;?>