<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="es">

<head>
<title>Plantilla básica</title>
<style>
body{
	background-color:#313131;
	margin: 2px auto;
	width:920px;
	font-family:Arial;
	font-size:14px;
}

.div_contenedor{
	width:100%;
}

#div_encabezado{
	background-color:#cccfff;
	padding:2px;
	height:100px;
}

#div_cuerpo{
	background-color:#fff;
	padding:2px;
	min-height:400px;
	padding:7px;
}

#div_pie{
	background-color:#fffccc;
	padding:2px;
	height:40px;
}
	

</style>
</head>

<body >

<div class="div_contenedor">
	<div id="div_encabezado">
		<h3>Encabezado </h3>		
	</div>
	<div id="div_cuerpo">
	<?php  $this->content(); ?>
	</div>
	<div id="div_pie">
		Pie de página
	</div>
</div>


</body>
</html>