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
 * Name : BusinessSignInLogic
 * Input : N/A
 * Output: N/A
 * Description: model for all business account management:
 * Register/Login/Logout/Password recover, etc
 */
class BusinessSignInLogic extends Logic
{

    /**
     * Name : signInBusiness
     * Input : Business sign in data
     * Output: array --Sign in process result
     *
     * Description: business sign in verification
     */
    public function signInBusiness($sign_data)
    {
        $result = array();
        $result["status"] = CommonDefinition::SUCCESS_CHECK_FIELD;
        $result["info"] = "";
        $result["url"] = "unknown";

        // Full name, Business email, Business phone, Business name
        $bnSet = new BusinessInfoSet(null, trim($sign_data->email), null, null);

        $bnSet->setPassword($sign_data->password);
        // check user sign in data
        $bnUtil = new SysUtility();

        if (! $bnUtil->checkFormField($bnSet->getEmail(), CommonDefinition::REG_EMAIL_ID)) {
            $result["info"] .= "EMAIL"; // return due to check form item email failed
        } else if (! $bnUtil->checkFormField($bnSet->getPassword(), CommonDefinition::REG_PASSWORD_ID)) {
            $result["info"] .= " PASSWORD ";
        }

        if (! empty($result["info"])) {
            // Check input data failed, return with error
            $result["status"] = CommonDefinition::ERROR_CHECK_FIELD;
            return ($result); // Return due to field check error
        }

        // convert password to md5 hash
        // $md5PwCode = md5($bnSet->getPassword());
        // // Set back to the info set
        // $bnSet->setPassword($md5PwCode);

        $signModel = new BusinessModel(SysDefinition::USER_DB_CONFIG);
        // Connect to Database
        $db_bn_conn = $signModel->connect();

        if (! $db_bn_conn) {
            $result["status"] = CommonDefinition::ERROR_CONN;
            $result["info"] = "Failed to connect to Server!";
            return ($result); // Connect to DB failed return without further handling
        }

        // get the user info table name by the received email
        $bnDbTblName = $signModel->getBnAccountTblNameByEmail($bnSet->getEmail());

        if (! is_bool($bnDbTblName)) {
            // set the user db table name
            $signModel->setTableName($bnDbTblName);
            $queryResult = $signModel->getBnAcntInfoByEmail($bnSet->getEmail());

            if (! is_bool($queryResult)) {
                if (strcasecmp($queryResult->getPassword(), $bnSet->getPassword()) == CommonDefinition::SAME_RESULT) {
                    // password match, sign in process
                    $result["status"] = CommonDefinition::SUCCESS;
                    $result["info"] = "Your account is signed in successfully!";
                    $result["url"] = U("Business/bn_dashboard");
                    // Add business info to session
                    session_start();
                    $_SESSION["bid"] = $queryResult->getBusinessId();
                    $_SESSION["bn_name"] = $queryResult->getBusinessName();
                } else {
                    $result["status"] = CommonDefinition::ERROR;
                    $result["info"] = "Sorry, you don't have access to this page!!!";
                }
            }
        }

        $signModel->close();
        return ($result);
    }
}
