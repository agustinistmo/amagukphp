
<ul class="nav nav-tabs">
  <li class="active"><a href="<?php print MGK_HOME?>/index.php/mgk_tipousuario/">Inicio</a></li>
  <li><a href="<?php print MGK_HOME?>/index.php/mgk_tipousuario/lista">Listado</a></li>
  <li><a href="<?php print MGK_HOME?>/index.php/mgk_tipousuario/form">Captura</a></li>
</ul>
<br/>
<?php if ($this->message_text!=""):?>
    <div class="alert <?php print $this->message_css;?>">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong><?php print $this->message_title;?> </strong> <?php print $this->message_text;?>.
    </div>
<?php endif;?>
<!-- AMAGUK_GCA_VERSION: 0.3.0 -->