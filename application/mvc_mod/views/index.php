
<ul class="nav nav-tabs">
  <li class="active"><a href="<?php print MGK_HOME?>/index.php/mvc/">Inicio</a></li>
  <li><a href="<?php print MGK_HOME?>/index.php/mvc/lista">Listado</a></li>
  <li><a href="<?php print MGK_HOME?>/index.php/mvc/form">Captura</a></li>
</ul>
<br/>
<?php if ($this->message_text!=""):?>
    <div class="alert <?php print $this->message_css;?>">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong><?php print $this->message_title;?> </strong> <?php print $this->message_text;?>.
    </div>
<?php endif;?>