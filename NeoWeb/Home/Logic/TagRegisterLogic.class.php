<?php

// +----------------------------------------------------------------------
// | Service for Business account management
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Home\Logic;

use Home\Model\NeoModel;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\SysDefinition;
use NeoWeb\Common\Common\SysUtility;
use NeoWeb\Common\Common\BusinessDefinition;
use NeoWeb\Common\Common\BusinessInfoSet;
use NeoWeb\Common\Common\UserInfoSet;
use NeoWeb\Common\Common\NeoDefinition;
use NeoWeb\Common\Common\TagInfoSet;

/**
 * Name : TagRegisterLogic
 * Input : N/A
 * Output: N/A
 * Description: Logic for tag user register related
 */
class TagRegisterLogic extends Logic
{

    /**
     * Name : loadTagRegisterInfo
     * Input : tagId
     * Output: tag Id related user register web page info
     *
     * Description: load the web page of user register according to tag id
     */
    public function loadUserRegisterInfo($tid)
    {
        $tagSet = new TagInfoSet($tid);

        $sysUtil = new SysUtility();

        $tblName = $sysUtil->getTagInfoTblName();

        $mModel = new NeoModel(SysDefinition::USER_DB_CONFIG);
        // Connect to Database
        $db_neo_conn = $mModel->connect();

        if (! $db_neo_conn) {
            $tagSet->setStatus(false);
            $tagSet->setInfo("Sorry, this is an invalid request!");

            return ($tagSet); // Connect to DB failed return without further handling
        }

        // set the db table name
        $mModel->setTableName($tblName);
        $tagSet = $mModel->getTagInfoById($tagSet->getTagId());

        if (false == $tagSet->getStatus()) {
            $tagSet->setInfo("Sorry, this is an invalid request!");
        }

        $mModel->close();
        return ($tagSet);
    }

    /**
     * Name : addUserRegisterInfoFromTag
     * Input : tagId
     * Output: tag Id related user register web page info
     *
     * Description: load the web page of user register according to tag id
     */
    public function addUserRegisterInfoFromTag($recv_data)
    {
        $result = array();

        $tagIdTemp = $_SESSION["tag_id"];
        $midTemp = $_SESSION["merchant_id"];

        $userSet = new UserInfoSet(null, $recv_data->mobile, $recv_data->email, null);
        $userSet->setFirstName($recv_data->first_name);
        $userSet->setLastName($recv_data->last_name);
        $userSet->setTagId($tagIdTemp);
        $userSet->setBusinessId($midTemp);

        $sysUtil = new SysUtility();

        $tblName = $sysUtil->getTagUserRegistTblName($userSet->getBusinessId());

        $mModel = new NeoModel(SysDefinition::USER_DB_CONFIG);
        // Connect to Database
        $db_neo_conn = $mModel->connect();

        if (! $db_neo_conn) {
            $result["status"] = CommonDefinition::ERROR_CONN;
            $result["info"] = "Sorry, register failed due to system";
            return ($result); // Connect to DB failed return without further handling
        }

        // set the db table name
        $mModel->setTableName($tblName);

        // check email duplication
        if ($mModel->checkEmailDuplication($userSet->getEmail())) {
            $result["status"] = CommonDefinition::ERROR_CHECK_FIELD;
            $result["info"] = "This email is already in use!";
            $mModel->close();
            return ($result);
        }

        // check mobile phone duplication
        if ($mModel->checkMobileDuplication($userSet->getMobile())) {
            $result["status"] = CommonDefinition::ERROR_CHECK_FIELD;
            $result["info"] = "This mobile phone number is already in use!";
            $mModel->close();
            return ($result);
        }

        // Add user register info
        if (false == $mModel->addUserTagRegisterInfo($userSet)) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Sorry, Account creat failed! Please try again later or contact us for help!";
        } else {
            $result["status"] = CommonDefinition::SUCCESS;
            $result["info"] = "Success!";
            $result["url"] = U("Adt/register_success");
        }

        $mModel->close();
        return ($result);
    }

    /**
     * Name : getUserRegistSuccessInfo
     * Input : None
     * Output: user regist success info through tag scan
     *
     * Description: user regist success info through tag scan
     */
    public function getUserRegistSuccessInfo()
    {
        $result = array();
        $midTemp = $_SESSION["merchant_id"];

        $mModel = new NeoModel(SysDefinition::USER_DB_CONFIG);
        // Connect to Database
        $db_neo_conn = $mModel->connect();

        if (! $db_neo_conn) {
            $result["status"] = CommonDefinition::ERROR_CONN;
            $result["info"] = "Sorry, register failed due to system";

            $result["merchant_name"] = "DB ERROR";
            $result["website"] = "www.google.com";

            return ($result); // Connect to DB failed return without further handling
        }

        // get business acount table name according to merchant id
        $tblName = $mModel->getMerchantAccountTableNameById($midTemp);
        if ($tblName == null) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error, not a valid merchant ID!";

            $mModel->close();
            return ($result);
        }

        // // set the db table name
        $mModel->setTableName($tblName);
        $queryResult = $mModel->getRegistSuccessMsg($midTemp);

        $result["status"] = $queryResult->getStatus();
        $result["merchant_name"] = $queryResult->getBusinessName();
        $result["website"] = $queryResult->getWebPage();
        $result["success_message"] = $queryResult->getSuccessMsg();

        $mModel->close();
        return ($result);
    }
}
