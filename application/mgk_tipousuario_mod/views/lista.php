<script type="text/javascript">
function mgk_tipousuario_editar(ide){
	document.mgk_tipousuario_form_aux.action ="../mgk_tipousuario/form";
	document.mgk_tipousuario_form_aux.db_operacion.value ="edit";
	document.mgk_tipousuario_form_aux.tipo_usuario_id.value = ide;
	document.mgk_tipousuario_form_aux.submit();
}

function mgk_tipousuario_eliminar( ide ){
	if (!confirm('Esta seguro que desea eliminar el registro?'))
		return;
	document.mgk_tipousuario_form_aux.db_operacion.value ="delete";
	document.mgk_tipousuario_form_aux.tipo_usuario_id.value = ide;
	document.mgk_tipousuario_form_aux.submit();	
}
</script>

<ul class="nav nav-tabs">
  <li class="active"><a href="<?php print MGK_HOME?>/index.php/mgk_tipousuario/lista">Listado</a></li>
  <li><a href="<?php print MGK_HOME?>/index.php/mgk_tipousuario/form">Captura</a></li>
</ul>
<table class="table table-striped">
	<thead>
  <tr>
	<th style="width:60px"> Editar </th> 
 	<th style="width:60px"> Eliminar </th> 
 	<th> tipo_usuario_id </th> 
 	<th> tipo_usuario_nombre </th> 
 	<th> descripcion </th> 
 </tr>
  		</thead>
  		<tbody>
<?php foreach ( $this->items as $item ) :?>
  <tr>
	<td  > <button class='btn btn-default' onclick='mgk_tipousuario_editar("<?php print $item->getTipo_usuario_id(); ?>")'><span class='glyphicon glyphicon-edit'></span></button> </td> 
	<td> <button class='btn btn-default' onclick='mgk_tipousuario_eliminar("<?php print $item->getTipo_usuario_id(); ?>")'><span class='glyphicon glyphicon-trash'></span></button> </td> 
	<td>  <?php print $item->getTipo_usuario_id(); ?> </td> 
	<td>  <?php print $item->getTipo_usuario_nombre(); ?> </td> 
	<td>  <?php print $item->getDescripcion(); ?> </td> 
</tr>
<?php endforeach;?>  
</tbody>  				
</table>
<form name="mgk_tipousuario_form_aux" action="" method="post">
		<input type="hidden" name="db_operacion" value=""/>
		<input type="hidden" name="tipo_usuario_id" value=""/>
</form>