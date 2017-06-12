<?php

// +----------------------------------------------------------------------
// | Model for user account management
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Admin\Model;

use Think\MyModel;
// use NeoWeb\Common\Common\SysDefinition;
use NeoWeb\Common\Common\SysUtility;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\BusinessDefinition;
use NeoWeb\Common\Common\BusinessInfoSet;
use NeoWeb\Common\Common\AllTableInfoDefinition;
use NeoWeb\Common\Common\NeoInfoSet;
use NeoWeb\Admin\Common\AdminDefinition;

/**
 * Name : AccountModel
 * Input : N/A
 * Output: N/A
 * Description: model for all admin account management:
 * Register/Login/Logout/Password recover, etc
 */
class AccountModel extends MyModel {
	
	// =====================================================
	// Name: checkEmailDuplication
	// Return: true -- Email duplicates in Database
	// false -- Email does not duplicate in Database
	// Parameter: email, bid
	// Description: check if email duplication in admin account table database
	// =====================================================
	public function checkEmailDuplication($email) {
		$retVal = false;
		
		// Query the email column
		// $strQuery = 'SELECT * FROM '.$this->dbTblName.' WHERE bn_email=\''.$email.'\'';
		// Query the email column with better performance
		$strQuery = "SELECT " . AllTableInfoDefinition::DB_FIELD_ADMIN_ID . " FROM " . $this->dbTblName . ' WHERE email=\'' . $email . '\'';
		
		$result = $this->db->query ( $strQuery );
		
		if (! is_bool ( $result )) {
			if ($this->db->getRowNumber () >= 1) {
				// More than one email found, means duplication found
				$retVal = true;
			}
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: checkMobileDuplication
	// Return: true -- Mobile duplicates in Database
	// false -- Mobile does not duplicate in Database
	// Parameter: Mobile
	// Description: check if Mobile duplication in admin account table database
	// =====================================================
	public function checkMobileDuplication($mobile) {
		$retVal = false;
		
		// Query the mobile column
		// $strQuery = 'SELECT * FROM '.$this->dbTblName.' WHERE bn_email=\''.$email.'\'';
		// Query the mobile column with better performance
		$strQuery = "SELECT " . AllTableInfoDefinition::DB_FIELD_ADMIN_ID . " FROM " . $this->dbTblName . ' WHERE mobile=\'' . $mobile . '\'';
		
		$result = $this->db->query ( $strQuery );
		
		if (! is_bool ( $result )) {
			if ($this->db->getRowNumber () > 1) {
				// More than one mobile found, means duplication found
				$retVal = true;
			}
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: checkBusinessId
	// Return: true -- business id exists in Database already
	// false -- business id does not exist in Database
	// Parameter: business id
	// Description: check if business id existed in specific business account table database
	// =====================================================
	public function checkBusinessId($businessId) {
		$retVal = false;
		// Query the tag id column
		// $strQuery = 'SELECT * FROM '.$this->dbTblName.' WHERE bn_id=\''.$businessId.'\'';
		// Query the tag id column with better performance
		$strQuery = "SELECT " . AllTableInfoDefinition::BN_DB_FIELD_EMAIL . " FROM " . $this->dbTblName . ' WHERE bn_id=\'' . $businessId . '\'';
		
		$result = $this->db->query ( $strQuery );
		
		if (! is_bool ( $result )) {
			if ($this->db->getRowNumber () >= 1) {
				$retVal = true;
			}
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: checkBusinessPhone
	// Return: true -- business phone exists in Database table already
	// false -- business phone does not exist in Database table
	// Parameter: business phone
	// Description: check if business phone existed in specific business account table database
	// =====================================================
	public function checkBusinessPhone($phone) {
		$retVal = false;
		// Query the tag id column
		// $strQuery = 'SELECT * FROM '.$this->dbTblName.' WHERE bn_phone=\''.$phone.'\'';
		
		// Query the business column with better performance
		$strQuery = "SELECT " . AllTableInfoDefinition::BN_DB_FIELD_ID . " FROM " . $this->dbTblName . ' WHERE bn_phone=\'' . $phone . '\'';
		
		$result = $this->db->query ( $strQuery );
		
		if (! is_bool ( $result )) {
			if ($this->db->getRowNumber () >= 1) {
				$retVal = true;
			}
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: addAcntRegisterInfo
	// Return: true -- Add admin account register information succesfully
	// false -- Add admin account register information failed
	// Parameter: admin account register information
	// Description: Add admin account information to database
	// =====================================================
	public function addAcntRegisterInfo($accountSet) {
		$retVal = false;
		
		// Compose the query string
		$strQuery = "INSERT INTO " . $this->dbTblName . " (";
		$strQuery .= AllTableInfoDefinition::DB_FIELD_FIRST_NAME . ", "; // First name
		$strQuery .= AllTableInfoDefinition::DB_FIELD_LAST_NAME . ", "; // Last name
		$strQuery .= AllTableInfoDefinition::DB_FIELD_EMAIL . ", "; // email
		$strQuery .= AllTableInfoDefinition::DB_FIELD_PHONE . ", "; // Phone
		$strQuery .= AllTableInfoDefinition::DB_FIELD_MOBILE . ", "; // Mobile
		$strQuery .= AllTableInfoDefinition::DB_FIELD_ADMIN_ID . ", "; // Admin ID
		$strQuery .= AllTableInfoDefinition::DB_FIELD_PASSWORD . ") VALUES ( "; // Password
		$strQuery .= '\'' . $accountSet->getFirstName () . '\', '; // Add first name value
		$strQuery .= '\'' . $accountSet->getLastName () . '\', '; // Add first name value
		$strQuery .= '\'' . $accountSet->getEmail () . '\', '; // Add email value
		$strQuery .= '\'' . $accountSet->getPhone () . '\', '; // Add phone value
		$strQuery .= '\'' . $accountSet->getMobile () . '\', '; // Add business name value
		$strQuery .= '\'' . $accountSet->getUid () . '\', '; // Add business name value
		$strQuery .= '\'' . $accountSet->getPassword () . '\')'; // Add business ID value
		                                                        
		// $sql = "INSERT INTO mytable (username, password, email, regdate)VALUES('??', '$password',
		                                                        // '12345@163.com', $regdate)";
		$result = $this->db->execute ( $strQuery );
		
		if (! is_bool ( $result )) {
			$retVal = true;
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: getBnAcntInfoByEmail
	// Return: BusinessInfoSet -- Business info
	// false -- query to DB failed
	// Parameter: business email
	// Description: Get business account info by index of email
	// =====================================================
	public function getAdminAcntInfoByEmail($strEmail) {
		$retVal = false;
		
		$strTemp = CommonDefinition::STR_NULL_DATA;
		$out = new NeoInfoSet ( null );
		
		// Compose the query string
		// Query the email column
		$strQuery = "SELECT * FROM " . $this->dbTblName . ' WHERE email=\'' . $strEmail . '\'';
		
		$result = $this->db->query ( $strQuery );
		
		if (! is_bool ( $result )) {
			if ($this->db->getRowNumber () > 0) {
				$row = $result [0]; // get row information in array format
				
				$out->setFirstName ( $row [AllTableInfoDefinition::DB_FIELD_FIRST_NAME] );
				$out->setLastName ( $row [AllTableInfoDefinition::DB_FIELD_LAST_NAME] );
				$out->setEmail ( $row [AllTableInfoDefinition::DB_FIELD_EMAIL] );
				$out->setPhone ( $row [AllTableInfoDefinition::DB_FIELD_PHONE] );
				$out->setMobile ( $row [AllTableInfoDefinition::DB_FIELD_MOBILE] );
				$out->setStatus ( $row [AllTableInfoDefinition::DB_FIELD_STATUS] );
				$out->setPassword ( $row [AllTableInfoDefinition::DB_FIELD_PASSWORD] );
				$out->setAddress ( $row [AllTableInfoDefinition::DB_FIELD_ADDRESS] );
				$out->setCity ( $row [AllTableInfoDefinition::DB_FIELD_CITY] );
				$out->setProvince ( $row [AllTableInfoDefinition::DB_FIELD_PROVINCE] );
				$out->setCountry ( $row [AllTableInfoDefinition::DB_FIELD_COUNTRY] );
				$out->setPostalCode ( $row [AllTableInfoDefinition::DB_FIELD_POSTAL_CODE] );
				$out->setUid ( $row [AllTableInfoDefinition::DB_FIELD_ADMIN_ID] );
				$out->setRegDate ( $row [AllTableInfoDefinition::DB_FIELD_TIME] );
				
				return $out;
			}
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: getAcntPasswordByEmail
	// Return: NeoInfoSet -- Neo general info
	// false -- query to DB failed
	// Parameter: admin account email
	// Description: Get admin account password by index of email
	// =====================================================
	public function getAcntPasswordByEmail($strEmail) {
		$retVal = false;
		$out = new NeoInfoSet ( null );
		
		// Compose the query string
		// Query the email column to get password
		$strQuery = "SELECT " . AllTableInfoDefinition::DB_FIELD_PASSWORD . " FROM " . $this->dbTblName . ' WHERE email=\'' . $strEmail . '\'';
		$result = $this->db->query ( $strQuery );
		
		if (! is_bool ( $result )) {
			if ($this->db->getRowNumber () > 0) {
				$row = $result [0]; // get row information in array format
				$out->setPassword ( $row [AllTableInfoDefinition::DB_FIELD_PASSWORD] );
				return $out;
			}
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: getAcntPasswordById
	// Return: NeoInfoSet -- Neo general info
	// false -- query to DB failed
	// Parameter: admin account ID
	// Description: Get admin account password by index of id
	// =====================================================
	public function getAcntPasswordById($adminId) {
		$retVal = false;
		$out = new NeoInfoSet ( null );
		
		// Compose the query string
		// Query the bid column to get password
		// $strQuery = "SELECT " . AllTableInfoDefinition::BN_DB_FIELD_PW . " FROM " . $this->dbTblName . ' WHERE
		// bn_email=\'' .
		// $strEmail . '\'';
		
		$strQuery = "SELECT " . AllTableInfoDefinition::DB_FIELD_PASSWORD . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::DB_FIELD_ADMIN_ID . "=" . '\'' . $adminId . '\'';
		
		$result = $this->db->query ( $strQuery );
		
		if (! is_bool ( $result )) {
			if ($this->db->getRowNumber () > 0) {
				$row = $result [0]; // get row information in array format
				$out->setPassword ( $row [AllTableInfoDefinition::DB_FIELD_PASSWORD] );
				return $out;
			}
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: getAcntStatusById
	// Return: BusinessInfoSet -- Business info
	// false -- query to DB failed
	// Parameter: business ID
	// Description: Get business account status by index of id
	// =====================================================
	public function getAcntStatusById($bid) {
		$retVal = false;
		$out = new BusinessInfoSet ( null, null, null, null );
		
		// Compose the query string
		// Query the bid column to get status
		// $strQuery = "SELECT " . AllTableInfoDefinition::BN_DB_FIELD_PW . " FROM " . $this->dbTblName . ' WHERE
		// bn_email=\'' .
		// $strEmail . '\'';
		
		$strQuery = "SELECT " . AllTableInfoDefinition::BN_DB_FIELD_STATUS . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::BN_DB_FIELD_ID . "=" . '\'' . $bid . '\'';
		
		$result = $this->db->query ( $strQuery );
		
		if (! is_bool ( $result )) {
			if ($this->db->getRowNumber () > 0) {
				$row = $result [0]; // get row information in array format
				$out->setStatus ( $row [AllTableInfoDefinition::BN_DB_FIELD_STATUS] );
				return $out;
			}
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: updateAccountPasswordById
	// Return: true -- update success
	// false -- query to DB failed
	// Parameter: business ID
	// $pwSet -- password in business info set
	// Description: Update business account password by index of id
	// =====================================================
	public function updateAccountPasswordById($pwSet, $bid) {
		$retVal = false;
		
		$strQuery = "UPDATE " . $this->dbTblName . " SET ";
		$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_PW . "=" . '\'' . $pwSet->getPassword () . '\'';
		$strQuery .= " WHERE ";
		$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ID . "=" . '\'' . $bid . '\'';
		
		// 'UPDATE runoob_tbl SET runoob_title="Learning JAVA" WHERE runoob_id=3';
		
		// For debug purpose
		// echo ($strQuery);
		
		$result = $this->db->execute ( $strQuery );
		
		if ($result == false) {
			return ($retVal);
		} else {
			$retVal = true;
			return $retVal;
		}
	}
	
	// =====================================================
	// Name: getDashboard1AcntInfoById
	// Return: BusinessInfoSet -- Business info except note
	// false -- query to DB failed
	// Parameter: business ID
	// Description: Get business account info by index of id
	// =====================================================
	public function getDashboard1AcntInfoById($strBid) {
		$retVal = false;
		
		$out = new BusinessInfoSet ( null, null, null, null );
		
		// Compose the query string
		// Query the email column
		$strQuery = "SELECT * FROM " . $this->dbTblName . ' WHERE bn_id=\'' . $strBid . '\'';
		
		$result = $this->db->query ( $strQuery );
		
		if (! is_bool ( $result )) {
			if ($this->db->getRowNumber () > 0) {
				$row = $result [0]; // get row information in array format
				
				$out->setFullName ( $row [AllTableInfoDefinition::BN_DB_FIELD_FULL_NAME] );
				$out->setEmail ( $row [AllTableInfoDefinition::BN_DB_FIELD_EMAIL] );
				$out->setPhone ( $row [AllTableInfoDefinition::BN_DB_FIELD_PHONE] );
				$out->setBusinessName ( $row [AllTableInfoDefinition::BN_DB_FIELD_BN_NAME] );
				$out->setPassword ( $row [AllTableInfoDefinition::BN_DB_FIELD_PW] );
				$out->setBusinessId ( $row [AllTableInfoDefinition::BN_DB_FIELD_ID] );
				$out->setRegDate ( $row [AllTableInfoDefinition::BN_DB_FIELD_REG_DATE] );
				$out->setStatus ( $row [AllTableInfoDefinition::BN_DB_FIELD_STATUS] );
				$out->setEmailAlt ( $row [AllTableInfoDefinition::BN_DB_FIELD_EMAIL_ALT] );
				$out->setMobile ( $row [AllTableInfoDefinition::BN_DB_FIELD_MOBILE] );
				$out->setBnType ( $row [AllTableInfoDefinition::BN_DB_FIELD_TYPE] );
				$out->setAddress ( $row [AllTableInfoDefinition::BN_DB_FIELD_ADDRESS] );
				$out->setCity ( $row [AllTableInfoDefinition::BN_DB_FIELD_CITY] );
				$out->setProvince ( $row [AllTableInfoDefinition::BN_DB_FIELD_PROVINCE] );
				$out->setCountry ( $row [AllTableInfoDefinition::BN_DB_FIELD_COUNTRY] );
				$out->setPostalCode ( $row [AllTableInfoDefinition::BN_DB_FIELD_POSTAL_CODE] );
				
				return $out;
			}
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: updateDashBoard1ProfileInfoById
	// Parameter: $profileSet -- update profile info set
	// $bid -- business ID
	// Return: true -- Update success
	// false -- Update fail
	//
	// Description: Update dashboard 1 profile info
	// =====================================================
	public function updateDashBoard1ProfileInfoById($profileSet, $bid) {
		$retVal = false;
		
		$strQuery = "UPDATE " . $this->dbTblName . " SET ";
		$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_FULL_NAME . "=" . '\'' . $profileSet->getFullName () . '\', ';
		$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_EMAIL . "=" . '\'' . $profileSet->getEmail () . '\', ';
		$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_PHONE . "=" . '\'' . $profileSet->getPhone () . '\', ';
		$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_BN_NAME . "=" . '\'' . $profileSet->getBusinessName () . '\', ';
		$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_MOBILE . "=" . '\'' . $profileSet->getMobile () . '\', ';
		$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_TYPE . "=" . '\'' . $profileSet->getBnType () . '\', ';
		$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ADDRESS . "=" . '\'' . $profileSet->getAddress () . '\', ';
		$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_CITY . "=" . '\'' . $profileSet->getCity () . '\', ';
		$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_PROVINCE . "=" . '\'' . $profileSet->getProvince () . '\', ';
		$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_COUNTRY . "=" . '\'' . $profileSet->getCountry () . '\', ';
		$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_STATUS . "=" . '\'' . $profileSet->getStatus () . '\', ';
		$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_POSTAL_CODE . "=" . '\'' . $profileSet->getPostalCode () . '\'';
		$strQuery .= " WHERE ";
		$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ID . "=" . '\'' . $bid . '\'';
		
		// 'UPDATE runoob_tbl SET runoob_title="Learning JAVA" WHERE runoob_id=3';
		
		// For debug purpose
		// echo ($strQuery);
		
		$result = $this->db->execute ( $strQuery );
		
		if ($result == false) {
			return ($retVal);
		} else {
			$retVal = true;
			return $retVal;
		}
	}
	
	// =====================================================
	// Name: getNextAdminId
	// Parameter: none
	//
	// Return: 1 -- 100 --> valid
	// > 100 --> invalid
	//
	// Description: get next valid admin ID
	// =====================================================
	public function getNextAdminId() {
		for($count = 1; $count <= AdminDefinition::NEO_MAX_ADMIN_ACCOUNT_NUM; $count ++) {
			$strQuery = "SELECT " . AllTableInfoDefinition::DB_FIELD_ADMIN_ID . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::DB_FIELD_ADMIN_ID . "=" . '\'' . $count . '\'';
			
			$result = $this->db->query ( $strQuery );
			
			if (! is_bool ( $result )) {
				if ($this->db->getRowNumber () == 0) {
					return $count;
				}
			} else {
				return $count;
			}
		}
		
		return $count;
	}
	
	// =====================================================
	// Name: createPotentialBnAccountMsgTbl
	// Return: true -- potential business account message table created
	// false -- potential business account message table failed to create
	// Parameter: business potential account message table name
	// Description: create the potential business account message table
	// =====================================================
	// public function createPotentialBnAccountMsgTbl($tableName)
	// {
	// $retVal = false;
	// // Step 1: check if table existed in DB
	// if($this->checkTblExist($tableName))
	// {
	// $retVal = true; //return due to table found in the DB
	// }
	// else
	// {
	// Step 2: create the table if not existed in DB
	// $strQuery = "CREATE TABLE ".$tableName;
	// $strQuery .= " (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
	// $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ID." VARCHAR(30) NOT NULL,";
	// $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_NOTE." VARCHAR(2048) NOT NULL,";
	// $strQuery .= AllTableInfoDefinition::BN_DB_FIELD_STATUS." TINYINT DEFAULT 1" ;
	// $strQuery .= ")";
	
	// $result = $this->db->execute($strQuery);
	//
	// if(!is_bool ($result))
	// {
	// $retVal = true;
	// }
	// }
	// return $retVal;
	// }
}

