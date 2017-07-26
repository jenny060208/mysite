<?php

// +----------------------------------------------------------------------
// | Logic for user account management
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
 * Name : UserProfileLogic
 * Input : N/A
 * Output: N/A
 * Description: Logic for user account sign in
 */
class UserProfileLogic extends Logic
{

    /**
     * Name : getBasicInfo
     * Input : User ID
     * Output: array -- User basic info
     *
     * Description: Get user basic information
     */
    public function getBasicInfo($user_id)
    {
        $result = array();
        $result['status'] = CommonDefinition::ERROR_CONN;
        $sysUtil = new SysUtility();

        // Start to process the basic info update
        $basicInfoModel = new UserModel(SysDefinition::USER_DB_CONFIG);
        // Connect to Database
        $db_user_conn = $basicInfoModel->connect();

        if (! $db_user_conn) {
            $result['info'] = "Failed to connect to Server!";
            // Connect to DB failed return without further handling
            return ($result);
        }

        // get the user info table name by the received email
        $userDbTblName = $basicInfoModel->getUserAccountTblNameByUserId($user_id);

        if (! is_bool($userDbTblName)) {
            // set the user db table name
            $basicInfoModel->setTableName($userDbTblName);
            $queryResult = $basicInfoModel->getUserAccountInfoByUserId($user_id);

            if (! is_bool($queryResult)) {
                $result["info"]["Name"] = $queryResult->getUserName();
                $result["info"]["Email"] = $queryResult->getEmail();
                $result["info"]["Mobile"] = $queryResult->getMobile();
                $result["info"]["Address1"] = $queryResult->getAddress1();
                $result["info"]["Address2"] = $queryResult->getAddress2();
                $result["info"]["City"] = $queryResult->getCity();
                $result["info"]["Province"] = $sysUtil->getProvinceName($queryResult->getProvince());
                $result["info"]["Country"] = $sysUtil->getCountryName($queryResult->getCountry());
                $result["info"]["PostalCode"] = $queryResult->getPostalCode();
                $result["info"]["Birthday"] = $queryResult->getBirthday();
                $result["info"]["BirthMonth"] = $queryResult->getBirthMonth();

                $result['status'] = CommonDefinition::SUCCESS;
            } else {
                $result['info'] = "Failed to connect to Server!";
            }
        } else {
            $result['info'] = "Failed to connect to Server!";
        }

        $basicInfoModel->close();
        return ($result);
    }

    /**
     * Name : updateBasicInfo
     * Input : User basic info data
     * Output: TRUE -- update success
     * False -- update fail
     * Description: user basic info update
     */
    public function updateBasicInfo($basic_info_data, $user_id)
    {
        $userUtil = new SysUtility();

        $result = array();
        $result['status'] = CommonDefinition::SUCCESS_CHECK_FIELD;
        $result['info'] = "";

        $userSet = new UserInfoSet(trim($basic_info_data->bi_user_name), trim($basic_info_data->bi_user_mobile), trim($basic_info_data->bi_user_email), null);

        $userSet->setAddress1(trim($basic_info_data->bi_user_address_1));
        $userSet->setAddress2(trim($basic_info_data->bi_user_address_2));
        $userSet->setCity(trim($basic_info_data->bi_user_city));
        $userSet->setProvince($userUtil->getProvinceIndex($basic_info_data->bi_user_province));
        $userSet->setCountry($userUtil->getCountryIndex($basic_info_data->bi_user_country));
        $userSet->setPostalCode(trim($basic_info_data->bi_user_postal_code));
        $userSet->setBirthday($basic_info_data->bi_user_birth_day);
        $userSet->setBirthMonth($basic_info_data->bi_user_birth_month);

        // check user basic info data

        if (! $userUtil->checkFormField($userSet->getEmail(), CommonDefinition::REG_EMAIL_ID)) {
            $result['info'] .= "EMAIL";
        }

        if (! $userUtil->checkFormField($userSet->getMobile(), CommonDefinition::REG_MOBILE_ID)) {
            $result['info'] .= "MOBILE";
        }

        if (! $userUtil->checkFormField($userSet->getUserName(), CommonDefinition::REG_NAME_ID)) {
            $result['info'] .= "NAME";
        }

        if (! empty($result['info'])) {
            // Check input data failed, return with error
            $result['status'] = CommonDefinition::ERROR_CHECK_FIELD;
            return ($result); // Return due to field check error
        }

        // Start to process the basic info update
        $result['status'] = CommonDefinition::ERROR_CONN;
        $result['info'] = "Failed to connect to Server!";

        $basicInfoModel = new UserModel(SysDefinition::USER_DB_CONFIG);
        // Connect to Database
        $db_user_conn = $basicInfoModel->connect();

        if (! $db_user_conn) {
            return ($result); // Connect to DB failed return without further handling
        }

        // Get the original user information
        // get the user info table name by the received email
        $userDbTblName = $basicInfoModel->getUserAccountTblNameByUserId($user_id);

        if (! is_bool($userDbTblName)) {
            // set the user db table name
            $basicInfoModel->setTableName($userDbTblName);
            $queryResult = $basicInfoModel->getUserAccountInfoByUserId($user_id);

            if (! is_bool($queryResult)) {
                $queryResult->setUserName($userSet->getUserName());
                $queryResult->setEmail($userSet->getEmail());
                $queryResult->setMobile($userSet->getMobile());
                $queryResult->setAddress1($userSet->getAddress1());
                $queryResult->setAddress2($userSet->getAddress2());
                $queryResult->setCity($userSet->getCity());
                $queryResult->setProvince($userSet->getProvince());
                $queryResult->setCountry($userSet->getCountry());
                $queryResult->setPostalCode($userSet->getPostalCode());
                $queryResult->setBirthday($userSet->getBirthday());
                $queryResult->setBirthMonth($userSet->getBirthMonth());

                if ($basicInfoModel->updateUserBasicInfoByUserId($queryResult, $user_id)) {
                    $result['status'] = CommonDefinition::SUCCESS;
                    $result['info'] = "Success to update my basic info!";
                } else {
                    $result['info'] = "Failed to Update info!";
                }
            }
        } else {
            $result['info'] = "Failed to get table name!";
        }

        $basicInfoModel->close();
        return ($result);
    }

    /**
     * Name : updateUserPassword
     * Input : User password data
     * Output: TRUE -- update success
     * False -- update fail
     * Description: user password update
     */
    public function updateUserPassword($pw_update_data, $user_id)
    {
        $result = array();
        $result['status'] = CommonDefinition::SUCCESS_CHECK_FIELD;
        $result['info'] = "";

        // check user password data
        $userUtil = new SysUtility();

        if (! $userUtil->checkFormField($pw_update_data->pu_old_password, CommonDefinition::REG_PASSWORD_ID)) {
            $result['info'] .= " OLD_PW ";
        }

        if (! $userUtil->checkFormField($pw_update_data->pu_new_password, CommonDefinition::REG_PASSWORD_ID)) {
            $result['info'] .= " NEW_PW ";
        }

        if (! $userUtil->checkFormField($pw_update_data->pu_cfm_new_password, CommonDefinition::REG_PASSWORD_ID)) {
            $result['info'] .= " CFM_PW ";
        }

        if (! empty($result['info'])) {
            // Check input data failed, return with error
            $result['status'] = CommonDefinition::ERROR_CHECK_FIELD;
            return ($result); // Return due to field check error
        }

        if (CommonDefinition::SUCCESS != strcmp($pw_update_data->pu_new_password, $pw_update_data->pu_cfm_new_password)) {
            // new password and confirmed password compare fail
            // Check input data failed, return with error
            $result['status'] = CommonDefinition::ERROR_COMPARE_FIELD;
            $result['info'] = "ERROR:: New password input doesn't match!!!";
            return ($result); // Return due to field check error
        }

        // Start to process the password update
        $result['status'] = CommonDefinition::ERROR_CONN;
        $result['info'] = "Failed to connect to Server!";

        $pwInfoModel = new UserModel(SysDefinition::USER_DB_CONFIG);
        // Connect to Database
        $db_user_conn = $pwInfoModel->connect();

        if (! $db_user_conn) {
            return ($result); // Connect to DB failed return without further handling
        }

        // Get the original user information
        // get the user info table name by user ID
        $userDbTblName = $pwInfoModel->getUserAccountTblNameByUserId($user_id);

        if (! is_bool($userDbTblName)) {
            // set the user db table name
            $pwInfoModel->setTableName($userDbTblName);
            $queryResult = $pwInfoModel->getUserAccountInfoByUserId($user_id);

            if (! is_bool($queryResult)) {
                // Compare the exist password with input old password
                $md5PwCode = md5($pw_update_data->pu_old_password);

                if (CommonDefinition::SUCCESS != strcmp($md5PwCode, $queryResult->getPassword())) {
                    // Password doesn't match
                    $result['status'] = CommonDefinition::ERROR_COMPARE_FIELD;
                    $result['info'] = "ERROR: Input password doesn't match!";
                } else {
                    $md5PwCode = md5($pw_update_data->pu_new_password);
                    $queryResult->setPassword($md5PwCode);

                    if ($pwInfoModel->updateUserPasswordByUserId($queryResult, $user_id)) {
                        $result['status'] = CommonDefinition::SUCCESS;
                        $result['info'] = "Success to update my Password!";
                    } else {
                        $result['info'] = "Failed to Update info!";
                    }
                }
            }
        } else {
            $result['info'] = "Failed to get table name!";
        }

        $pwInfoModel->close();
        return ($result);
    }

    /**
     * Name : get_notice_pref_info
     * Input : User ID
     * Output: user notice prefernce method data
     *
     * Description: get user notification preference data
     */
    public function get_notice_pref_info($user_id)
    {
        $result = array();
        $result['status'] = CommonDefinition::ERROR_CONN;

        $noticeModel = new UserModel(SysDefinition::USER_DB_CONFIG);
        // Connect to Database
        $db_user_conn = $noticeModel->connect();

        if (! $db_user_conn) {
            $result['info'] = "ERROR: connect to server!!!";
            return ($result); // Connect to DB failed return without further handling
        }

        // Get the original user information
        // get the user info table name by user ID
        $userDbTblName = $noticeModel->getUserAccountTblNameByUserId($user_id);

        if (! is_bool($userDbTblName)) {
            // set the user db table name
            $noticeModel->setTableName($userDbTblName);
            $queryResult = $noticeModel->getUserAccountInfoByUserId($user_id);

            if (! is_bool($queryResult)) {
                $result['status'] = CommonDefinition::SUCCESS;
                $storeOption = $queryResult->getStoreNotice();
                $neoOption = $queryResult->getNeoNotice();

                // store option
                switch ($storeOption) {
                    case (CommonDefinition::USER_NOTICE_DISABLE):
                        {
                            $result["info"]["storeSmsCheckbox"] = 0;
                            $result["info"]["storeEmailCheckbox"] = 0;
                            break;
                        }
                    case (CommonDefinition::USER_NOTICE_EMAIL_ONLY):
                        {
                            $result["info"]["storeSmsCheckbox"] = 0;
                            $result["info"]["storeEmailCheckbox"] = 1;
                            break;
                        }
                    case (CommonDefinition::USER_NOTICE_SMS_ONLY):
                        {
                            $result["info"]["storeSmsCheckbox"] = 1;
                            $result["info"]["storeEmailCheckbox"] = 0;
                            break;
                        }
                    case (CommonDefinition::USER_NOTICE_ALL):
                        {
                            $result["info"]["storeSmsCheckbox"] = 1;
                            $result["info"]["storeEmailCheckbox"] = 1;
                            break;
                        }
                    default:
                        $result["info"]["storeSmsCheckbox"] = 0;
                        $result["info"]["storeEmailCheckbox"] = 0;
                        break;
                }
                // NEO option
                switch ($neoOption) {
                    case (CommonDefinition::USER_NOTICE_DISABLE):
                        {
                            $result["info"]["neoSmsCheckbox"] = 0;
                            $result["info"]["neoEmailCheckbox"] = 0;
                            break;
                        }
                    case (CommonDefinition::USER_NOTICE_EMAIL_ONLY):
                        {
                            $result["info"]["neoSmsCheckbox"] = 0;
                            $result["info"]["neoEmailCheckbox"] = 1;
                            break;
                        }
                    case (CommonDefinition::USER_NOTICE_SMS_ONLY):
                        {
                            $result["info"]["neoSmsCheckbox"] = 1;
                            $result["info"]["neoEmailCheckbox"] = 0;
                            break;
                        }
                    case (CommonDefinition::USER_NOTICE_ALL):
                        {
                            $result["info"]["neoSmsCheckbox"] = 1;
                            $result["info"]["neoEmailCheckbox"] = 1;
                            break;
                        }
                    default:
                        $result["info"]["neoSmsCheckbox"] = 0;
                        $result["info"]["neoEmailCheckbox"] = 0;
                        break;
                }
            } else {
                $result['status'] = CommonDefinition::ERROR;
                $result['info'] = "ERROR: Failed to get info!";
            }
        } else {
            $result['info'] = "ERROR: Failed to get table name!";
        }

        $noticeModel->close();
        return ($result);
    }

    /**
     * Name : updateUserPref
     * Input : User notification preference data
     * Output: TRUE -- update success
     * False -- update fail
     * Description: user notification preference update
     */
    public function updateUserPref($pref_update_data, $user_id)
    {
        $result = array();
        $result['status'] = CommonDefinition::SUCCESS;
        $result['info'] = "Update success!!!";
        // Preset to false
        $storeSmsNote = false;
        $storeEmailNote = false;
        $neoSmsNote = false;
        $neoEmailNote = false;
        $storeNoticeMethod = CommonDefinition::USER_NOTICE_DISABLE;
        $neoNoticeMethod = CommonDefinition::USER_NOTICE_DISABLE;

        if (isset($pref_update_data->storeSmsCheckbox)) {
            if (CommonDefinition::SUCCESS == strcmp($pref_update_data->storeSmsCheckbox, CommonDefinition::STR_TRUE)) {
                $storeSmsNote = true;
            }
        }

        if (isset($pref_update_data->storeEmailCheckbox)) {
            if (CommonDefinition::SUCCESS == strcmp($pref_update_data->storeEmailCheckbox, CommonDefinition::STR_TRUE)) {
                $storeEmailNote = true;
            }
        }

        if (isset($pref_update_data->neoSmsCheckbox)) {
            if (CommonDefinition::SUCCESS == strcmp($pref_update_data->neoSmsCheckbox, CommonDefinition::STR_TRUE)) {
                $neoSmsNote = true;
            }
        }

        if (isset($pref_update_data->neoEmailCheckbox)) {
            if (CommonDefinition::SUCCESS == strcmp($pref_update_data->neoEmailCheckbox, CommonDefinition::STR_TRUE)) {
                $neoEmailNote = true;
            }
        }

        // summarize the notice preference method
        if ((! $storeSmsNote) && (! $storeEmailNote)) {
            $storeNoticeMethod = CommonDefinition::USER_NOTICE_DISABLE;
        } else if ((! $storeSmsNote) && ($storeEmailNote)) {
            $storeNoticeMethod = CommonDefinition::USER_NOTICE_EMAIL_ONLY;
        } else if (($storeSmsNote) && (! $storeEmailNote)) {
            $storeNoticeMethod = CommonDefinition::USER_NOTICE_SMS_ONLY;
        } else {
            $storeNoticeMethod = CommonDefinition::USER_NOTICE_ALL;
        }

        // summarize the notice preference method
        if ((! $neoSmsNote) && (! $neoEmailNote)) {
            $neoNoticeMethod = CommonDefinition::USER_NOTICE_DISABLE;
        } else if ((! $neoSmsNote) && ($neoEmailNote)) {
            $neoNoticeMethod = CommonDefinition::USER_NOTICE_EMAIL_ONLY;
        } else if (($neoSmsNote) && (! $neoEmailNote)) {
            $neoNoticeMethod = CommonDefinition::USER_NOTICE_SMS_ONLY;
        } else {
            $neoNoticeMethod = CommonDefinition::USER_NOTICE_ALL;
        }

        // Start to process the notice method update
        $result['status'] = CommonDefinition::ERROR_CONN;
        $result['info'] = "Failed to connect to Server!";

        $noticeModel = new UserModel(SysDefinition::USER_DB_CONFIG);
        // Connect to Database
        $db_user_conn = $noticeModel->connect();

        if (! $db_user_conn) {
            return ($result); // Connect to DB failed return without further handling
        }

        // Get the original user information
        // get the user info table name by user ID
        $userDbTblName = $noticeModel->getUserAccountTblNameByUserId($user_id);

        if (! is_bool($userDbTblName)) {
            // set the user db table name
            $noticeModel->setTableName($userDbTblName);
            $queryResult = $noticeModel->getUserAccountInfoByUserId($user_id);

            if (! is_bool($queryResult)) {
                $queryResult->setStoreNotice($storeNoticeMethod);
                $queryResult->setNeoNotice($neoNoticeMethod);

                if ($noticeModel->updateUserNoticeMethodByUserId($queryResult, $user_id)) {
                    $result['status'] = CommonDefinition::SUCCESS;
                    $result['info'] = "Success to update my notice preference!";
                } else {
                    $result['status'] = CommonDefinition::ERROR;
                    $result['info'] = "Failed to update my notice preference!";
                }
            }
        } else {
            $result['info'] = "Failed to get table name!";
        }

        $noticeModel->close();
        return ($result);
    }
}

