<?php

// +----------------------------------------------------------------------
// | Logic for Admin account Create
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Admin\Logic;

use Admin\Model\AccountModel;
use NeoWeb\Admin\Common\AdminDefinition;
use NeoWeb\Admin\Common\AdminUtilities;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\SysDefinition;
use NeoWeb\Common\Common\SysUtility;
use NeoWeb\Common\Common\BusinessDefinition;
use NeoWeb\Common\Common\BusinessInfoSet;
use NeoWeb\Common\Common\NeoInfoSet;

/**
 * Name : AdminAcntCreateLogic
 * Input : N/A
 * Output: N/A
 * Description: model for all business account management:
 * Register/Login/Logout/Password recover, etc
 */
class AdminAcntCreateLogic extends Logic {
	/**
	 * Name : createRootAccount
	 * Input : create root account information
	 * Output: array -- create root account process result
	 *
	 * Description: process root account creation
	 */
	public function createRootAccount($recvData) {
		$result = array ();
		$result ["status"] = CommonDefinition::ERROR_CHECK_FIELD;
		$result ["info"] = "Error! Invalid account information.";
		
		// Step 1: check email validation
		// Step 2: check code validation
		// Step 3: check if root account existed already
		
		// Verify the root account name
		$tempStr = trim ( $recvData->create_acnt_email );
		if (strcasecmp ( $tempStr, AdminDefinition::NEO_ROOT_ACCOUNT_NAME ) != CommonDefinition::SAME_RESULT) {
			return (result); // return due to name doesn't match
		}
		
		// Verify the root account code
		$tempStr = trim ( $recvData->create_acnt_code );
		if (strcasecmp ( $tempStr, AdminDefinition::NEO_ROOT_ACCOUNT_CODE ) != CommonDefinition::SAME_RESULT) {
			return (result); // return due to code doesn't match
		}
		
		// check user sign in data
		$bnUtil = new SysUtility ();
		
		if (! $bnUtil->checkFormField ( $bnSet->getEmail (), CommonDefinition::REG_EMAIL_ID )) {
			$result ["info"] .= "EMAIL"; // return due to check form item email failed
		} else if (! $bnUtil->checkFormField ( $bnSet->getPassword (), CommonDefinition::REG_PASSWORD_ID )) {
			$result ["info"] .= " PASSWORD ";
		}
		
		if (! empty ( $result ["info"] )) {
			// Check input data failed, return with error
			$result ["status"] = CommonDefinition::ERROR_CHECK_FIELD;
			return ($result); // Return due to field check error
		}
		
		// convert password to md5 hash
		$md5PwCode = md5 ( $bnSet->getPassword () );
		// Set back to the info set
		$bnSet->setPassword ( $md5PwCode );
		
		$signModel = new BusinessModel ( SysDefinition::USER_DB_CONFIG );
		// Connect to Database
		$db_bn_conn = $signModel->connect ();
		
		if (! $db_bn_conn) {
			$result ["status"] = CommonDefinition::ERROR_CONN;
			$result ["info"] = "Failed to connect to Server!";
			return ($result); // Connect to DB failed return without further handling
		}
		
		// get the user info table name by the received email
		$bnDbTblName = $signModel->getBnAccountTblNameByEmail ( $bnSet->getEmail () );
		
		if (! is_bool ( $bnDbTblName )) {
			// set the user db table name
			$signModel->setTableName ( $bnDbTblName );
			$queryResult = $signModel->getBnAcntInfoByEmail ( $bnSet->getEmail () );
			
			if (! is_bool ( $queryResult )) {
				if (strcasecmp ( $queryResult->getPassword (), $bnSet->getPassword () ) == CommonDefinition::SAME_RESULT) {
					// password match, sign in process
					$result ["status"] = CommonDefinition::SUCCESS;
					$result ["info"] = "Your account is signed in successfully!";
					$result ["url"] = U ( "Business/bn_dashboard" );
					// Add business info to session
					session_start ();
					$_SESSION ["bid"] = $queryResult->getBusinessId ();
					$_SESSION ["bn_name"] = $queryResult->getBusinessName ();
				} else {
					$result ["status"] = CommonDefinition::ERROR;
					$result ["info"] = "Sorry, you don't have access to this page!!!";
				}
			}
		}
		
		$signModel->close ();
		return ($result);
	}
	
	/**
	 * Name : createAdminAccount
	 * Input : create admin account information
	 * Output: array -- create admin account process result
	 *
	 * Description: process admin account creation
	 */
	public function createAdminAccount($recvData) {
		$result = array ();
		$result ["status"] = CommonDefinition::ERROR_CHECK_FIELD;
		$result ["info"] = "Error! Invalid account information.";
		
		// Step 1: check email validation
		// Step 2: check code validation
		// Step 3: check if root account existed already
		
		// check first name
		$sysUtil = new SysUtility ();
		if (! $sysUtil->checkFormField ( $recvData->aa_first_name, CommonDefinition::REG_NAME_ID )) {
			$result ["status"] = CommonDefinition::ERROR_CHECK_FIELD;
			$result ["info"] = "Error! Invalid First Name!!!";
			return ($result);
		}
		
		// check last name
		if (! $sysUtil->checkFormField ( $recvData->aa_last_name, CommonDefinition::REG_NAME_ID )) {
			$result ["status"] = CommonDefinition::ERROR_CHECK_FIELD;
			$result ["info"] = "Error! Invalid Last Name!!!";
			return ($result);
		}
		
		// Check email field
		if (! $sysUtil->checkFormField ( $recvData->aa_email, CommonDefinition::REG_EMAIL_ID )) {
			$result ["status"] = CommonDefinition::ERROR_CHECK_FIELD;
			$result ["info"] = "Error! Invalid Email!!!";
			
			return ($result);
		}
		
		// Check phone field
		if (! $sysUtil->checkFormField ( $recvData->aa_phone, CommonDefinition::REG_MOBILE_ID )) {
			$result ["status"] = CommonDefinition::ERROR_CHECK_FIELD;
			$result ["info"] = "Error! Invalid Phone Number!!!";
			
			return ($result);
		}
		
		// Check mobile field
		if (! $sysUtil->checkFormField ( $recvData->aa_mobile, CommonDefinition::REG_MOBILE_ID )) {
			$result ["status"] = CommonDefinition::ERROR_CHECK_FIELD;
			$result ["info"] = "Error! Invalid Mobile Number!!!";
			
			return ($result);
		}
		
		// Create admin ID,
		// Note: Admin account start with "am"
		// Note: Admin account ID is from AM1001 -- AM 1100 , maximum 100 admin account availaable
		$mModel = new AccountModel ( SysDefinition::USER_DB_CONFIG );
		
		$db_conn = $mModel->connect ();
		
		if (! $db_conn) {
			$result ["status"] = CommonDefinition::ERROR_CONN;
			$result ["info"] = "Failed to connect to Server!";
			return ($result); // Connect to DB failed return without further handling
		}
		
		$adminUtil = new AdminUtilities ();
		$tblName = $adminUtil->getAdminAccountInfoTblName ();
		$mModel->setTableName ( $tblName );
		
		// Check the mobile number and email duplication:
		// Check email duplication
		if ($mModel->checkEmailDuplication ( $recvData->aa_email )) {
			// return due to email duplicated
			$result ['status'] = CommonDefinition::ERROR_DUPLICATION_FIELD;
			$result ['info'] = "Error: This email is already in use!!!";
			
			$mModel->close ();
			return ($result);
		}
		// Check mobile number
		if ($mModel->checkMobileDuplication ( $recvData->aa_mobile )) {
			// return due to email duplicated
			$result ['status'] = CommonDefinition::ERROR_DUPLICATION_FIELD;
			$result ['info'] = "Error: This mobile number is already in use!!!";
			
			$mModel->close ();
			return ($result);
		}
		
		$nextAdminId = $mModel->getNextAdminId ();
		if ($nextAdminId > AdminDefinition::NEO_MAX_ADMIN_ACCOUNT_NUM) {
			$result ["status"] = CommonDefinition::ERROR_CONN;
			$result ["info"] = "Error! Maximum Admin Account reached!" . $nextAdminId;
			$mModel->close ();
			return ($result); // Connect to DB failed return without further handling
		}
		
		// Get the valid account ID in string
		// $adminId = AdminDefinition::NEO_ADMIN_ACCOUNTID_PREFIX . ((string)$nextAdminId);
		
		// Generate temp password
		$tempPw = $adminUtil->generateAdminAccountPassword ( $recvData->aa_first_name, $recvData->aa_email, $recvData->aa_phone );
		
		$neoSet = new NeoInfoSet ( $recvData->aa_email );
		
		$neoSet->setFirstName ( $recvData->aa_first_name );
		$neoSet->setLastName ( $recvData->aa_last_name );
		$neoSet->setPhone ( $recvData->aa_phone );
		$neoSet->setMobile ( $recvData->aa_mobile );
		$neoSet->setUid ( $nextAdminId );
		$neoSet->setPassword ( $tempPw );
		
		if (! $mModel->addAcntRegisterInfo ( $neoSet )) {
			$result ['status'] = CommonDefinition::ERROR_CONN;
			$result ['info'] = "ERROR: Create Admin account failed!!!";
		} else {
			$result ['status'] = CommonDefinition::SUCCESS;
			$result ['info'] = "Success to create the Admin Account! Your Password is " . $tempPw;
		}
		
		$mModel->close ();
		return ($result);
	}
}
