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
use NeoWeb\Common\Common\AllTableInfoDefinition;

/**
 * Name : InstallationModel
 * Input : N/A
 * Output: N/A
 * Description: model for all admin installation related management:
 * Create all tables, etc
 */
class InstallationModel extends MyModel {
	
	// =====================================================
	// Name: createMerchantMoreInfoTbl
	// Return: true -- potential business account table created
	// false -- potential business table failed to create
	// Parameter: business potential account table name
	// Description: create the potential business account table
	// =====================================================
	public function createMerchantMoreInfoTbl($tableName) {
		$retVal = false;
		// Step 1: check if table existed in DB
		if ($this->checkTblExist ( $tableName )) {
			$retVal = true; // return due to table found in the DB
		} else {
			// Step 2: create the table if not existed in DB
			$strQuery = "CREATE TABLE " . $tableName;
			$strQuery .= " (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_FULL_NAME . " VARCHAR(100) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_BN_NAME . " VARCHAR(100) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_EMAIL . " VARCHAR(100) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_PHONE . " VARCHAR(15) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_DATE . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_STATUS . " TINYINT DEFAULT 1";
			$strQuery .= ")";
			
			$result = $this->db->execute ( $strQuery );
			
			if (! is_bool ( $result )) {
				$retVal = true;
			}
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: createGeneralInTouchTbl
	// Return: true -- Table created
	// false -- table created failed
	// Parameter: general enquiry form table
	// Description: create the general business account message table
	// =====================================================
	public function createGeneralInTouchTbl($tableName) {
		$retVal = false;
		// Step 1: check if table existed in DB
		if ($this->checkTblExist ( $tableName )) {
			$retVal = true; // return due to table found in the DB
		} else {
			// Step 2: create the table if not existed in DB
			$strQuery = "CREATE TABLE " . $tableName;
			$strQuery .= " (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_FULL_NAME . " VARCHAR(30) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_EMAIL . " VARCHAR(100) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_MSG . " VARCHAR(500) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_DATE . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_MSG_FLAG . " TINYINT DEFAULT 1";
			$strQuery .= ")";
			
			$result = $this->db->execute ( $strQuery );
			
			if (! is_bool ( $result )) {
				$retVal = true;
			}
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: createTempMerchantAccountTbl
	// Return: true -- potential business account table created
	// false -- potential business table failed to create
	// Parameter: business potential account table name
	// Description: create the potential business account table
	// =====================================================
	public function createTempMerchantAccountTbl($tableName) {
		$retVal = false;
		// Step 1: check if table existed in DB
		if ($this->checkTblExist ( $tableName )) {
			$retVal = true; // return due to table found in the DB
		} else {
			// Step 2: create the table if not existed in DB
			$strQuery = "CREATE TABLE " . $tableName;
			$strQuery .= " (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_FULL_NAME . " VARCHAR(100) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_BN_NAME . " VARCHAR(100) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_EMAIL . " VARCHAR(100) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_PHONE . " VARCHAR(15) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_EMAIL_ALT . " VARCHAR(100),";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_MOBILE . " VARCHAR(15),";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_TYPE . " TINYINT DEFAULT 0,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ADDRESS . " VARCHAR(100),";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_CITY . " VARCHAR(50),";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_PROVINCE . " TINYINT,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_COUNTRY . " TINYINT,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_POSTAL_CODE . " VARCHAR(20),";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ID . " VARCHAR(30) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_PW . " VARCHAR(36),";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_REG_DATE . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_STATUS . " TINYINT DEFAULT 1";
			$strQuery .= ")";
			
			$result = $this->db->execute ( $strQuery );
			
			if (! is_bool ( $result )) {
				$retVal = true;
			}
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: createMerchantAccountTbl
	// Return: true -- formal business account table created
	// false -- formal business table failed to create
	// Parameter: business formal account table name
	// Description: create the formal business account table
	// =====================================================
	public function createMerchantAccountTbl($tableName) {
		$retVal = false;
		// Step 1: check if table existed in DB
		if ($this->checkTblExist ( $tableName )) {
			$retVal = true; // return due to table found in the DB
		} else {
			// Step 2: create the table if not existed in DB
			$strQuery = "CREATE TABLE " . $tableName;
			$strQuery .= " (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
			
			$strQuery .= AllTableInfoDefinition::DB_FIELD_FIRST_NAME . " VARCHAR(50) NOT NULL,"; // First Name
			$strQuery .= AllTableInfoDefinition::DB_FIELD_LAST_NAME . " VARCHAR(50) NOT NULL,"; // Last Name
			$strQuery .= AllTableInfoDefinition::DB_FIELD_BUSINESS_NAME . " VARCHAR(100) NOT NULL,"; // Business Name
			$strQuery .= AllTableInfoDefinition::DB_FIELD_BUSINESS_ID . " VARCHAR(50) NOT NULL,"; // Business ID
			$strQuery .= AllTableInfoDefinition::DB_FIELD_PASSWORD . " VARCHAR(32) NOT NULL,"; // Password
			
			$strQuery .= AllTableInfoDefinition::DB_FIELD_EMAIL . " VARCHAR(100) NOT NULL,"; // Email
			$strQuery .= AllTableInfoDefinition::DB_FIELD_PHONE . " VARCHAR(15) NOT NULL,"; // Phone
			$strQuery .= AllTableInfoDefinition::DB_FIELD_MOBILE . " VARCHAR(15),"; // Mobile
			$strQuery .= AllTableInfoDefinition::DB_FIELD_TIME . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP,"; // Create date
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_STATUS . " TINYINT DEFAULT 1,"; // Account status
			
			$strQuery .= AllTableInfoDefinition::DB_FIELD_ADDRESS . " VARCHAR(100),"; // Business Address
			$strQuery .= AllTableInfoDefinition::DB_FIELD_CITY . " VARCHAR(50),"; // Business city
			$strQuery .= AllTableInfoDefinition::DB_FIELD_PROVINCE . " TINYINT,"; // Business province
			$strQuery .= AllTableInfoDefinition::DB_FIELD_COUNTRY . " TINYINT,"; // Business Country
			$strQuery .= AllTableInfoDefinition::DB_FIELD_POSTAL_CODE . " VARCHAR(20)"; // Business Postal Code
			$strQuery .= ")";
			
			$result = $this->db->execute ( $strQuery );
			
			if (! is_bool ( $result )) {
				$retVal = true;
			}
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: createDashboard1AccountMsgTbl
	// Return: true -- potential business account msg table created
	// false -- potential business account msg table created failed
	// Parameter: business potential account message table name
	// Description: create the potential business account message table
	// =====================================================
	public function createDashboard1AccountMsgTbl($tableName) {
		$retVal = false;
		// Step 1: check if table existed in DB
		if ($this->checkTblExist ( $tableName )) {
			$retVal = true; // return due to table found in the DB
		} else {
			// Step 2: create the table if not existed in DB
			$strQuery = "CREATE TABLE " . $tableName;
			$strQuery .= " (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ID . " VARCHAR(30) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_MSG_SUBJECT . " VARCHAR(100) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_MSG . " VARCHAR(300) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_REG_DATE . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_MSG_FLAG . " TINYINT DEFAULT 1";
			$strQuery .= ")";
			
			$result = $this->db->execute ( $strQuery );
			
			if (! is_bool ( $result )) {
				$retVal = true;
			}
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: createNeoProductInfoTbl
	// Return: true -- Neo product information table created
	// false -- Neo product information table creation failed
	// Parameter: Neo product information table name
	// Description: Neo product information table
	// =====================================================
	public function createNeoProductInfoTbl($tableName) {
		$retVal = false;
		// Step 1: check if table existed in DB
		if ($this->checkTblExist ( $tableName )) {
			$retVal = true; // return due to table found in the DB
		} else {
			// Step 2: create the table if not existed in DB
			$strQuery = "CREATE TABLE " . $tableName;
			$strQuery .= " (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_PRODUCT_NAME . " VARCHAR(40) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_SET_UP_FEE . " DECIMAL(5,2) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_MONTHLY_FEE . " DECIMAL(5,2) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_PRODUCT_DETAIL . " VARCHAR(300) NOT NULL";
			$strQuery .= ")";
			
			$result = $this->db->execute ( $strQuery );
			
			if (! is_bool ( $result )) {
				$retVal = true;
			}
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: createNeoTagInfoTbl
	// Return: true -- Neo Tag information table created
	// false -- Neo Tag information table creation failed
	// Parameter: Neo Tag information table name
	// Description: Neo Tag information table
	// =====================================================
	public function createNeoTagInfoTbl($tableName) {
		$retVal = false;
		// Step 1: check if table existed in DB
		if ($this->checkTblExist ( $tableName )) {
			$retVal = true; // return due to table found in the DB
		} else {
			// Step 2: create the table if not existed in DB
			$strQuery = "CREATE TABLE " . $tableName;
			$strQuery .= " (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_ID . " VARCHAR(10) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_INDEX . " VARCHAR(5) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_SRC . " DECIMAL(1) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_NUMBER . " VARCHAR(20) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_LABEL . " VARCHAR(100) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::BN_DB_FIELD_ID . " VARCHAR(30) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_STATUS . " TINYINT DEFAULT 1,"; // default is enabled
			$strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_WEB_PAGE . " VARCHAR(150) NOT NULL";
			$strQuery .= ")";
			
			$result = $this->db->execute ( $strQuery );
			
			if (! is_bool ( $result )) {
				$retVal = true;
			}
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: createTagScanErrorEventLogTbl
	// Return: true -- Neo Tag scan error event log table created
	// false -- Neo Tag scan error event log table creation failed
	// Parameter: Neo Tag scan error event log table name
	// Description: Neo Tag scan error event log table
	// =====================================================
	public function createTagScanErrorEventLogTbl($tableName) {
		$retVal = false;
		// Step 1: check if table existed in DB
		if ($this->checkTblExist ( $tableName )) {
			$retVal = true; // return due to table found in the DB
		} else {
			// Step 2: create the table if not existed in DB
			$strQuery = "CREATE TABLE " . $tableName;
			$strQuery .= " (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_ID . " VARCHAR(20) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_TIME . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
			$strQuery .= ")";
			
			echo ($strQuery);
			
			$result = $this->db->execute ( $strQuery );
			
			if (! is_bool ( $result )) {
				$retVal = true;
			}
		}
		return $retVal;
	}
	
	// =====================================================
	// Name: createAdminAccountTbl
	// Return: true -- Create admin table created
	// false -- Neo Tag scan error event log table creation failed
	// Parameter: Neo Tag scan error event log table name
	// Description: Neo Tag scan error event log table
	// =====================================================
	public function createAdminAccountTbl($tableName) {
		$retVal = false;
		// Step 1: check if table existed in DB
		if ($this->checkTblExist ( $tableName )) {
			$retVal = true; // return due to table found in the DB
		} else {
			// Step 2: create the table if not existed in DB
			$strQuery = "CREATE TABLE " . $tableName;
			$strQuery .= " (id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_FIRST_NAME . " VARCHAR(26) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_LAST_NAME . " VARCHAR(26) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_EMAIL . " VARCHAR(100) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_PHONE . " VARCHAR(15),";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_MOBILE . " VARCHAR(15) NOT NULL,";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_STATUS . " TINYINT DEFAULT 1,"; // default as active
			$strQuery .= AllTableInfoDefinition::DB_FIELD_LEVEL . " TINYINT DEFAULT 1,"; // default as level 1
			$strQuery .= AllTableInfoDefinition::DB_FIELD_PASSWORD . " VARCHAR(35) NOT NULL,"; // Save the md5 hash value
			$strQuery .= AllTableInfoDefinition::DB_FIELD_ADDRESS . " VARCHAR(100),";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_CITY . " VARCHAR(50),";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_PROVINCE . " VARCHAR(30),";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_COUNTRY . " VARCHAR(30),";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_POSTAL_CODE . " VARCHAR(20),";
			$strQuery .= AllTableInfoDefinition::DB_FIELD_ADMIN_ID . " TINYINT NOT NULL,"; // Admin ID is int from 1 -- 100
			$strQuery .= AllTableInfoDefinition::DB_FIELD_TIME . " TIMESTAMP DEFAULT CURRENT_TIMESTAMP";
			$strQuery .= ")";
			
			$result = $this->db->execute ( $strQuery );
			
			if (! is_bool ( $result )) {
				$retVal = true;
			}
		}
		return $retVal;
	}
}

