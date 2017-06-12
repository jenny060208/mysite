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
use NeoWeb\Common\Common\AllTableInfoDefinition;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\SysDefinition;
use NeoWeb\Common\Common\SysUtility;
use NeoWeb\Common\Common\BusinessDefinition;
use NeoWeb\Common\Common\BusinessInfoSet;

/**
 * Name : BusinessDashBoard1Logic
 * Input : N/A
 * Output: N/A
 * Description: Logic for all business account dashboard 1 (Potential merchant) management:
 * Register/Login/Logout/Password recover, etc
 */
class BusinessDashBoard1Logic extends Logic {
	/**
	 * Name : dashBoard1GenralInfo
	 * Input : business ID
	 * Output: array -- dashboard 1 general info
	 *
	 * Description: get dashboard 1 general info
	 */
	public function dashBoard1GeneralInfo($bid) {
		$result = array ();
		
		$bnUtil = new SysUtility ();
		$bnInfoTblName = $bnUtil->genDashboard1AcntTblName ();
		
		$dbModel = new BusinessModel ( SysDefinition::USER_DB_CONFIG );
		// Connect to Database
		$db_bn_conn = $dbModel->connect ();
		
		if (! $db_bn_conn) {
			return (false); // Connect to DB failed return without further handling
		}
		
		// set the user db table name
		$dbModel->setTableName ( $bnInfoTblName );
		$queryResult = $dbModel->getDashboard1AcntInfoById ( $bid );
		
		if (! is_bool ( $queryResult )) {
			$result ["full_name"] = $queryResult->getFullName ();
			$result ["company_name"] = $queryResult->getBusinessName ();
			$result ["email"] = $queryResult->getEmail ();
			$result ["email_alt"] = $queryResult->getEmailAlt ();
			$result ["phone"] = $queryResult->getPhone ();
			$result ["mobile"] = $queryResult->getMobile ();
			$result ["type"] = $bnUtil->getBusinessType ( $queryResult->getBnType () );
			$result ["address"] = $queryResult->getAddress () . " ";
			$result ["address"] .= $queryResult->getCity () . " ";
			$result ["address"] .= $bnUtil->getProvinceName ( $queryResult->getProvince () );
			$result ["address"] .= $bnUtil->getCountryName ( $queryResult->getCountry () );
			$result ["postal_code"] = $queryResult->getPostalCode ();
			$result ["reg_date"] = $queryResult->getRegDate ();
			$result ["status"] = $queryResult->getStatus ();
			$result ["status_1"] = $bnUtil->convertToStepStatus ( BusinessDefinition::BN_REG_STEP_1, $queryResult->getStatus () );
			$result ["status_2"] = $bnUtil->convertToStepStatus ( BusinessDefinition::BN_REG_STEP_2, $queryResult->getStatus () );
			$result ["status_3"] = $bnUtil->convertToStepStatus ( BusinessDefinition::BN_REG_STEP_3, $queryResult->getStatus () );
			$result ["status_4"] = $bnUtil->convertToStepStatus ( BusinessDefinition::BN_REG_STEP_4, $queryResult->getStatus () );
			$result ["status_5"] = $bnUtil->convertToStepStatus ( BusinessDefinition::BN_REG_STEP_5, $queryResult->getStatus () );
			$result ["status_6"] = $bnUtil->convertToStepStatus ( BusinessDefinition::BN_REG_STEP_6, $queryResult->getStatus () );
			
			$dbModel->close ();
			return ($result);
		} else {
			$dbModel->close ();
			return (false);
		}
	}
	
	/**
	 * Name : dashBoard1ProfileInfoPreload
	 * Input : business ID
	 * Output: array -- Dashboard 1 profile info
	 *
	 * Description: business sign in verification
	 */
	public function dashBoard1ProfileInfoPreload($bid) {
		$result = array ();
		
		$bnUtil = new SysUtility ();
		$bnInfoTblName = $bnUtil->genDashboard1AcntTblName ();
		
		$dbModel = new BusinessModel ( SysDefinition::USER_DB_CONFIG );
		// Connect to Database
		$db_bn_conn = $dbModel->connect ();
		
		if (! $db_bn_conn) {
			return (false); // Connect to DB failed return without further handling
		}
		
		// set the user db table name
		$dbModel->setTableName ( $bnInfoTblName );
		$queryResult = $dbModel->getDashboard1AcntInfoById ( $bid );
		
		if (! is_bool ( $queryResult )) {
			$result ["status"] = CommonDefinition::SUCCESS;
			
			$result ["info"] ["fullName"] = $queryResult->getFullName ();
			$result ["info"] ["companyName"] = $queryResult->getBusinessName ();
			$result ["info"] ["email"] = $queryResult->getEmail ();
			$result ["info"] ["altEmail"] = $queryResult->getEmailAlt ();
			$result ["info"] ["phone"] = $queryResult->getPhone ();
			$result ["info"] ["mobile"] = $queryResult->getMobile ();
			$result ["info"] ["type"] = $bnUtil->getBusinessType ( $queryResult->getBnType () );
			$result ["info"] ["address"] = $queryResult->getAddress ();
			$result ["info"] ["city"] = $queryResult->getCity ();
			$result ["info"] ["province"] = $bnUtil->getProvinceName ( $queryResult->getProvince () );
			$result ["info"] ["country"] = $bnUtil->getCountryName ( $queryResult->getCountry () );
			$result ["info"] ["postalCode"] = $queryResult->getPostalCode ();
			$result ["info"] ["regDate"] = $queryResult->getRegDate ();
			
			$dbModel->close ();
			return ($result);
		} else {
			$dbModel->close ();
			return (false);
		}
	}
	
	/**
	 * Name : dashBoard1ProfileInfoPreload
	 * Input : $bid -- business ID
	 * $profile_data -- profile data
	 * Output: update result
	 *
	 * Description: Dash board 1 profile update process
	 */
	public function dashBoard1ProfileInfoUpdate($profile_data, $bid) {
		$result = array ();
		$result ['status'] = CommonDefinition::SUCCESS_CHECK_FIELD;
		$result ['info'] = "";
		
		$sysUtil = new SysUtility ();
		
		$bnSet = new BusinessInfoSet ( $profile_data->full_name, $profile_data->email, $profile_data->phone, $profile_data->company_name );
		
		$bnSet->setMobile ( $profile_data->mobile );
		$bnSet->setBnType ( $sysUtil->getBusinessTypeIndex ( $profile_data->type ) );
		$bnSet->setAddress ( $profile_data->address );
		$bnSet->setCity ( $profile_data->city );
		$bnSet->setProvince ( $sysUtil->getProvinceIndex ( $profile_data->province ) );
		$bnSet->setCountry ( $sysUtil->getCountryIndex ( $profile_data->country ) );
		$bnSet->setPostalCode ( $profile_data->postal_code );
		
		// Check input data format
		if (! $sysUtil->checkFormField ( $bnSet->getEmail (), CommonDefinition::REG_EMAIL_ID )) {
			$result ['info'] .= " EMAIL ";
		}
		
		if (! $sysUtil->checkFormField ( $bnSet->getPhone (), CommonDefinition::REG_MOBILE_ID )) {
			$result ['info'] .= " PHONE ";
		}
		
		// Only check if mobile is provided
		if (! empty ( $bnSet->getMobile () )) {
			if (! $sysUtil->checkFormField ( $bnSet->getMobile (), CommonDefinition::REG_MOBILE_ID )) {
				$result ['info'] .= " MOBILE ";
			}
		}
		
		// Only check if Postal code is provided
		if (! empty ( $bnSet->getPostalCode () )) {
			if (! $sysUtil->checkFormField ( $bnSet->getPostalCode (), CommonDefinition::REG_POSTAL_CODE_ID )) {
				$result ['info'] .= " POSTAL_CODE ";
			}
		}
		
		if (! $sysUtil->checkFormField ( $bnSet->getFullName (), CommonDefinition::REG_NAME_ID )) {
			$result ['info'] .= " FULL_NAME ";
		}
		
		if (! $sysUtil->checkFormField ( $bnSet->getBusinessName (), CommonDefinition::REG_NAME_ID )) {
			$result ['info'] .= " COMPANY_NAME ";
		}
		
		if (! empty ( $result ['info'] )) {
			// Check input data failed, return with error
			$result ['status'] = CommonDefinition::ERROR_CHECK_FIELD;
			return ($result); // Return due to field check error
		}
		
		// Start to process the business account profile info update
		$result ['status'] = CommonDefinition::ERROR_CONN;
		$result ['info'] = "Failed to connect to Server!";
		
		$dbModel = new BusinessModel ( SysDefinition::USER_DB_CONFIG );
		
		// Connect to Database
		$db_bn_conn = $dbModel->connect ();
		
		if (! $db_bn_conn) {
			// Connect to DB failed return without further handling
			return ($result);
		}
		
		// Check email and phone, mobile duplication
		if ($dbModel->checkEmailDuplicationByAllTables ( $bnSet->getEmail (), $bid )) {
			// Email duplication found, return with warning
			$result ['status'] = CommonDefinition::ERROR_DUPLICATION_FIELD;
			$result ['info'] = "Warning! This email is already in use.";
			return ($result); // Return due to field check error
		}
		
		if (! empty ( $bnSet->getMobile () )) {
			// If mobile exists, then check the mobile duplication
			if ($dbModel->checkMobileDuplicationByAllTables ( $bnSet->getMobile (), $bid )) {
				// Mobile duplication found, return with warning
				$result ['status'] = CommonDefinition::ERROR_DUPLICATION_FIELD;
				$result ['info'] = "Warning! This mobile number is already in use.";
				return ($result); // Return due to field check error
			}
		}
		
		// set the user db table name
		$bnInfoTblName = $sysUtil->genDashboard1AcntTblName ();
		$dbModel->setTableName ( $bnInfoTblName );
		
		$queryResult = $dbModel->getDashboard1AcntInfoById ( $bid );
		
		if (! is_bool ( $queryResult )) {
			$queryResult->setFullName ( $bnSet->getFullName () );
			$queryResult->setBusinessName ( $bnSet->getBusinessName () );
			$queryResult->setEmail ( $bnSet->getEmail () );
			$queryResult->setPhone ( $bnSet->getPhone () );
			$queryResult->setMobile ( $bnSet->getMobile () );
			$queryResult->setBnType ( $bnSet->getBnType () );
			$queryResult->setAddress ( $bnSet->getAddress () );
			$queryResult->setCity ( $bnSet->getCity () );
			$queryResult->setProvince ( $bnSet->getProvince () );
			$queryResult->setCountry ( $bnSet->getCountry () );
			$queryResult->setPostalCode ( $bnSet->getPostalCode () );
			
			if ($queryResult->getStatus () < BusinessDefinition::BN_REG_STEP_2) {
				$queryResult->setStatus ( BusinessDefinition::BN_REG_STEP_2 ); // Update register status
			}
			
			if ($dbModel->updateDashBoard1ProfileInfoById ( $queryResult, $bid )) {
				$result ['status'] = CommonDefinition::SUCCESS;
				$result ['info'] = "Success to update my profile info!";
			} else {
				$result ['status'] = CommonDefinition::ERROR;
				$result ['info'] = "Failed to Update info!";
			}
		}
		
		$dbModel->close ();
		return ($result);
	}
	
	/**
	 * Name : dashBoard1PasswordUpdate
	 * Input : $bid -- business ID
	 * $pw_update_data -- password data
	 * Output: update result
	 *
	 * Description: Dash board 1 profile update process
	 */
	public function dashBoard1PasswordUpdate($pw_update_data, $bn_id) {
		$result = array ();
		$result ['status'] = CommonDefinition::SUCCESS_CHECK_FIELD;
		$result ['info'] = "";
		
		// check user password data
		$sysUtil = new SysUtility ();
		
		if (! $sysUtil->checkFormField ( $pw_update_data->pu_old_password, CommonDefinition::REG_PASSWORD_ID )) {
			$result ['info'] .= " OLD_PW ";
		}
		
		if (! $sysUtil->checkFormField ( $pw_update_data->pu_new_password, CommonDefinition::REG_PASSWORD_ID )) {
			$result ['info'] .= " NEW_PW ";
		}
		
		if (! $sysUtil->checkFormField ( $pw_update_data->pu_cfm_new_password, CommonDefinition::REG_PASSWORD_ID )) {
			$result ['info'] .= " CFM_PW ";
		}
		
		if (! empty ( $result ['info'] )) {
			// Check input data failed, return with error
			$result ['status'] = CommonDefinition::ERROR_CHECK_FIELD;
			return ($result); // Return due to field check error
		}
		
		if (CommonDefinition::SUCCESS != strcmp ( $pw_update_data->pu_new_password, $pw_update_data->pu_cfm_new_password )) {
			// new password and confirmed password compare fail
			// Check input data failed, return with error
			$result ['status'] = CommonDefinition::ERROR_COMPARE_FIELD;
			$result ['info'] = "ERROR:: New password input doesn't match!!!";
			return ($result); // Return due to field check error
		}
		
		// Start to process the password update
		$result ['status'] = CommonDefinition::ERROR_CONN;
		$result ['info'] = "Failed to connect to Server!";
		
		$dbModel = new BusinessModel ( SysDefinition::USER_DB_CONFIG );
		
		// Connect to Database
		$db_bn_conn = $dbModel->connect ();
		
		if (! $db_bn_conn) {
			return ($result);
			; // Connect to DB failed return without further handling
		}
		
		// Get the original user information
		// get the user info table name by user ID
		$bnInfoTblName = $sysUtil->genDashboard1AcntTblName ();
		$dbModel->setTableName ( $bnInfoTblName );
		
		$queryResult = $dbModel->getAcntPasswordById ( $bn_id );
		
		if (! is_bool ( $queryResult )) {
			// Compare the exist password with input old password
			$md5PwCode = md5 ( $pw_update_data->pu_old_password );
			
			if (CommonDefinition::SUCCESS != strcmp ( $md5PwCode, $queryResult->getPassword () )) {
				// Password doesn't match
				$result ['status'] = CommonDefinition::ERROR_COMPARE_FIELD;
				$result ['info'] = "ERROR: Enter wrong old password!";
			} else {
				$md5PwCode = md5 ( $pw_update_data->pu_new_password );
				$queryResult->setPassword ( $md5PwCode );
				
				if ($dbModel->updateAccountPasswordById ( $queryResult, $bn_id )) {
					$result ['status'] = CommonDefinition::SUCCESS;
					$result ['info'] = "Success to update my Password!";
				} else {
					$result ['info'] = "Failed to Update info!";
				}
			}
		}
		
		$dbModel->close ();
		return ($result);
	}
	
	/**
	 * Name : dashBoard1StatusInfo
	 * Input : business ID
	 * Output: array -- dashboard 1 status info
	 *
	 * Description: get dashboard 1 status info
	 */
	public function dashBoard1StatusInfo($bid) {
		$result = array ();
		
		$sysUtil = new SysUtility ();
		$bnInfoTblName = $sysUtil->genDashboard1AcntTblName ();
		
		$dbModel = new BusinessModel ( SysDefinition::USER_DB_CONFIG );
		// Connect to Database
		$db_bn_conn = $dbModel->connect ();
		
		if (! $db_bn_conn) {
			return (false); // Connect to DB failed return without further handling
		}
		
		// set the user db table name
		$dbModel->setTableName ( $bnInfoTblName );
		$queryResult = $dbModel->getAcntStatusById ( $bid );
		
		if (! is_bool ( $queryResult )) {
			$result ["status"] = $queryResult->getStatus ();
			// Get status response message
			
			$bnInfoTblName = $sysUtil->getDashboard1StatusMsgTblName ();
			$dbModel->setTableName ( $bnInfoTblName );
			
			$queryResult = $dbModel->getDb1StatusMsg ();
			
			// Get the proper status message
			switch ($result ["status"]) {
				case (BusinessDefinition::BN_REG_STEP_1) :
					{
						$result ["status_1_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_1_YES];
						$result ["status_2_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_2_NO];
						$result ["status_3_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_3_NO];
						$result ["status_4_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_4_NO];
						$result ["status_5_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_5_NO];
						$result ["status_6_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_6_NO];
						break;
					}
				case (BusinessDefinition::BN_REG_STEP_2) :
					{
						$result ["status_1_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_1_YES];
						$result ["status_2_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_2_YES];
						$result ["status_3_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_3_NO];
						$result ["status_4_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_4_NO];
						$result ["status_5_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_5_NO];
						$result ["status_6_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_6_NO];
						break;
					}
				case (BusinessDefinition::BN_REG_STEP_3) :
					{
						$result ["status_1_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_1_YES];
						$result ["status_2_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_2_YES];
						$result ["status_3_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_3_YES];
						$result ["status_4_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_4_NO];
						$result ["status_5_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_5_NO];
						$result ["status_6_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_6_NO];
						break;
					}
				case (BusinessDefinition::BN_REG_STEP_4) :
					{
						$result ["status_1_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_1_YES];
						$result ["status_2_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_2_YES];
						$result ["status_3_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_3_YES];
						$result ["status_4_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_4_YES];
						$result ["status_5_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_5_NO];
						$result ["status_6_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_6_NO];
						break;
					}
				case (BusinessDefinition::BN_REG_STEP_5) :
					{
						$result ["status_1_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_1_YES];
						$result ["status_2_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_2_YES];
						$result ["status_3_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_3_YES];
						$result ["status_4_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_4_YES];
						$result ["status_5_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_5_YES];
						$result ["status_6_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_6_NO];
						break;
					}
				case (BusinessDefinition::BN_REG_STEP_6) :
					{
						$result ["status_1_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_1_YES];
						$result ["status_2_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_2_YES];
						$result ["status_3_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_3_YES];
						$result ["status_4_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_4_YES];
						$result ["status_5_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_5_YES];
						$result ["status_6_result"] = $queryResult [AllTableInfoDefinition::BN_DB_FIELD_STEP_6_YES];
						break;
					}
				default :
					break;
			}
			
			$dbModel->close ();
			return ($result);
		} else {
			$dbModel->close ();
			return (false);
		}
	}
}
