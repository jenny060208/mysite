<?php

// +----------------------------------------------------------------------
// | Service for Business account management
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Home\Logic;

use Home\Model\BusinessModel;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\SysDefinition;
use NeoWeb\Common\Common\SysUtility;
use NeoWeb\Common\Common\EmailUtility;
use NeoWeb\Common\Common\BusinessDefinition;
use NeoWeb\Common\Common\BusinessInfoSet;

/**
 * Name : BusinessRegistLogic
 * Input : N/A
 * Output: N/A
 * Description: Logic for user account regist
 */
class BusinessRegistLogic extends Logic {
	/* User model automatic complete */
	
	/**
	 * Name : registBnTempAccount
	 * Input : $reg_data -- business register data
	 * Output: array -- register process result
	 *
	 * Description: business account temp register
	 */
	public function registBnTempAccount($reg_data) {
		$result = array ();
		$result ["status"] = CommonDefinition::SUCCESS;
		$result ["info"] = "";
		
		$bnSet = new BusinessInfoSet ( trim ( $reg_data->name ), trim ( $reg_data->email ), trim ( $reg_data->phone ), trim ( $reg_data->company_name ) );
		
		// check business registeration data
		$sysUtil = new SysUtility ();
		
		if (! $sysUtil->checkFormField ( $bnSet->getFullName (), CommonDefinition::REG_NAME_ID )) {
			$result ["info"] .= " FULL_NAME ";
		}
		
		if (! $sysUtil->checkFormField ( $bnSet->getEmail (), CommonDefinition::REG_EMAIL_ID )) {
			$result ["info"] .= " EMAIL ";
		}
		
		if (! $sysUtil->checkFormField ( $bnSet->getPhone (), CommonDefinition::REG_MOBILE_ID )) {
			$result ["info"] .= " PHONE ";
		}
		
		if (! $sysUtil->checkFormField ( $bnSet->getBusinessName (), CommonDefinition::REG_NAME_ID )) {
			$result ["info"] .= " BUSINESS_NAME ";
		}
		
		if (! empty ( $result ['info'] )) {
			// Check input data failed, return with error
			$result ['status'] = CommonDefinition::ERROR_CHECK_FIELD;
			// Return due to field check error
			return ($result);
		}
		
		$regModel = new BusinessModel ( SysDefinition::USER_DB_CONFIG );
		
		// Connect to Database
		$db_bn_conn = $regModel->connect ();
		
		if (! $db_bn_conn) {
			$result ['status'] = CommonDefinition::ERROR_CONN;
			$result ['info'] = "Failed to connect to Server!";
			// Connect to DB failed return without further handling
			return ($result);
		}
		
		// Pass the email duplication check, start to register account
		// Start to process the account info
		$tblName = $sysUtil->genDashboard1AcntTblName ();
		
		// set the table name
		$regModel->setTableName ( $tblName );
		
		// Check email duplication
		if ($regModel->checkBusinessEmail ( $bnSet->getEmail () )) {
			// return due to email duplicated
			$result ['status'] = CommonDefinition::ERROR_DUPLICATION_FIELD;
			$result ['info'] = "Warning: This email is already in use!!!";
			
			$regModel->close ();
			return ($result);
		} else if ($regModel->checkBusinessPhone ( $bnSet->getPhone () )) {
			// return due to email duplicated
			$result ['status'] = CommonDefinition::ERROR_DUPLICATION_FIELD;
			$result ['info'] = "Warning: This phone is already in use!!!";
			
			$regModel->close ();
			return ($result);
		}
		
		// Create user tag id
		$repeatFlag = true;
		while ( $repeatFlag ) {
			$newBnId = $sysUtil->generateBnTempId ( $bnSet->getPhone () );
			
			if (! $regModel->checkBusinessId ( $newBnId )) {
				// new tag id is not duplicated,
				$bnSet->setBusinessId ( $newBnId );
				// exit if new tag id is new
				$repeatFlag = FALSE;
			}
		}
		
		// Generate the temp password, md5 hash value for full name, email, phone and business name
		// create the md5 hash value, use the first the 4 digits of the created hash value
		$tempPw = $bnSet->getFullName () . $bnSet->getEmail () . $bnSet->getPhone () . $bnSet->getBusinessName ();
		
		$tempPw = md5 ( $tempPw );
		$tempPw = substr ( $tempPw, 0, 4 );
		$bnSet->setPassword ( $tempPw );
		
		if (! $regModel->addDashboard1AcntRegisterInfo ( $bnSet )) {
			$result ['status'] = CommonDefinition::ERROR_CONN;
			$result ['info'] = "ERROR: Create business account failed!!!";
		} else {
			$result ['status'] = CommonDefinition::SUCCESS;
			$result ['info'] = "Congratulations! Thanks, Our representative will contact you soon! An email will sent you soon with temp password included!";
		}
		
		$regModel->close ();
		
		$emailUtl = new EmailUtility ( SysDefinition::BN_EMAIL_CONFIG );
		// Notofication Email to merchant registered
		$result ["msg"] ["1"] = $emailUtl->sendEmail ( $bnSet->getEmail (), $bnSet->getFullName (), "Message From Neo Reward", "Dear " . $bnSet->getFullName () . ": Thanks for your interesting, We will contact you soon! Your temp password is: " . $tempPw );
		
		// Notofication email to our sales team
		$result ["msg"] ["2"] = $emailUtl->sendEmail ( SysDefinition::NEO_ADMIN_EMAIL, SysDefinition::NEO_ADMIN_NAME, "New Merchant registration!", "Hi, A new merchant is interesting to our platform and enquiry more information.
          Please contact this merchant Full Name: " . $bnSet->getFullName () . " Email: " . $bnSet->getEmail () . " Phone: " . $bnSet->getPhone () . "Merchant Name: " . $bnSet->getBusinessName () . " " . "Thanks! Message from Sales team" );
		
		return ($result);
	}
}
