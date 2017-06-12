<?php

// +----------------------------------------------------------------------
// | Logic for Admin account sign in
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Admin\Logic;

use NeoWeb\Admin\Common\AdminDefinition;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\SysDefinition;
use NeoWeb\Common\Common\SysUtility;
use NeoWeb\Common\Common\NeoInfoSet;
use Admin\Model\AccountModel;
use NeoWeb\Admin\Common\AdminUtilities;

/**
 * Name : AdminAcntSignInLogic
 * Input : N/A
 * Output: N/A
 * Description: Logic for all admin account sign in process:
 */
class AdminAcntSignInLogic extends Logic {
	/**
	 * Name : signInBusiness
	 * Input : Business sign in data
	 * Output: array --Sign in process result
	 *
	 * Description: business sign in verification
	 */
	public function signInProcess($recvData) {
		$result = array ();
		$result ["status"] = CommonDefinition::SUCCESS_CHECK_FIELD;
		$result ["info"] = "";
		$result ["url"] = "unknown";
		
		$sysUtil = new SysUtility ();
		
		if (! $sysUtil->checkFormField ( $recvData->email, CommonDefinition::REG_EMAIL_ID )) {
			$result ["status"] = CommonDefinition::ERROR_CHECK_FIELD;
			$result ["info"] = "Error! Please enter a valid Email!"; // return due to check form item email failed
			return ($result);
		} else if (! $sysUtil->checkFormField ( $recvData->password, CommonDefinition::REG_PASSWORD_ID )) {
			$result ["status"] = CommonDefinition::ERROR_CHECK_FIELD;
			$result ["info"] .= "Error! Please enter a valid Email!";
			return ($result);
		}
		
		// Password MD5 conversion
		// Received PW
		$pwRecvMd5 = md5 ( $recvData->password );
		// Root password
		$pwRootMd5 = md5 ( AdminDefinition::NEO_ROOT_ACCOUNT_CODE );
		
		// go to the admin root account page
		if ((CommonDefinition::SAME_RESULT == strcmp ( $recvData->email, AdminDefinition::NEO_ROOT_ACCOUNT_NAME )) && (CommonDefinition::SAME_RESULT == strcmp ( $pwRecvMd5, $pwRootMd5 ))) {
			// This is the root account sign in
			// forward to owner root page and return
			$result ["status"] = CommonDefinition::SUCCESS;
			$result ["info"] = "SUCCESS! Owner account sign in";
			$result ["url"] = U ( "Admin/admin_main_panel" );
			return ($result);
		} else {
			// Go to the other admin account page
			// Full name, Business email, Business phone, Business name
			$neoSet = new NeoInfoSet ( $recvData->email );
			$neoSet->setPassword ( $pwRecvMd5 );
			$dbModel = new AccountModel ( SysDefinition::USER_DB_CONFIG );
			
			// Connect to Database
			$db_conn = $dbModel->connect ();
			
			if (! $db_conn) {
				$result ["status"] = CommonDefinition::ERROR_CONN;
				$result ["info"] = "Failed to connect to Server!";
				return ($result); // Connect to DB failed return without further handling
			}
			
			// get the user info table name by the received email
			$adminUtil = new AdminUtilities ();
			
			$TblName = $adminUtil->getAdminAccountInfoTblName ();
			
			// set the table name
			$dbModel->setTableName ( $TblName );
			
			$queryResult = $dbModel->getAdminAcntInfoByEmail ( $neoSet->getEmail () );
			
			if (! is_bool ( $queryResult )) {
				$pwTemp = md5 ( $queryResult->getPassword () );
				
				if (strcasecmp ( $pwTemp, $neoSet->getPassword () ) == CommonDefinition::SAME_RESULT) {
					// password match, sign in process
					$result ["status"] = CommonDefinition::SUCCESS;
					$result ["info"] = "Your account is signed in successfully!";
					$result ["url"] = U ( "Admin/admin_dash_board" );
					// Add business info to session
					session_start ();
					$_SESSION ["admin_id"] = $queryResult->getUid ();
					$_SESSION ["admin_name"] = $queryResult->getFirstName () . " " . $queryResult->getLastName ();
				} else {
					$result ["status"] = CommonDefinition::ERROR;
					$result ["info"] = "Sorry, you don't have access to this page!!!";
				}
			} else {
				$result ["status"] = CommonDefinition::ERROR;
				$result ["info"] = "Sorry, you don't have access to this page!!!";
			}
			
			$dbModel->close ();
			return ($result);
		}
	}
}
