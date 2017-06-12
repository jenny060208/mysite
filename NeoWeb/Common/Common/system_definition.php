<?php

namespace NeoWeb\Common\Common;

class SysDefinition {
	// Database related definition
	const DB_SERVER_LOCAL = "localhost";
	const DB_SERVER_REMOTE = "to be determined";
	
	// Mysql database name
	const DB_MYSQL_NEO = "neoreward";
	
	// Mysql database table name for user information
	const DB_TBL_NAME_USER = "neo_user_info";
	
	// Mysql database user name
	// Note: the local mysql database root password is "wzm12345"
	const DB_USER_USER = "neouser";
	const DB_USER_USER_PW = "wzm12345";
	const USER_DB_CONFIG = array (
			"db_host" => "localhost",
			"db_name" => "neoloyalty",
			"db_port" => "3306",
			"db_user" => "neouser",
			"db_pwd" => "wzm12345" 
	);
	
	// Email related definition
	// const SMTP_SERVER_NAME = "smtp.gmail.com"; // SMTP Server
	const BN_EMAIL_CONFIG = array (
			"SMTP_HOST" => "smtp.gmail.com", // SMTP Server
			"SMTP_PORT" => "465", // SMTP Server port
			"SMTP_ACCOUNT" => "elecdesign9@gmail.com", // SMTP account user name
			"SMTP_PW" => "neo12345", // SMTP user password
			"FROM_EMAIL" => "elecdesign9@gmail.com", // Sender's EMAIL
			"FROM_NAME" => "Neo Reward", // Sender's name
			"REPLY_EMAIL" => "elecdesign9@gmail.com", // Reply email （if null, use sender's email）
			"REPLY_NAME" => "Neo Reward" 
	); // Reply name （if null, user sender's name）
	const NEO_ADMIN_EMAIL = "jamesw789@gmail.com";
	const NEO_ADMIN_NAME = "Neo Sales Team";
	
	// const SMTP_SERVER_NAME = "smtp.163.com"; // SMTP Server
	
	// const SMTP_SERVER_PORT = 465; // SMTP Server port
	// const SMTP_SERVER_PORT = 25; // SMTP Server port
	// const SMTP_ACCOUNT = "elecdesign8@163.com"; // SMTP user name
	// const SMTP_ACCOUNT_PW = "wzm12345"; // SMTP user password
	// const SMTP_USER_NAME = "NEO Reward"; // SMTP user name shown on the email
	
	// const EMAIL_SUBJECT_RECOVER = "Neo Reward password recover sent upon your request -- Do not reply";
	// const EMAIL_MSG_BODY = "Here is your password: ";
}

?>