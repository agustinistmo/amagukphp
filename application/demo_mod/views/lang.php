<h1><?php print $this->mgkLang->L("saludo")?></h1>
Ejemplo de manejo de lenguaje, los archivos con las etiquetas se encuentra en:
<div class="alert alert-info">
<strong>
<?php print MGK_HOME?>/<?php print MGK_APPLICATION_DIRECTORY?>/_language/
</strong>
</div>
El idioma por default es español, se puede modificar en el archivo:
<div class="alert alert-info">
<strong>
<?php print MGK_HOME?>/index.php
 
<br><br>
define('MGK_LANGUAGE', "es" );
</strong>
</div>  