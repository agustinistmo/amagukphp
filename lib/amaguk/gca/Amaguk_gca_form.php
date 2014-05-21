<?php

class Amaguk_gca_form {
	private $alias_table_name;
	
	public $AMAGUK_GCA_VERSION;
	
	public function __construct( $alias_table_name="" ){
		$this->alias_table_name = $alias_table_name;
	}
	public function create_form_phtml_bootstrap3($fields,$form_name){
		$maximo=490;		
		$code="";
		$code.="
<ul class=\"nav nav-tabs\">
  <li><a href=\"<?php print MGK_HOME?>/index.php/$this->alias_table_name/lista\">Listado</a></li>
  <li class=\"active\"><a href=\"<?php print MGK_HOME?>/index.php/$this->alias_table_name/form\">Captura</a></li>
</ul>
	
<?php if (\$this->message_text!=\"\"):?>
	<div class=\"alert <?php print \$this->message_css;?>\">
	<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
	<strong><?php print \$this->message_title;?> !</strong> <?php print \$this->message_text;?>.
	</div>
<?php endif;?>
	
<div id=\"div_<?php print \$this->getName();?>\" class=\"mgk_form\">
		<form class=\"form-horizontal\" role=\"form\" name=\"<?php print \$this->getName();?>\" id=\"<?php print \$this->getName();?>\" action=\"\" method=\"<?php print \$this->getMethod();?>\">
		<input type=\"hidden\" id=\"form_name\" name=\"form_name\" value=\"<?php print \$this->getName();?>\" >
		<input type=\"hidden\" id=\"db_operacion\" name=\"db_operacion\" value=\"<?php print \$this->getDb_operacion();?>\" >
		<fieldset>		
		\n";
		$requeridos=0;
		$ancho_letra_px = 12;
		foreach ( $fields as $field ){
		$field_name = $field["name"];
		$is_null = $field["is_null"];
	
		if ( $is_null == "" )
			$not_null ="";
		else{
			$not_null ="*";
			$requeridos++;
		}
	
		$field_name_l = ucfirst($field["name"]);
		if ( $field["type"] == "string" )
			$field["length"] = $field["length"] / 3 ;			
		$ancho_estilo = ($field["length"]*$ancho_letra_px<=$maximo)?$field["length"]*$ancho_letra_px:$maximo;
		$ancho_estilo = intval ( $ancho_estilo );
		
		$ancho_estilo = "300" ;
	
		if ($field["type"]=="blob"){
		$code.="
		<div class=\"control-group\">
		<label class=\"control-label\" for=\"$field_name\">$field_name_l $not_null</label>
		<div class=\"controls\">
		<textarea id=\"$field_name\" name=\"$field_name\" style=\"width:".( $ancho_estilo )."px;height:100px\"><?php print \$this->data->get".ucfirst($field_name)."();?></textarea>
		</div>
				</div>
				\n";
		}
		else{
			$code.="
			<div class=\"form-group\">
			<label for=\"$field_name\" class=\"col-xs-3 control-label\">$field_name_l $not_null</label>
			<div class=\"col-xs-9\">
			<input class=\"form-control\" type=\"text\" name=\"$field_name\" id=\"$field_name\" placeholder=\"$field_name_l\" value=\"<?php print \$this->data->get".ucfirst($field_name)."();?>\" style=\"width: ". $ancho_estilo. "px\"  >
			</div>
			</div>\n";
		}
	
		}
		$txt_requerido="";
		$requeridos=true;
		if ( $requeridos )
			$txt_requerido = "  <div class=\"form-group\">
    		<div class=\"col-xs-offset-3 col-xs-9\">
      		* Requerido
    		</div>
  			</div>";
	
		$code .="	
			</fieldset>			

		$txt_requerido
		<div class=\"form-group\">
	    <div class=\"col-lg-offset-3 col-lg-9\">
				<input class='btn btn-primary' type=\"submit\" value=\"Enviar\"/>
				<input  class='btn btn-inverse' type=\"reset\" value=\"Restablecer\">
	    </div>
		</div>  
	</form>
</div>\n";
			return $code;
	}	

	public function create_form_phtml_bootstrap2($fields,$form_name){
		$maximo=490;
		$title = ( $this->alias_table_name=="")?"Captura":$this->alias_table_name;
		
		/*$code="<ul class=\"breadcrumb\">
		<li><a href=\"<?php print MGK_HOME?>/index.php\">Inicio</a> <span class=\"divider\">/</span></li>
		<li><a href=\"<?php print MGK_HOME?>/index.php/$this->alias_table_name/lista\">$this->alias_table_name</a> <span class=\"divider\">/</span></li>
		<li class=\"active\">Formulario</li>
		</ul>";*/
				
		$code="<div id=\"nav_bar\">
		<a href=\"<?php print MGK_HOME?>/index.php/$this->alias_table_name/lista\">Lista</a> |
		<a href=\"<?php print MGK_HOME?>/index.php/$this->alias_table_name/form\">Nuevo</a>
		</div>
		
		<?php if (\$this->message_text!=\"\"):?>
		    <div class=\"alert <?php print \$this->message_css;?>\">
			<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
		    <strong><?php print \$this->message_title;?> !</strong> <?php print \$this->message_text;?>.
		    </div>
		<?php endif;?>
		
		<div id=\"form_content\">
		<form class=\"form-horizontal\" name=\"<?php print \$this->getName();?>\" id=\"<?php print \$this->getName();?>\" action=\"\" method=\"<?php print \$this->getMethod();?>\">
		<input type=\"hidden\" id=\"form_name\" name=\"form_name\" value=\"<?php print \$this->getName();?>\" >
		<fieldset class=\"stylized\"  >
		<legend>$title</legend>
		<input type=\"hidden\" id=\"db_operacion\" name=\"db_operacion\" value=\"<?php print \$this->getDb_operacion();?>\" >
		\n";
		$requeridos=0;
		$ancho_letra_px = 12;
		foreach ( $fields as $field ){
			$field_name = $field["name"];
			$is_null = $field["is_null"];
	
			if ( $is_null == "" )
				$not_null ="";
			else{
				$not_null ="*";
				$requeridos++;
			}
				
			$field_name_l = ucfirst($field["name"]);
			
			//$code.="n=".$field["is_null"]." _L=".$field["length"]." t=".$field["type"]."<br>";
			if ( $field["type"] == "string" )
				$field["length"] = $field["length"] / 3 ;
			//$code.="n=".$field["is_null"]." _L=".$field["length"]." t=".$field["type"];
				
			if ($field["type"]=="blob"){
				$code.="
				<div class=\"control-group\">
				<label class=\"control-label\" for=\"$field_name\">$field_name_l $not_null</label>
				<div class=\"controls\">
				<textarea id=\"$field_name\" name=\"$field_name\" style=\"width:".(($field["length"]*$ancho_letra_px<=$maximo)?$field["length"]*$ancho_letra_px:$maximo)."px;height:100px\"><?php print \$this->data->get".ucfirst($field_name)."();?></textarea>
				</div>
				</div>
				\n";
		}
		else{
			$code.="
			<div class=\"control-group\">
			<label class=\"control-label\" for=\"$field_name\">$field_name_l $not_null</label>
			<div class=\"controls\">
			<input maxlength=".$field["length"]." type=\"text\" name=\"$field_name\" id=\"$field_name\" placeholder=\"$field_name_l\" value=\"<?php print \$this->data->get".ucfirst($field_name)."();?>\" style=\"width: ".(($field["length"]*$ancho_letra_px<=$maximo)?$field["length"]*$ancho_letra_px:$maximo)."px\"  >
			</div>
			</div>
			\n";
	}
		
	}
	$txt_requerido="";
	if ( $requeridos )
		$txt_requerido = "<dl>
		<dd> <div id=\"div_$field_name\" class=\"form_label_message\"> * requerido </div>
		</dd>
		</dl>";
	
		$code .="
	
	
</fieldset>
				
 <div class=\"control-group\">
<div class=\"controls\">
<label class=\"checkbox\">
$txt_requerido
</label>
<input class='btn btn-primary' type=\"submit\" value=\"Enviar\"/>				
<input  class='btn btn-inverse' type=\"reset\" value=\"Restablecer\">
</div>
</div>
	
	
</form>
</div>\n";
		return $code;
	}

	public function create_form_phtml($fields,$form_name){
		$maximo=490;
		$title = ( $this->alias_table_name=="")?"Captura":$this->alias_table_name;
		$code="<div id=\"nav_bar\">
	<a href=\"<?php print MGK_HOME?>/index.php/$this->alias_table_name/lista\">Lista</a> |
	<a href=\"<?php print MGK_HOME?>/index.php/$this->alias_table_name/form\">Nuevo</a>
</div>
<div id=\"form_content\">
<form name=\"<?php print \$this->getName();?>\" id=\"<?php print \$this->getName();?>\" action=\"\" method=\"<?php print \$this->getMethod();?>\">
<input type=\"hidden\" id=\"form_name\" name=\"form_name\" value=\"<?php print \$this->getName();?>\" >
<fieldset class=\"stylized\"  >
    	<legend>$title</legend>
<input type=\"hidden\" id=\"db_operacion\" name=\"db_operacion\" value=\"<?php print \$this->getDb_operacion();?>\" >
\n";
		$requeridos=0;
		foreach ( $fields as $field ){
			$field_name = $field["name"];
			$is_null = $field["is_null"];

			if ( $is_null )
				$not_null ="";
			else{
				$not_null ="*";
				$requeridos++;
			}
			
			$field_name_l = ucfirst($field["name"]);
			
			if ($field["type"]=="blob"){
$code.="
<dl>
  <dt><label class=\"form_label\">$field_name_l :</label></dt>
  <dd>	
    <textarea id=\"$field_name\" name=\"$field_name\" style=\"width:".(($field["length"]*6<=$maximo)?$field["length"]*6:$maximo)."px;height:100px\"><?php print \$this->data->get".ucfirst($field_name)."();?></textarea>	
	<div id=\"div_$field_name\" class=\"form_label_message\"> $not_null <?php print \$this->fetch_message_text(\"$field_name\");?> </div>
  </dd>
</dl>
  \n";
			}
			else{
$code.="
<dl>
  <dt><label class=\"form_label\">$field_name_l :</label></dt>
  <dd>
	<input type=\"text\" id=\"$field_name\" name=\"$field_name\" value=\"<?php print \$this->data->get".ucfirst($field_name)."();?>\" style=\"width: ".(($field["length"]*6<=$maximo)?$field["length"]*6:$maximo)."px\" />
	<div id=\"div_$field_name\" class=\"form_label_message\"> $not_null <?php print \$this->fetch_message_text(\"$field_name\");?> </div>
  </dd>
</dl>
  \n";
			}
			
		}
if ( $requeridos )		
$code.="<dl>
   <dd> <div id=\"div_$field_name\" class=\"form_label_message\"> * requerido </div>
	</dd>
</dl>";		
		
$code .="


</fieldset>

<fieldset class=\"stylized\">
<dl>
   <dd><input class='btn btn-primary' type=\"submit\" value=\"Enviar\"/> 
    <input  class='btn btn-inverse' type=\"reset\" value=\"Restablecer\">
	</dd>
	
</dl>
</fieldset>

</form>
</div>\n";
		return $code;
	}
	
	public function create_form_php($form_name,$db_name){
		$code="<?php
require_once 'lib/amaguk/utils/Amaguk_html_form.php';

/** 
 * AMAGUK_GCA_VERSION: ".$this->AMAGUK_GCA_VERSION."
 * @author http://amagukmx.wordpress.com/
 *
 */
class $form_name extends Amaguk_html_form{
	public \$data;
	
	public function  __construct(){
		parent::__construct();
		\$this->data= new $db_name();
		\$this->setName('$form_name');
	}
	
	public function printForm(){
		if (\$this->showForm)
			require_once '$form_name.html.php';
 	}
}
?>";
		
		return $code;
	}	

}

?>