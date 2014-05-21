<script type="text/javascript">
function mvc_editar(ide){
	document.mvc_form_aux.action ="../mvc/form";
	document.mvc_form_aux.db_operacion.value ="edit";
	document.mvc_form_aux.historia_id.value = ide;
	document.mvc_form_aux.submit();
}

function mvc_eliminar( ide ){
	if (!confirm('Esta seguro que desea eliminar el registro?'))
		return;
	document.mvc_form_aux.db_operacion.value ="delete";
	document.mvc_form_aux.historia_id.value = ide;
	document.mvc_form_aux.submit();	
}
</script>

<ul class="nav nav-tabs">
  <li class="active"><a href="<?php print MGK_HOME?>/index.php/mvc/lista">Listado</a></li>
  <li><a href="<?php print MGK_HOME?>/index.php/mvc/form">Captura</a></li>
</ul>
<table width="90%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
	<thead>
  <tr>
	<th> historia_id </th> 
 	<th> usuario_id </th> 
 	<th> fecha_inicio </th> 
 	<th> fecha_salida </th> 
 	<th> direccion_id </th> 
 	<th> latitud </th> 
 	<th> longitud </th> 
 	<th> Editar </th> 
 	<th> Eliminar </th> 
 </tr>
  		</thead>
  		<tbody>
<?php foreach ( $this->view->items as $item ) :?>
  <tr>
	<td>  <?php print $item->getHistoria_id(); ?> </td> 
	<td>  <?php print $item->getUsuario_id(); ?> </td> 
	<td>  <?php print $item->getFecha_inicio(); ?> </td> 
	<td>  <?php print $item->getFecha_salida(); ?> </td> 
	<td>  <?php print $item->getDireccion_id(); ?> </td> 
	<td>  <?php print $item->getLatitud(); ?> </td> 
	<td>  <?php print $item->getLongitud(); ?> </td> 
	<td> <input class='btn' type='button' value='editar' onclick='mvc_editar("<?php print $item->getHistoria_id(); ?>")'>  </td> 
	<td> <input class='btn' type='button' value='eliminar' onclick='mvc_eliminar("<?php print $item->getHistoria_id(); ?>")'>  </td> 
</tr>
<?php endforeach;?>  
</tbody>  				
</table><form name="mvc_form_aux" action="" method="post">
		<input type="hidden" name="db_operacion" value=""/>
		<input type="hidden" name="historia_id" value=""/>
	</form>