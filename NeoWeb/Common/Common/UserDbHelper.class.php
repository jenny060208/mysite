<?php

// =======================================================
// Name : UserDbHelper.class.php
// Date Created: Mar 28, 2016
// Auther :
// Description : This file is for User database middle layer class
// =======================================================
namespace NeoWeb\Common\Common;

header ( "Content-type: text/html; charset=utf-8" );

use Think\MyDb;

require_once ('system_definition.php');
require_once ('user_definition.php');
require_once ('user_info_set.php');
// This file contains all Database related functions
class UserDBHelper {
	private $db = null;
	private $dbTblName = null; // table hold all user account information
	                            
	// Construct function
	public function __construct($db_config) {
		$this->getDbInst ( $db_config ); // Get the database instance
			                                // $this->db($this->connection);
	}
	
	// Desstruct function
	public function __destruct() {
		if (! isset ( $this->db )) {
			// Close the database
			$this->db->close ();
		}
		
		unset ( $this->db );
	}
	
	// =====================================================
	/**
	 * Name : getDbInst
	 * Input : N/A
	 * Output: N/A
	 *
	 * Description: Create a db instance
	 */
	// =====================================================
	public function getDbInst($db_config) {
		if (! isset ( $this->db )) {
			// Create a new instance
			$this->db = MyDb::getInstance ( $db_config );
		}
		return;
	}
	
	// =====================================================
	/**
	 * Name : Connect
	 * Input : N/A
	 * Output: True -- connect to db successfully
	 * false -- connect to db failed
	 * Description: connect to db
	 */
	// =====================================================
	public function Connect() {
		$result = $this->db->connect ();
		
		if (isset ( $result )) {
			return true;
		} else {
			return false;
		}
	}
	
	// =====================================================
	// Close Database
	// =====================================================
	public function close() {
		if (! isset ( $this->db )) {
			// Close the database
			$this->db->close ();
		}
		return;
	}
}

?>
