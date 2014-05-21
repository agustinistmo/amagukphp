<script type="text/javascript">
function mgk_historiaacceso_editar(ide){
	document.mgk_historiaacceso_form_aux.action ="../mgk_historiaacceso/form";
	document.mgk_historiaacceso_form_aux.db_operacion.value ="edit";
	document.mgk_historiaacceso_form_aux.historia_id.value = ide;
	document.mgk_historiaacceso_form_aux.submit();
}

function mgk_historiaacceso_eliminar( ide ){
	if (!confirm('Esta seguro que desea eliminar el registro?'))
		return;
	document.mgk_historiaacceso_form_aux.db_operacion.value ="delete";
	document.mgk_historiaacceso_form_aux.historia_id.value = ide;
	document.mgk_historiaacceso_form_aux.submit();	
}
</script>
<ul class="breadcrumb">
    <li><a href="<?php print URL_HOME?>/index.php">Inicio</a> <span class="divider">/</span></li>
    <li><a href="<?php print URL_HOME?>/index.php/mgk_historiaacceso/lista">mgk_historiaacceso</a> <span class="divider">/</span></li>
    <li class="active">Lista</li>
    </ul><div id="nav_bar">
	<a href="<?php print URL_HOME?>/index.php/mgk_historiaacceso/lista">Lista</a> |
	<a href="<?php print URL_HOME?>/index.php/mgk_historiaacceso/form">Nuevo</a>
</div>

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
	<td> <input class='btn' type='button' value='editar' onclick='mgk_historiaacceso_editar("<?php print $item->getHistoria_id(); ?>")'>  </td> 
	<td> <input class='btn' type='button' value='eliminar' onclick='mgk_historiaacceso_eliminar("<?php print $item->getHistoria_id(); ?>")'>  </td> 
</tr>
<?php endforeach;?>  
</tbody>  				
</table><form name="mgk_historiaacceso_form_aux" action="" method="post">
		<input type="hidden" name="db_operacion" value=""/>
		<input type="hidden" name="historia_id" value=""/>
	</form>