<?php
/*
	Mailer Class
*/
require_once('config.inc.php');
class mailer {
	
	var $conn;
	
	function __construct() {
		
	}
	
	function SendMail($sender, $receiver, $subject, $body) {
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.$sender . "\r\n";
		if(mail($receiver,$subject,$body,$headers)) {
			return true;
		} else {
			return false;
		}
	}
	
}
?>