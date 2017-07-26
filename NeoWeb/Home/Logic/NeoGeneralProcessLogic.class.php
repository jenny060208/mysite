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
use NeoWeb\Common\Common\NeoDefinition;
use NeoWeb\Common\Common\Order1InfoSet;

/**
 * Name : NeoDashBoard1Logic
 * Input : N/A
 * Output: N/A
 * Description: Logic for all Neo company related dashboard 1 (Potential merchant) management:
 * Product type, order, status information.
 */
class NeoGeneralProcessLogic extends Logic
{

    /**
     * Name : getMoreServiceInfoProcess
     * Input : None
     * Output: array -- Get more service request process result
     *
     * Description: Get more service request process result
     */
    public function getMoreServiceInfoProcess($jsonStr)
    {
        $result = array();

        $sysUtil = new SysUtility();
        $tblName = $sysUtil->getNeoBusinessEnquiryTblName();

        $neoModel = new NeoModel(SysDefinition::USER_DB_CONFIG);
        // Connect to Database
        $db_neo_conn = $neoModel->connect();

        if (! $db_neo_conn) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Fail to connect to DataBase!";
            return ($result); // Connect to DB failed return without further handling
        }

        // set the db table name
        $neoModel->setTableName($tblName);

        $tempStr = json_decode($jsonStr);

        // No previous message existed, add a new one
        $bnSet = new BusinessInfoSet($tempStr->name, $tempStr->email, $tempStr->phone, $tempStr->companyName);

        if ($neoModel->addMoreServiceEnquiry($bnSet)) {
            $result["status"] = CommonDefinition::SUCCESS;
            $result["info"] = "Thanks, your message is received! Our agent will conact you soon. ";
        } else {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "ERROR! your message cannot be processed.";
        }

        $neoModel->close();
        return ($result);
    }

    /**
     * Name : getInTouchMsgProcess
     * Input : None
     * Output: array -- general enquiry message process result
     *
     * Description: general enquiry message process result
     */
    public function getInTouchMsgProcess($jsonStr)
    {
        $result = array();

        $sysUtil = new SysUtility();

        if (! $sysUtil->checkStringlength($jsonStr->general_enquiry_fm_message, CommonDefinition::MAX_CONTACT_MSG_LENGTH)) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error: Maximum 300 characters message!";
            return ($result); // Connect to DB failed return without further handling
        } else if (! $sysUtil->checkFormField($jsonStr->general_enquiry_name, CommonDefinition::REG_NAME_ID)) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error: Name field wrong!";
            return ($result); // Connect to DB failed return without further handling
        } else if (! $sysUtil->checkFormField($jsonStr->general_enquiry_email, CommonDefinition::REG_EMAIL_ID)) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error: Not a valid email address";
            return ($result); // Connect to DB failed return without further handling
        }

        $tblName = $sysUtil->getNeoInTouchTblName();

        $neoModel = new NeoModel(SysDefinition::USER_DB_CONFIG);
        // Connect to Database
        $db_neo_conn = $neoModel->connect();

        if (! $db_neo_conn) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Fail to connect to DataBase!";
            return ($result); // Connect to DB failed return without further handling
        }

        // set the db table name
        $neoModel->setTableName($tblName);

        // No previous message existed, add a new one
        $bnSet = new BusinessInfoSet($jsonStr->general_enquiry_name, $jsonStr->general_enquiry_email, null, null);
        $bnSet->setMsg($jsonStr->general_enquiry_fm_message);

        if ($neoModel->addInTouchMsg($bnSet)) {
            $result["status"] = CommonDefinition::SUCCESS;
            $result["info"] = "Thanks, your message is received! Our agent will conact you soon. ";
        } else {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "ERROR! your message cannot be processed.";
        }

        $neoModel->close();
        return ($result);
    }
}
