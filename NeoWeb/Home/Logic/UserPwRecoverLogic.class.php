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
 * Name : UserPwRecoverLogic
 * Input : N/A
 * Output: N/A
 * Description: Logic for user password recover
 */
class UserPwRecoverLogic extends Logic
{

    /* User model automatic complete */

    /**
     * Name : pwRecoverByEmail
     * Input : User email
     * Output: array -- register process result
     *
     * Description: user sign in verification
     */
    public function pwRecoverByEmail($pw_recv_data)
    {
        $result = array();
        $result['status'] = CommonDefinition::ERROR_CHECK_FIELD;
        $result['info'] = "Email empty or not valid";

        $userSet = new UserInfoSet(null, null, trim($pw_recv_data->user_email), null);

        // check user sign in data
        $userUtil = new SysUtility();

        if (! $userUtil->checkFormField($userSet->getEmail(), CommonDefinition::REG_EMAIL_ID)) {
            return ($result); // return due to check form item failed
        }

        $pwRecvModel = new UserModel(SysDefinition::USER_DB_CONFIG);
        // Connect to Database
        $db_user_conn = $pwRecvModel->connect();

        if (! $db_user_conn) {
            $result['status'] = CommonDefinition::ERROR_CONN;
            $result['info'] = "Failed to connect to Server!";
            return ($result); // Connect to DB failed return without further handling
        }

        // get the user info table name by the received email
        $userDbTblName = $pwRecvModel->getUserAccountTblNameByEmail($userSet->getEmail());

        if (! is_bool($userDbTblName)) {
            // set the user db table name
            $pwRecvModel->setTableName($userDbTblName);
            $queryResult = $pwRecvModel->getUserAccountPasswordByEmail($userSet->getEmail());

            if (! is_bool($queryResult)) {
                // password match
                $result['status'] = CommonDefinition::SUCCESS;
                $result['info'] = "Password recover is sent to your email!!";
            }
        }

        $pwRecvModel->close();
        return ($result);
    }
}
