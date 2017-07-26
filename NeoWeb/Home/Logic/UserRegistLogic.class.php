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
 * Name : UserRegistLogic
 * Input : N/A
 * Output: N/A
 * Description: Logic for user account regist
 */
class UserRegistLogic extends Logic
{

    /* User model automatic complete */

    /**
     * Name : registUserByEmail
     * Input : $reg_data -- user register data
     * Output: array -- register process result
     *
     * Description: user account register
     */
    public function registUserByEmail($reg_data)
    {
        $result = array();
        $result['status'] = CommonDefinition::SUCCESS;
        $result['info'] = "Your Account is created Successfully";
        $result['url'] = "unknown";

        $userSet = new UserInfoSet(trim($reg_data->user_name), trim($reg_data->user_mobile), trim($reg_data->user_email), trim($reg_data->user_password));

        // check user registeration data
        $userUtil = new SysUtility();

        if (! $userUtil->checkFormField($userSet->getUserName(), CommonDefinition::REG_NAME_ID)) {
            $result['status'] = CommonDefinition::ERROR_CHECK_FIELD;
            $result['info'] = "User Name is empty or not valid";
        } else if (! $userUtil->checkFormField($userSet->getEmail(), CommonDefinition::REG_EMAIL_ID)) {
            $result['status'] = CommonDefinition::ERROR_CHECK_FIELD;
            $result['info'] = "Email is empty or not valid";
        } else if (! $userUtil->checkFormField($userSet->getMobile(), CommonDefinition::REG_MOBILE_ID)) {
            $result['status'] = CommonDefinition::ERROR_CHECK_FIELD;
            $result['info'] = "Mobile number is empty or not valid";
        } else if (! $userUtil->checkFormField($userSet->getPassword(), CommonDefinition::REG_PASSWORD_ID)) {
            $result['status'] = CommonDefinition::ERROR_CHECK_FIELD;
            $result['info'] = "Password is empty or not valid";
        }

        // return due to field check error
        if ($result['status'] != CommonDefinition::SUCCESS) {
            return ($result); // return due to check form item failed
        }

        // convert password to md5 hash
        $md5PwCode = md5($userSet->getPassword());
        // Set back to the user set
        $userSet->setPassword($md5PwCode);

        $regModel = new UserModel(SysDefinition::USER_DB_CONFIG);

        // Connect to Database
        $db_user_conn = $regModel->connect();

        if (! $db_user_conn) {
            $result['status'] = CommonDefinition::ERROR_CONN;
            $result['info'] = "Failed to connect to Server!";
            return ($result); // Connect to DB failed return without further handling
        }

        if ($regModel->checkUserEmailByAllTables($userSet->getEmail())) {
            $result['status'] = CommonDefinition::ERROR_CHECK_FIELD;
            $result['info'] = "Note: This email is already in use!";
        } else {
            // Pass the email duplication check, start to register account
            // Start to process the account info
            $userInfoTblName = $userUtil->generateUserInfoTableName($userSet->getMobile());

            if (! $regModel->creatUserAccountTbl($userInfoTblName)) {
                // return due to create table fail
                $result['status'] = CommonDefinition::ERROR_CONN;
                $result['info'] = "ERROR: Create user account failed!!!";
            } else {
                // set the table name
                $regModel->setTableName($userInfoTblName);
                // Create user tag id
                $repeatFlag = true;
                while ($repeatFlag) {
                    $newTagId = $userUtil->generateUserTagId($userSet->getMobile());

                    if (! $regModel->checkUserTagId($newTagId)) {
                        // new tag id is not duplicated,
                        $userSet->setTagId($newTagId);
                        $repeatFlag = FALSE; // exit if new tag id is new
                    }
                }

                // Tag ID is ready, add the user account value to database
                // Prepare the user info to store in Database
                if (! $regModel->addUserRegisterInfo($userSet)) {
                    $result['status'] = CommonDefinition::ERROR_CONN;
                    $result['info'] = "ERROR: Create user account failed!!!";
                } else {
                    $result['status'] = CommonDefinition::SUCCESS;
                    $result['info'] = "Congratulations, your account is created successfully!";
                    $result['url'] = U('User/signIn');
                }
            }
        }

        $regModel->close();
        return ($result);
    }
}
