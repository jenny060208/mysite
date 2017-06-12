<?php

// Email utility tool
namespace NeoWeb\Common\Common;

define ( 'EMAIL_UTILITY_PATH', dirname ( dirname ( __FILE__ ) ) );

require_once (EMAIL_UTILITY_PATH . '/CommonLib/PHPMailer/class.phpmailer.php');
require_once ('system_definition.php');
require_once ('common_definition.php');
require_once ('business_definition.php');

use NeoWeb\Common\CommonLib\PHPMailer\PHPMailer;

class EmailUtility {
	private $config;
	
	// Construction register
	public function __construct($emailConfig) {
		$this->config = $emailConfig;
	}
	
	// Desstruct function
	public function __destruct() {
	}
	
	// =====================================================
	// Name: sendEmail
	// Return: Send email
	// TRUE -- Send email success
	// FALSE -- Send email failed
	// Parameter: $to -- Send email destination email
	// $name -- Send email destination name
	// $subject -- email subject
	// $body -- email message body
	// $attachment -- email attachment
	
	// Description: Send email with PHPmailer
	// =====================================================
	function sendEmail($to, $name, $subject = '', $body = '', $attachment = null) {
		// Load class.phpmailer.php class file from directory PHPMailer
		// Vendor('PHPMailer.PHPMailerAutoload');
		// PHPMailer object
		$mail = new PHPMailer ();
		
		// Set mail encoding method, default is ISO-8859-1, it's must if sending Chinese
		$mail->CharSet = 'UTF-8';
		// Set to use SMTP service
		$mail->isSMTP ();
		// Turn off SMTP debug funtion
		// 0 = turn off SMTP debug
		// 1 = errors and messages
		// 2 = messages only
		$mail->SMTPDebug = 0;
		// Use SMTP authentication feature
		$mail->SMTPAuth = true;
		// Use SSL protocol
		$mail->SMTPSecure = 'ssl';
		// SMTP Server
		$mail->Host = $this->config ["SMTP_HOST"];
		// SMTP server port
		$mail->Port = $this->config ["SMTP_PORT"];
		$mail->isHTML ( true );
		// SMTP server user account name
		$mail->Username = $this->config ["SMTP_ACCOUNT"];
		// SMTP server user account password
		$mail->Password = $this->config ["SMTP_PW"];
		$mail->setFrom ( $this->config ["FROM_EMAIL"], $this->config ["FROM_NAME"] );
		$replyEmail = $this->config ["REPLY_EMAIL"] ? $this->config ["REPLY_EMAIL"] : $this->config ["FROM_EMAIL"];
		$replyName = $this->config ['REPLY_NAME'] ? $this->config ['REPLY_NAME'] : $this->config ["FROM_NAME"];
		$mail->addReplyTo ( $replyEmail, $replyName );
		$mail->Subject = $subject;
		$mail->AltBody = "Please switch to HTML mode to read this email in better effect.";
		$mail->msgHTML ( $body );
		$mail->addAddress ( $to, $name );
		
		if (is_array ( $attachment )) { // Add attachment
			foreach ( $attachment as $file ) {
				is_file ( $file ) && $mail->AddAttachment ( $file );
			}
		}
		return $mail->Send () ? true : $mail->ErrorInfo;
	}
}

?>
