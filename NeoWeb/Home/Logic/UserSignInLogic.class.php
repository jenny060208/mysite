<?php

// +----------------------------------------------------------------------
// | Service for user account management
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Home\Logic;

use Home\Model\UserModel;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\SysDefinition;
use NeoWeb\Common\Common\SysUtility;
use NeoWeb\Common\Common\UserDefinition;
use NeoWeb\Common\Common\UserInfoSet;

/**
 * Name : UserSignInLogic
 * Input : N/A
 * Output: N/A
 * Description: Logic for user account sign in
 */
class UserSignInLogic extends Logic {
	/**
	 * Name : signInUserByEmail
	 * Input : User email, password
	 * Output: array -- register process result
	 *
	 * Description: user sign in verification
	 */
	public function signInUserByEmail($sign_data) {
		$result = array ();
		$result ['status'] = CommonDefinition::ERROR_CHECK_FIELD;
		$result ['info'] = "Email or password is empty or not valid";
		
		$userSet = new UserInfoSet ( null, null, trim ( $sign_data->user_email ), trim ( $sign_data->user_password ) );
		
		// check user sign in data
		$userUtil = new SysUtility ();
		
		if (! $userUtil->checkFormField ( $userSet->getEmail (), CommonDefinition::REG_EMAIL_ID )) {
			return ($result); // return due to check form item failed
		} else if (! $userUtil->checkFormField ( $userSet->getPassword (), CommonDefinition::REG_PASSWORD_ID )) {
			return ($result); // return due to check form item failed
		}
		
		// convert password to md5 hash
		$md5PwCode = md5 ( $userSet->getPassword () );
		// Set back to the user set
		$userSet->setPassword ( $md5PwCode );
		
		$signModel = new UserModel ( SysDefinition::USER_DB_CONFIG );
		// Connect to Database
		$db_user_conn = $signModel->connect ();
		
		if (! $db_user_conn) {
			$result ['status'] = CommonDefinition::ERROR_CONN;
			$result ['info'] = "Failed to connect to Server!";
			return ($result); // Connect to DB failed return without further handling
		}
		
		// get the user info table name by the received email
		$userDbTblName = $signModel->getUserAccountTblNameByEmail ( $userSet->getEmail () );
		
		if (! is_bool ( $userDbTblName )) {
			// set the user db table name
			$signModel->setTableName ( $userDbTblName );
			$queryResult = $signModel->getUserAccountByEmail ( $userSet->getEmail () );
			
			if (! is_bool ( $queryResult )) {
				if (strcasecmp ( $queryResult->getPassword (), $userSet->getPassword () ) == CommonDefinition::SAME_RESULT) {
					// password match and user in active
					if (UserDefinition::USER_STATUS_ACTIVE == $queryResult->getUserStatus ()) {
						$result ['status'] = CommonDefinition::SUCCESS;
						$result ['info'] = "Your account is signed in successfully!";
						$result ['url'] = U ( 'User/index' ); // move to user login index page
						                                  // Add user info to session
						session_start ();
						$_SESSION ['uid'] = $queryResult->getTagId ();
						$_SESSION ['user_name'] = $queryResult->getUserName ();
						return ($result); // Connect to DB failed return without further handling
					}
				}
			}
		}
		
		$signModel->close ();
		return ($result);
	}
}

