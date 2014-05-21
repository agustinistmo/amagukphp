<?php


/**
 * Enviar email
 * @author agustinistmo@gmail.com
 * @version 0.3.1
 * <br>2013-12-10
 *
 */
class Amaguk_mail {
	/**
	 * 
	 * @var Amaguk_properties
	 */
	public $mgkProproperties;
	
	function __construct(){
		$this->mgkProproperties = null;
	}
	
	public function send_mail_smtp($to,$subject,$data,$reply){
/*		if ( $this->mgkProproperties == null )
			return 1;*/
		
		require_once 'application/mk_parametro_mod/controller/mk_parametro_controller.php';
		$this->mgkProperties = new mk_parametro_controller();
		
		$is_mail = $this->mgkProperties->getValue("IS_MAIL");
		if ( ! ( $is_mail == "1" || $is_mail == true ) )
			return;
		
		require_once 'lib/PHPMailer/PHPMailerAutoload.php';		

		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPDebug = 0;
		$mail->Debugoutput = 'html';
		
		//echo "host".$this->mgkProproperties->getValue("mail_Host");
		
		///$mail->Host = "uriel.hosting-mexico.net";
		$mail->Host = $this->mgkProproperties->getValue(" MAIL_HOST");		
		///$mail->Port = 587;
		$mail->Port = $this->mgkProproperties->getValue(" MAIL_PORT");
		//$mail->SMTPAuth = true;
		$mail->SMTPAuth = $this->mgkProproperties->getValue("MAIL_SMTPAUTH");
		//$mail->SMTPSecure="TLS";
		$mail->SMTPSecure=$this->mgkProproperties->getValue("MAIL_SMTPSECURE");		
		///$mail->Username = "agustin@micromoviles.com";
		$mail->Username = $this->mgkProproperties->getValue(" MAIL_USERNAME");
		///$mail->Password = "Lada--971-.-";
		$mail->Password = $this->mgkProproperties->getValue(" MAIL_PASSWORD");
		$mail->setFrom($mail->Username );
		$mail->addReplyTo($reply);
		$mail->addAddress($to);
		$mail->Subject = $subject;
		$mail->addBCC( $reply );
		//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
		$mail->msgHTML( $data );
		$mail->AltBody = $data;
		
		/*

		//send the message, check for errors
		if (!$mail->send()) {			
			echo "Mailer Error: " . $mail->ErrorInfo;
			return 2;
		} else {
			return 1;
			//echo "Message sent!"; // OK
		}
		
		*/
	}
	
	public function send_mail($to,$from,$subject,$message){
		/*$cabeceras = 'From: '.$from. "\r\n" .
    'Reply-To: '.$from. "\r\n" .
    'X-Mailer: PHP/' . phpversion()."\n\r";
	$cabeceras .= 'Bcc: birthdaycheck@example.com' . "\r\n";
	*/
	
	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
	$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	
	// Cabeceras adicionales
	$cabeceras .= "To: <$to>" . "\r\n";
	$cabeceras .='Reply-To: '.$from. "\r\n";
	$cabeceras .= "From:  <$from>" . "\r\n";
	//$cabeceras .= 'Bcc: <agustin.corona@destec-mex.com.mx>' . "\r\n";
	//$cabeceras .= 'Cc: birthdayarchive@example.com' . "\r\n";	
	$cabeceras .= 'X-Mailer: PHP/' . phpversion()."\n\r";
	
	
		mail($to, $subject, $message, $cabeceras);		
	}
}

?>