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
use NeoWeb\Common\Common\BusinessDefinition;
use NeoWeb\Common\Common\BusinessInfoSet;

/**
 * Name : BusinessPwRecoverLogic
 * Input : N/A
 * Output: N/A
 * Description: Logic for user password recover
 */
class BusinessPwRecoverLogic extends Logic {
	/* User model automatic complete */
	
	/**
	 * Name : pwRecoverByEmail
	 * Input : User email
	 * Output: array -- register process result
	 *
	 * Description: user sign in verification
	 */
	public function pwRecoverByEmail($pw_recv_data) {
		$result = array ();
		$result ['status'] = CommonDefinition::ERROR_CHECK_FIELD;
		$result ['info'] = "Email empty or not valid";
		$result ['url'] = "unknown";
		
		$bnSet = new BusinessInfoSet ( CommonDefinition::STR_NULL_DATA, // Full name,
trim ( $pw_recv_data->business_email ), // Business email
CommonDefinition::STR_NULL_DATA, // Business phone
CommonDefinition::STR_NULL_DATA, // Business name
CommonDefinition::STR_NULL_DATA, // Password
CommonDefinition::STR_NULL_DATA, // business ID
CommonDefinition::STR_NULL_DATA, // Reg Date
CommonDefinition::STR_NULL_DATA ); // User Status
		                                  
		// check user sign in data
		$bnUtil = new SysUtility ();
		
		if (! $bnUtil->checkFormField ( $bnSet->getEmail (), CommonDefinition::REG_EMAIL_ID )) {
			return ($result); // return due to check form item failed
		}
		
		$pwRecvModel = new BusinessModel ( SysDefinition::USER_DB_CONFIG );
		// Connect to Database
		$db_bn_conn = $pwRecvModel->connect ();
		
		if (! $db_bn_conn) {
			$result ['status'] = CommonDefinition::ERROR_CONN;
			$result ['info'] = "Failed to connect to Server!";
			return ($result); // Connect to DB failed return without further handling
		}
		
		// get the user info table name by the received email
		$bnDbTblName = $pwRecvModel->getBnAccountTblNameByEmail ( $bnSet->getEmail () );
		
		if (! is_bool ( $bnDbTblName )) {
			// set the user db table name
			$pwRecvModel->setTableName ( $bnDbTblName );
			$queryResult = $pwRecvModel->getBusinessAccountByEmail ( $bnSet->getEmail () );
			
			if (! is_bool ( $queryResult )) {
				// password match
				$result ['status'] = CommonDefinition::SUCCESS;
				$result ['info'] = "Password recover is sent to your email!!";
				$result ['url'] = "http://www.google.com";
			}
		}
		
		$pwRecvModel->close ();
		return ($result);
	}
}
