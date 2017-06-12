<?php

// =======================================================
// Name : user_db_helper
// Date Created: Mar 28, 2016
// Auther :
// Description : This file is for Mysql database access class
// =======================================================
namespace Home\Common;

header ( "Content-type: text/html; charset=utf-8" );

require_once ('system_definition.php');
require_once ('user_definition.php');
require_once ('user_info_set.php');
// This file contains all Database related functions
class User_DB_Helper {
	private $mySqli;
	private $server; // Mysql database server Address
	private $dbUser; // login user name to database
	private $dbUserPw; // login user password to database
	private $dbName; // Database for the system
	private $dbTblName; // table hold all user account information
	                    
	// Construct function
	public function __construct($server, $dbUser, $dbUserPw, $dbName, $dbUserTableName) {
		$this->server = $server;
		$this->dbUser = $dbUser;
		$this->dbUserPw = $dbUserPw;
		$this->dbName = $dbName;
		$this->dbTblName = $dbUserTableName;
	}
	
	// Desstruct function
	public function __destruct() {
	}
	
	// =====================================================
	// Open Database
	// =====================================================
	public function connectDb() {
		// Connect to database server
		$this->mysqli = new mysqli ( $this->server, $this->dbUser, $this->dbUserPw, $this->dbName );
		
		if ($this->mysqli->connect_errno) {
			return false; // Connect to DB failed
		} else {
			return true; // Connect to DB succeed
		}
	}
	
	// =====================================================
	// Close Database
	// =====================================================
	public function closeDbUser() {
		if ($this->mysqli) {
			$this->mysqli->close ();
		}
	}
	
	// =====================================================
	// Name: checkUserInfoTblIsExist
	// Return: true -- user info table existed
	// false -- user info table does not exist
	// Parameter: user info table name
	// Description: check if user info table exist
	// =====================================================
	public function checkUserInfoTblIsExist($tableName) {
		// Check table existence
		$strQuery = "SHOW TABLES LIKE '" . $tableName . "'";
		$result = $this->mysqli->query ( $strQuery );
		$row_cnt = $result->num_rows;
		
		printf ( "Result set has %d rows.\n", $row_cnt );
		
		if ($row_cnt) {
			$result->close ();
			return true;
		} else {
			$result->close ();
			return false;
		}
	}
	
	// =====================================================
	// Name: getUserAccountTblNameByEmail
	// Return: true -- user info table existed
	// false -- user info table does not exist
	// Parameter: user info table name
	// Description: check if user info table exist
	// =====================================================
	public function getUserAccountTblNameByEmail($strUserEmail) {
		$strQuery = 'SHOW TABLES LIKE \'' . '%' . UserDefinition::USER_TABLE_NAME_PREFIX . '%' . '\'';
		
		$result = $this->mysqli->query ( $strQuery );
		$row_cnt = $result->num_rows;
		
		if ($row_cnt == 0) {
			// No user account tables in this database
			// return with null
			$result->close ();
			return null;
		} else {
			// user account table found, search in detail
			$tables = array ();
			$count = 0;
			// get each table name
			while ( $row = $result->fetch_row () ) {
				$tables [$count] = $row [0];
				$count = $count + 1;
			}
			
			// mysqli_free_result($result);
			$result->close ();
			
			for($count = 0; $count < $row_cnt; $count ++) {
				$strTableName = $tables [$count];
				// Check the email in the table
				// Query the email column
				$strQuery = 'SELECT * FROM ' . $strTableName . ' WHERE user_email=\'' . $strUserEmail . '\'';
				$result = $this->mysqli->query ( $strQuery );
				
				if ($result->num_rows > 0) {
					// mysqli_free_result($result);
					$result->close ();
					return ($strTableName); // return table name that contains the query email
				}
			}
			return null; // return due to the email address is not found in tables
		}
	}
	
	// =====================================================
	// Name: creatUserInfoTbl
	// Return: true -- user info table created
	// false -- user info table failed to create
	// Parameter: user info table name
	// Description: create the user info table
	// =====================================================
	public function creatUserInfoTbl($tableName) {
		// Check table existence
		$strQuery = "SHOW TABLES LIKE '" . $tableName . "'";
		$result = $this->mysqli->query ( $strQuery );
		
		$row_cnt = $result->num_rows;
		// printf("Result set has %d rows.\n", $row_cnt);
		
		// if(mysql_num_rows($result) == 1)
		if ($row_cnt) {
			$result->close ();
			return true;
		} else {
			// Create table if not existed
			$strQuery = "CREATE TABLE " . $tableName;
			$strQuery .= " (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
			$strQuery .= UserDefinition::USER_DB_FIELD_NAME . " VARCHAR(30) NOT NULL,";
			$strQuery .= UserDefinition::USER_DB_FIELD_MOBILE . " VARCHAR(15) NOT NULL,";
			$strQuery .= UserDefinition::USER_DB_FIELD_EMAIL . " VARCHAR(30) NOT NULL,";
			$strQuery .= UserDefinition::USER_DB_FIELD_PASSWORD . " VARCHAR(30) NOT NULL,";
			$strQuery .= UserDefinition::USER_DB_FIELD_POSTAL_CODE . " VARCHAR(10) NOT NULL,";
			$strQuery .= UserDefinition::USER_DB_FIELD_TAG . " VARCHAR(20) NOT NULL,";
			$strQuery .= UserDefinition::USER_DB_FIELD_REG_DATE . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP,";
			$strQuery .= UserDefinition::USER_DB_FIELD_STATUS . " TINYINT DEFAULT 1";
			$strQuery .= ")";
			
			$result = $this->mysqli->query ( $strQuery );
			// echo("PHP1000 Result CreateTable: ".$result);
			
			if ($result) {
				// mysqli_free_result($result);
				// $result->close();
				return true;
			} else {
				// mysqli_free_result($result);
				// $result->close();
				return false;
			}
		}
	}
	
	// =====================================================
	// Name: setUserTblName
	// Return: None
	//
	// Parameter:
	// Description: Set user table name
	// =====================================================
	public function setUserTblName($tblName) {
		$this->dbTblName = $tblName;
	}
	
	// =====================================================
	// Name: checkUserEmai
	// Return: TRUE -- user email exists in Database already
	// FALSE -- user email does not exist in Database
	// Parameter: user email
	// Description: check if user email existed in database, itorate all user account tables
	// =====================================================
	public function checkUserEmailByAllTables($strUserEmail) {
		$strQuery = 'SHOW TABLES LIKE \'' . '%' . UserDefinition::USER_TABLE_NAME_PREFIX . '%' . '\'';
		
		$result = $this->mysqli->query ( $strQuery );
		$row_cnt = $result->num_rows;
		
		if ($row_cnt == 0) {
			// No user account tables in this database
			// It means this email doesn't exist in the database
			// return with null
			$result->close ();
			return false;
		} else {
			// user account table found, search in detail
			$tables = array ();
			$count = 0;
			// get each table name
			while ( $row = $result->fetch_row () ) {
				$tables [$count] = $row [0];
				$count = $count + 1;
			}
			
			$result->close ();
			
			for($count = 0; $count < $row_cnt; $count ++) {
				$strTableName = $tables [$count];
				// Check the email in the table
				// Query the email column
				$strQuery = 'SELECT * FROM ' . $strTableName . ' WHERE user_email=\'' . $strUserEmail . '\'';
				$result = $this->mysqli->query ( $strQuery );
				
				if ($result->num_rows > 0) {
					// mysqli_free_result($result);
					$result->close ();
					return true; // return table name that contains the query email
				}
			}
			return false; // return due to the email address is not found in tables
		}
	}
	
	// =====================================================
	// Name: checkUserMobileByAllTables
	// Return: TRUE -- user mobile exists in Database already
	// FALSE -- user mobile does not exist in Database
	// Parameter: user mobile
	// Description: check if user mobile existed in database
	// =====================================================
	public function checkUserMobileByAllTables($strUserMobile) {
		$strQuery = 'SHOW TABLES LIKE \'' . '%' . UserDefinition::USER_TABLE_NAME_PREFIX . '%' . '\'';
		
		$result = $this->mysqli->query ( $strQuery );
		$row_cnt = $result->num_rows;
		
		if ($row_cnt == 0) {
			// No user account tables in this database
			// It means this mobile doesn't exist in the database
			// return with False
			$result->close ();
			return false;
		} else {
			// user account table found, search in detail
			$tables = array ();
			$count = 0;
			// get each table name
			while ( $row = $result->fetch_row () ) {
				$tables [$count] = $row [0];
				$count = $count + 1;
			}
			
			$result->close ();
			
			for($count = 0; $count < $row_cnt; $count ++) {
				$strTableName = $tables [$count];
				// Check the mobile in the table
				// Query the mobile column
				$strQuery = 'SELECT * FROM ' . $strTableName . ' WHERE user_mobile=\'' . $strUserMobile . '\'';
				$result = $this->mysqli->query ( $strQuery );
				
				if ($result->num_rows > 0) {
					// mysqli_free_result($result);
					$result->close ();
					return true; // return table name that contains the query email
				}
			}
			return false; // return due to the email address is not found in tables
		}
	}
	
	// =====================================================
	// Name: checkUserEmail
	// Return: true -- user email exists in Database already
	// false -- user email does not exist in Database
	// Parameter: user email
	// Description: check if user email existed in specific user account table database
	// =====================================================
	public function checkUserEmail($user_email) {
		// Query the email column
		$strQuery = 'SELECT * FROM ' . $this->dbTblName . ' WHERE user_email=\'' . $user_email . '\'';
		
		$result = $this->mysqli->query ( $strQuery );
		
		if ($result->num_rows > 0) {
			$result->close ();
			return (true); // the user email exists in DB already
		} else {
			$result->close ();
			return (false); // the user email does not exist in DB
		}
	}
	
	// =====================================================
	// Name: checkUserMobile
	// Return: true -- user mobile exists in Database already
	// false -- user mobile does not exist in Database
	// Parameter: user mobile
	// Description: check if user mobile existed in specific user account table database
	// =====================================================
	public function checkUserMobile($user_mobile) {
		// Query the email column
		$strQuery = 'SELECT * FROM ' . $this->dbTblName . ' WHERE user_mobile=\'' . $user_mobile . '\'';
		
		$result = $this->mysqli->query ( $strQuery );
		if ($result->num_rows > 0) {
			// mysqli_free_result($result);
			$result->close ();
			return (true); // the user mobile exists in DB already
		} else {
			// mysqli_free_result($result);
			$result->close ();
			return (false); // the user mobile does not exist in DB
		}
	}
	
	// =====================================================
	// Name: checkUserTagId
	// Return: true -- user tag id exists in Database already
	// false -- user tag id does not exist in Database
	// Parameter: user tag id
	// Description: check if user tag id existed in specific user account table database
	// =====================================================
	public function checkUserTagId($userTagId) {
		// Query the tag id column
		$strQuery = 'SELECT * FROM ' . $this->dbTblName . ' WHERE user_tag_id=\'' . $userTagId . '\'';
		
		$result = $this->mysqli->query ( $strQuery );
		if ($result->num_rows > 0) {
			// mysqli_free_result($result);
			$result->close ();
			return (true); // the user tag id exists in DB already
		} else {
			// mysqli_free_result($result);
			$result->close ();
			return (false); // the user tag id does not exist in DB
		}
	}
	
	// =====================================================
	// Name: addUserRegisterInfo
	// Return: true -- Add user register information succesfully
	// false -- Add user register information failed
	// Parameter: user mobile
	// Description: Add user register information to database
	// =====================================================
	public function addUserRegisterInfo(&$arrayUser) {
		// Compose the query string
		$strQuery = "INSERT INTO " . $this->dbTblName . " (";
		$strQuery .= UserDefinition::USER_DB_FIELD_NAME . ", ";
		$strQuery .= UserDefinition::USER_DB_FIELD_MOBILE . ", ";
		$strQuery .= UserDefinition::USER_DB_FIELD_EMAIL . ", ";
		$strQuery .= UserDefinition::USER_DB_FIELD_PASSWORD . ", ";
		$strQuery .= UserDefinition::USER_DB_FIELD_POSTAL_CODE . ", ";
		$strQuery .= UserDefinition::USER_DB_FIELD_TAG . ") VALUES ( ";
		$strQuery .= '\'' . $arrayUser [UserDefinition::REG_NAME_ID] . '\', '; // Add the user name value
		$strQuery .= '\'' . $arrayUser [UserDefinition::REG_MOBILE_ID] . '\', '; // Add the user mobile value
		$strQuery .= '\'' . $arrayUser [UserDefinition::REG_EMAIL_ID] . '\', '; // Add the user email value
		$strQuery .= '\'' . $arrayUser [UserDefinition::REG_PASSWORD_ID] . '\', '; // Add the user password value
		$strQuery .= '\'' . $arrayUser [UserDefinition::REG_POSTAL_CODE_ID] . '\', '; // Add the user postal code value
		$strQuery .= '\'' . $arrayUser [UserDefinition::REG_TAG_ID] . '\')'; // Add the user postal code value
		                                                                 
		// $sql = "INSERT INTO mytable (username, password, email, regdate)VALUES('??', '$password',
		                                                                 // '12345@163.com', $regdate)";
		
		$result = $this->mysqli->query ( $strQuery );
		if ($result) {
			// mysqli_free_result($result);
			// $result->close();
			return true; // Add register data to DB succes
		} else {
			// mysqli_free_result($result);
			// $result->close();
			return false; // Add register data to DB Failed
		}
	}
	
	// =====================================================
	// Name: getUserInfoByEmail
	// Return: UserInfoSet -- User info
	// NULL -- quey to DB failed
	// Parameter: user email
	// Description: Get user info by index of email
	// =====================================================
	public function getUserInfoByEmail($userEmail) {
		$strTemp = UserDefinition::STR_NULL_DATA;
		$out = new UserInfoSet ( $strTemp, $strTemp, $strTemp, $strTemp, $strTemp );
		
		// Compose the query string
		// Query the email column
		$strQuery = "SELECT * FROM " . $this->dbTblName . ' WHERE user_email=\'' . $userEmail . '\'';
		
		$result = $this->mysqli->query ( $strQuery );
		
		if ($result->num_rows > 0) {
			// $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			$row = $result->fetch_assoc ();
			
			$out->setUserName ( $row [UserDefinition::USER_DB_FIELD_NAME] );
			$out->setMobile ( $row [UserDefinition::USER_DB_FIELD_MOBILE] );
			$out->setEmail ( $row [UserDefinition::USER_DB_FIELD_EMAIL] );
			$out->setPassword ( $row [UserDefinition::USER_DB_FIELD_PASSWORD] );
			$out->setPostalCode ( $row [UserDefinition::USER_DB_FIELD_POSTAL_CODE] );
			$out->setTagId ( $row [UserDefinition::USER_DB_FIELD_TAG] );
			$out->setRegDate ( $row [UserDefinition::USER_DB_FIELD_REG_DATE] );
			$out->setUserStatus ( $row [UserDefinition::USER_DB_FIELD_STATUS] );
			
			// mysqli_free_result($result);
			$result->close ();
			return $out;
		} else {
			// mysqli_free_result($result);
			$result->close ();
			return null;
		}
	}
	
	// =====================================================
	// Name: getUserInfoByMobile
	// Return: UserInfoSet -- User info
	// NULL -- quey to DB failed
	// Parameter: user mobile
	// Description: Get user info by index of email
	// =====================================================
	public function getUserInfoByMobile($userMobile) {
		$strTemp = UserDefinition::STR_NULL_DATA;
		$out = new UserInfoSet ( $strTemp, $strTemp, $strTemp, $strTemp, $strTemp );
		// Compose the query string
		// Query the email column
		$strQuery = "SELECT * FROM " . $this->dbTblName . ' WHERE user_mobile=\'' . $userMobile . '\'';
		$result = $this->mysqli->query ( $strQuery );
		
		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc ();
			
			$out->setUserName ( $row [UserDefinition::USER_DB_FIELD_NAME] );
			$out->setMobile ( $row [UserDefinition::USER_DB_FIELD_MOBILE] );
			$out->setEmail ( $row [UserDefinition::USER_DB_FIELD_EMAIL] );
			$out->setPassword ( $row [UserDefinition::USER_DB_FIELD_PASSWORD] );
			$out->setPostalCode ( $row [UserDefinition::USER_DB_FIELD_POSTAL_CODE] );
			$out->setTagId ( $row [UserDefinition::USER_DB_FIELD_TAG] );
			$out->setRegDate ( $row [UserDefinition::USER_DB_FIELD_REG_DATE] );
			$out->setUserStatus ( $row [UserDefinition::USER_DB_FIELD_STATUS] );
			
			$result->close ();
			return $out;
		} else {
			$result->close ();
			return null;
		}
	}
	
	// =====================================================
	// Name: deleteUserInfoByEmail
	// Return: SUCCESS -- delete record from table successfully
	// ERROR -- Failed to delete record
	// Parameter: user mobile
	// Description: Delete record according to user email
	// =====================================================
	public function deleteUserInfoByEmail($userEmail) {
		// Compose the query string
		// Query the email column
		$strQuery = "DELETE FROM " . $this->dbTblName . " WHERE user_email=\'" . $userEmail . "\'";
		
		$result = $this->mysqli->query ( $strQuery );
		if ($result) {
			$result->close ();
			return true; // Delete data success
		} else {
			$result->close ();
			return false; // Delete data Failed
		}
	}
	
	// =====================================================
	// Name: deleteUserInfoByMobile
	// Return: SUCCESS -- delete record from table successfully
	// ERROR -- Failed to delete record
	// Parameter: user mobile
	// Description: Delete record according to user mobile
	// =====================================================
	public function deleteUserInfoByMobile($userMobile) {
		// Compose the query string
		// Query the email column
		$strQuery = "DELETE FROM " . $this->dbTblName . " WHERE user_mobile=\'" . $userMobile . "\'";
		
		$result = $this->mysqli->query ( $strQuery );
		if ($result) {
			$result->close ();
			return true; // Delete data success
		} else {
			$result->close ();
			return false; // Delete data Failed
		}
	}
}

?>