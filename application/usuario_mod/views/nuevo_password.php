<?php if ($this->message_text!=""):?>
    <div class="alert <?php print $this->message_css;?>">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong><?php print $this->message_title;?> </strong> <?php print $this->message_text;?>.
    </div>
<?php endif;?>