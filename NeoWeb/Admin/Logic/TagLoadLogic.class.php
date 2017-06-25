<?php

// +----------------------------------------------------------------------
// | Logic for get Tag info
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Admin\Logic;

use Admin\Model\TagManageModel;
use NeoWeb\Admin\Common\AdminDefinition;
use NeoWeb\Admin\Common\AdminUtilities;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\SysDefinition;
use NeoWeb\Common\Common\SysUtility;
use NeoWeb\Common\Common\TagInfoSet;

/**
 * Name : TagCreateLogic
 * Input : N/A
 * Output: N/A
 * Description: Logic for tag create.
 */
class TagLoadLogic extends Logic
{

    // ===========================================================
    // * Name : getTagInfo
    // * Input : $count -- tag count number start from 1
    // * Output: array -- tag info
    // * Description: get the specified tag info
    // ===========================================================
    public function getTagInfo($count)
    {
        $result = array();
        $sysUtil = new SysUtility();
        $tblName = $sysUtil->getTagInfoTblName();

        $mModel = new TagManageModel(SysDefinition::USER_DB_CONFIG);
        $db_conn = $mModel->connect();

        if (! $db_conn) {
            return (false); // Connect to DB failed return without further handling
        }
        // set the table name
        $mModel->setTableName($tblName);

        // Tag Info query
        $queryResult = $mModel->getTagInfo($count);

        if (! is_bool($queryResult)) {
            $result["status"] = CommonDefinition::SUCCESS;

            $result["info"]["fullName"] = $queryResult->getFullName();
            $result["info"]["companyName"] = $queryResult->getBusinessName();
            $result["info"]["email"] = $queryResult->getEmail();
            $result["info"]["altEmail"] = $queryResult->getEmailAlt();
            $result["info"]["phone"] = $queryResult->getPhone();
            $result["info"]["mobile"] = $queryResult->getMobile();
            $result["info"]["type"] = $bnUtil->getBusinessType($queryResult->getBnType());
            $result["info"]["address"] = $queryResult->getAddress();
            $result["info"]["city"] = $queryResult->getCity();
            $result["info"]["province"] = $bnUtil->getProvinceName($queryResult->getProvince());
            $result["info"]["country"] = $bnUtil->getCountryName($queryResult->getCountry());
            $result["info"]["postalCode"] = $queryResult->getPostalCode();
            $result["info"]["regDate"] = $queryResult->getRegDate();

            $dbModel->close();
            return ($result);
        } else {
            $dbModel->close();
            return (false);
        }
    }
}
