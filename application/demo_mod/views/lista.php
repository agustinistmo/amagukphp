<script type="text/javascript">
function demo_editar(ide){
	document.demo_form_aux.action ="../demo/form";
	document.demo_form_aux.db_operacion.value ="edit";
	document.demo_form_aux.tipo_usuario_id.value = ide;
	document.demo_form_aux.submit();
}

function demo_eliminar( ide ){
	if (!confirm('Esta seguro que desea eliminar el registro?'))
		return;
	document.demo_form_aux.db_operacion.value ="delete";
	document.demo_form_aux.tipo_usuario_id.value = ide;
	document.demo_form_aux.submit();	
}
</script>

<ul class="nav nav-tabs">
  <li class="active"><a href="<?php print MGK_HOME?>/index.php/demo/lista">Listado</a></li>
  <li><a href="<?php print MGK_HOME?>/index.php/demo/form">Captura</a></li>
</ul>
<table width="90%" border="0" cellspacing="0" cellpadding="0" class="table table-striped">
	<thead>
  <tr>
	<th> tipo_usuario_id </th> 
 	<th> tipo_usuario_nombre </th> 
 	<th> descripcion </th> 
 	<th> Editar </th> 
 	<th> Eliminar </th> 
 </tr>
  		</thead>
  		<tbody>
<?php foreach ( $this->view->items as $item ) :?>
  <tr>
	<td>  <?php print $item->getTipo_usuario_id(); ?> </td> 
	<td>  <?php print $item->getTipo_usuario_nombre(); ?> </td> 
	<td>  <?php print $item->getDescripcion(); ?> </td> 
	<td> <input class='btn' type='button' value='editar' onclick='demo_editar("<?php print $item->getTipo_usuario_id(); ?>")'>  </td> 
	<td> <input class='btn' type='button' value='eliminar' onclick='demo_eliminar("<?php print $item->getTipo_usuario_id(); ?>")'>  </td> 
</tr>
<?php endforeach;?>  
</tbody>  				
</table><form name="demo_form_aux" action="" method="post">
		<input type="hidden" name="db_operacion" value=""/>
		<input type="hidden" name="tipo_usuario_id" value=""/>
	</form>