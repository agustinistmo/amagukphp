<?php	
//	require_once 'templates/amaguk/final/bootstrap3.php'
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="<?php print MGK_HOME?>/public/ico/favicon.png">
    <title>DEMO Amaguk PHP Framework</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php print MGK_HOME?>/public/bootstrap3/css/bootstrap.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="<?php print MGK_HOME?>/public/bootstrap3/css/navbar-fixed-top.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="<?php print MGK_HOME?>/docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
 </head>
  <body>
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php print MGK_HOME?>/index.php">DEMO Amaguk Php</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li id="index_ctrl"><a href="<?php print MGK_HOME?>/index.php">Inicio</a></li>
            <li id="demo_ctrl" class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Demostración <b class="caret"></b></a>
              <ul class="dropdown-menu">
				<li ><a href="<?php print MGK_HOME?>/index.php/demo/plantilla_inactiva">Plantilla Inactiva</a></li>
				<li ><a href="<?php print MGK_HOME?>/index.php/demo/plantilla_basica">Plantilla básica</a></li>
				<li ><a href="<?php print MGK_HOME?>/index.php/demo/plantilla_bootstrap">Plantilla bootstrap</a></li>
				<li ><a href="<?php print MGK_HOME?>/index.php/demo/sin_vista">Sin archivo vista</a></li>
				<li ><a href="<?php print MGK_HOME?>/index.php/demo/json">Sin plantilla, sin vista</a></li>
				<li class="divider"></li>              
                <li ><a href="<?php print MGK_HOME?>/index.php/demo/lang">Manejo de idioma</a></li>
				<li ><a href="<?php print MGK_HOME?>/index.php/demo/mapa">Mapa de google</a></li>
				<li class="divider"></li>
				<li ><a href="<?php print MGK_HOME?>/index.php/demo/configuracion_db">Configuración base de datos</a></li>
				<li ><a href="<?php print MGK_HOME?>/index.php/demo/consulta">MySQL Manual</a></li>
                <li ><a href="<?php print MGK_HOME?>/index.php/demo">MVC php + mysql </a></li>
              </ul>
            </li>
            
                        
			<li id="index_ctrl"><a target="_blank" href="http://amagukmx.wordpress.com/">Contacto</a></li>            
			<li id="index_ctrl"><a href="<?php print MGK_HOME?>/index.php/demo/acercade">Acerca de</a></li>
          </ul>
          
          <ul class="nav navbar-nav navbar-right">
            <?php if ($this->session->usuario != null ) :?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <span class="glyphicon glyphicon-user"></span> <?php print $this->session->usuario->getUsuario_email()?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php print MGK_HOME?>/index.php/usuario"><span class="glyphicon glyphicon-user"></span> Perfil</a></li>
                <li><a href="<?php print MGK_HOME?>/index.php/usuario/salir"><span class="glyphicon glyphicon-off"></span> Salir</a></li>
                <li class="divider"></li>
				<li><a href="<?php print MGK_HOME?>/index.php/"><span class="glyphicon glyphicon-off"></span> Inicio</a></li>
              </ul>
            </li>
            <?php endif;?>
          </ul>
          
        </div><!--/.nav-collapse -->
      </div>
    </div>

	<div class="container">
			<ol class="breadcrumb">
			  <li ><a href="<?php print MGK_HOME?>/index.php/<?php print $this->controller;?>/"><?php print $this->getController_title();?></a></li>
			  <li ><strong><a href="<?php print MGK_HOME?>/index.php/<?php print $this->controller;?>/<?php print $this->action;?>"><?php print $this->getAction_title();?></a></strong></li>
			</ol>	
		<?php  $this->content(); ?>
		
	</div>
	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php print MGK_HOME?>/public/bootstrap3/js/bootstrap.min.js"></script>
    <script>
    $(function() {
    	$( "#<?php print $this->action;?>_action" ).addClass( "active" );
    	$( "#<?php print $this->controller;?>_ctrl" ).addClass( "active" );
    	$( "#<?php print $this->controller;?>_ctrl_<?php print $this->action;?>_action" ).addClass( "active" );
    });    
    </script>
  </body>
</html>
<?php	//$this->replace_layout("amaguk","amaguk"); ?>