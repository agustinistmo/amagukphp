Un ejemplo para el uso de la plantilla vacia es cuando se requiere responder con un JSON
<br><br>
por ejemplo: <?php print $this->json;?>
<br><br>
Ahora imprimir el contenido de un arreglo:<br>
<?php foreach ($this->items as $k => $v ):?>
	<?php print "$k : $v";?><br>
<?php endforeach;?>
<br><br>
<a href="<?php print MGK_HOME?>/index.php/demo">Regresar</a>