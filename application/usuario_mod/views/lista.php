<script type="text/javascript">
function usuario_editar(ide){
	document.usuario_form_aux.action ="../usuario/form";
	document.usuario_form_aux.db_operacion.value ="edit";
	document.usuario_form_aux.usuario_id.value = ide;
	document.usuario_form_aux.submit();
}

function usuario_eliminar( ide ){
	if (!confirm('Esta seguro que desea eliminar el registro?'))
		return;
	document.usuario_form_aux.db_operacion.value ="delete";
	document.usuario_form_aux.usuario_id.value = ide;
	document.usuario_form_aux.submit();	
}
</script>
<ul class="nav nav-tabs">
  <li class="active"><a href="<?php print MGK_HOME?>/index.php/usuario/lista">Listado</a></li>
  <li ><a href="<?php print MGK_HOME?>/index.php/usuario/form">Captura</a></li>
</ul>

<table class="table table-striped">
	<thead>
  <tr>
 	<th style="width:60px">&nbsp;</th> 
 	<th style="width:60px">&nbsp;</th>   
	<th style="width:60px"> ID </th>
	<th> Nombre </th> 
 	<th> E-mail </th> 
 	<th> Tipo </th> 

 </tr>
  		</thead>
  		<tbody>
<?php foreach ( $this->view->items as $item ) :?>
  <tr>
	<td> <button class='btn btn-default' onclick='usuario_editar("<?php print $item->getUsuario_id(); ?>")'><span class="glyphicon glyphicon-edit"></span></button> </td>
	<td> <button class='btn btn-default' onclick='usuario_eliminar("<?php print $item->getUsuario_id(); ?>")'><span class="glyphicon glyphicon-trash"></span></button>  </td>   
	<td>  <?php print $item->getUsuario_id(); ?> </td> 
	<td>  <?php print $item->getNombre(); ?> </td>	
	<td>  <?php print $item->getUsuario_email(); ?> </td> 
	<td>  <?php print $item->getTipo_usuario_id(); ?> </td> 
</tr>
<?php endforeach;?>  
</tbody>  				
</table><form name="usuario_form_aux" action="" method="post">
		<input type="hidden" name="db_operacion" value=""/>
		<input type="hidden" name="usuario_id" value=""/>
	</form>