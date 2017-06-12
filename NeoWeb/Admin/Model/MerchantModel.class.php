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
 * Name : MerchantModel
 * Input : N/A
 * Output: N/A
 * Description: model for all merchant account management:
 * Register/Login/Logout/Password recover, etc
 */
class MerchantModel extends MyModel {
	// =====================================================
	// Name: checkEmailDuplication
	// Return: true -- Email duplicates in Database
	// false -- Email does not duplicate in Database
	// Parameter: email, bid
	// Description: check if email duplication in merchant account table database
	// =====================================================
	public function checkEmailDuplication($email) {
		$retVal = false;
		
		$strQuery = "SELECT " . AllTableInfoDefinition::DB_FIELD_BUSINESS_ID . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::DB_FIELD_EMAIL . "=" . '\'' . $email . '\'';
		
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
	// Name: checkPhoneDuplication
	// Return: true -- phone duplicates in Database
	// false -- phone does not duplicate in Database
	// Parameter: phone, bid
	// Description: check if phone duplication in merchant account table database
	// =====================================================
	public function checkPhoneDuplication($phone) {
		$retVal = false;
		
		$strQuery = "SELECT " . AllTableInfoDefinition::DB_FIELD_BUSINESS_ID . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::DB_FIELD_PHONE . "=" . '\'' . $phone . '\'';
		
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
	// Return: true -- mobile duplicates in Database
	// false -- mobile does not duplicate in Database
	// Parameter: mobile, bid
	// Description: check if mobile duplication in merchant account table database
	// =====================================================
	public function checkMobileDuplication($mobile) {
		$retVal = false;
		
		$strQuery = "SELECT " . AllTableInfoDefinition::DB_FIELD_BUSINESS_ID . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::DB_FIELD_MOBILE . "=" . '\'' . $mobile . '\'';
		
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
	// Name: checkMidDuplication
	// Return: true -- business ID duplicates in Database
	// false -- business ID does not duplicate in Database
	// Parameter: bid
	// Description: check if business ID duplication in merchant account table database
	// =====================================================
	public function checkMidDuplication($mid) {
		$retVal = false;
		
		$strQuery = "SELECT " . AllTableInfoDefinition::DB_FIELD_BUSINESS_NAME . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::DB_FIELD_BUSINESS_ID . "=" . '\'' . $mid . '\'';
		
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
	// Name: addAcntRegisterInfo
	// Return: true -- Add merchant account register information succesfully
	// false -- Add merchant account register information failed
	// Parameter: merchant account register information
	// Description: Add merchant account information to database
	// =====================================================
	public function addAcntRegisterInfo($accountSet) {
		$retVal = false;
		
		// Compose the query string
		$strQuery = "INSERT INTO " . $this->dbTblName . " (";
		$strQuery .= AllTableInfoDefinition::DB_FIELD_FIRST_NAME . ", "; // First name
		$strQuery .= AllTableInfoDefinition::DB_FIELD_LAST_NAME . ", "; // Last name
		$strQuery .= AllTableInfoDefinition::DB_FIELD_BUSINESS_NAME . ", "; // Merchant name
		$strQuery .= AllTableInfoDefinition::DB_FIELD_EMAIL . ", "; // email
		$strQuery .= AllTableInfoDefinition::DB_FIELD_PHONE . ", "; // Phone
		$strQuery .= AllTableInfoDefinition::DB_FIELD_MOBILE . ", "; // Mobile
		$strQuery .= AllTableInfoDefinition::DB_FIELD_BUSINESS_ID . ", "; // Admin ID
		$strQuery .= AllTableInfoDefinition::DB_FIELD_PASSWORD . ") VALUES ( "; // Password
		$strQuery .= '\'' . $accountSet->getFirstName () . '\', '; // Add first name value
		$strQuery .= '\'' . $accountSet->getLastName () . '\', '; // Add first name value
		$strQuery .= '\'' . $accountSet->getBusinessName () . '\', '; // Add first name value
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
	// Name: createMerchantScanEventTable
	// Return: SUCCESS -- create table succesfully
	// Error --create table failed
	// Parameter: $tblName
	// Description: create table process
	// =====================================================
	public function createMerchantScanEventTable($tableName) {
		$retVal = false;
		
		$strQuery = "CREATE TABLE " . $tableName;
		$strQuery .= " (id INT(7) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
		$strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_ID . " VARCHAR(10) NOT NULL,"; // Tag ID
		$strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_SRC . " TINYINT NOT NULL,"; // Tag source type
		$strQuery .= AllTableInfoDefinition::DB_FIELD_DEVICE_TYPE . " VARCHAR(20),"; // Scan devuice type
		$strQuery .= AllTableInfoDefinition::DB_FIELD_BROWSER_TYPE . " VARCHAR(30),"; // Scan browser type
		$strQuery .= AllTableInfoDefinition::DB_FIELD_TIME . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP"; // Scan time
		$strQuery .= ")";
		
		$result = $this->db->execute ( $strQuery );
		
		if (! is_bool ( $result )) {
			$retVal = true;
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: createMerchantUserRegisterTable
	// Return: SUCCESS -- create table succesfully
	// Error --create table failed
	// Parameter: $tblName
	// Description: create table process
	// =====================================================
	public function createMerchantUserRegisterTable($tableName) {
		$retVal = false;
		
		$strQuery = "CREATE TABLE " . $tableName;
		$strQuery .= " (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
		$strQuery .= AllTableInfoDefinition::DB_FIELD_FIRST_NAME . " VARCHAR(50) NOT NULL,"; // First Name
		$strQuery .= AllTableInfoDefinition::DB_FIELD_LAST_NAME . " VARCHAR(50) NOT NULL,"; // Last Name
		$strQuery .= AllTableInfoDefinition::DB_FIELD_EMAIL . " VARCHAR(100) NOT NULL,"; // Email
		$strQuery .= AllTableInfoDefinition::DB_FIELD_MOBILE . " VARCHAR(15) NOT NULL,"; // Mobile
		$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_STATUS . " TINYINT DEFAULT 1,"; // Account status
		$strQuery .= AllTableInfoDefinition::DB_FIELD_DEVICE_TYPE . " VARCHAR(20),"; // Scan devuice type
		$strQuery .= AllTableInfoDefinition::DB_FIELD_BROWSER_TYPE . " VARCHAR(30),"; // Scan browser type
		$strQuery .= AllTableInfoDefinition::DB_FIELD_TIME . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP"; // Create date
		$strQuery .= ")";
		
		$result = $this->db->execute ( $strQuery );
		
		if (! is_bool ( $result )) {
			$retVal = true;
		}
		return $retVal;
	}
}

