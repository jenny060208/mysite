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
use NeoWeb\Common\Common\TagInfoSet;

/**
 * Name : NeoDashBoard1Logic
 * Input : N/A
 * Output: N/A
 * Description: Logic for all Neo company related dashboard 1 (Potential merchant) management:
 * Product type, order, status information.
 */
class ScanTagProcessLogic extends Logic
{

    /**
     * Name : tagProcess
     * Input : tagId
     * Output: tagId process result
     *
     * Description: Tag Id process result
     * TAG Rule: tag length should be 10 characters:
     * raw tag ID: 5 characters;
     * Tag type: is 1 characters: 1 --> QR code; 2 --> NFC; 3 --> SMS input
     * validation: 4 characters:
     * Step 1: MD5 hash for the first five characters
     * Step 2: hash string + "Neo"
     * Step 3: md5 hash for the above string, pick characters from 3 -- 6
     * Step 4: then compare to the validation characters
     */
    public function tagProcess($Id)
    {
        $tagSet = new TagInfoSet($Id);

        $sysUtil = new SysUtility();
        $tagSet = $sysUtil->decodeTagId($tagSet);

        if ((null == $tagSet->getTagIndex()) || (null == $tagSet->getTagType())) {
            $tagSet->setStatus(CommonDefinition::ERROR);
            $tagSet->setInfo("ERROR! Invalid Code scanned!");

            return ($tagSet); // Connect to DB failed return without further handling
        }

        // Step 1: find the matched advertisement web page
        // Step 2: Log the scan event
        // Step 3: direct to the desired web page

        $tblName = $sysUtil->getTagWebPageTblName();

        $neoModel = new NeoModel(SysDefinition::USER_DB_CONFIG);
        // Connect to Database
        $db_neo_conn = $neoModel->connect();

        if (! $db_neo_conn) {
            $tagSet->setStatus(CommonDefinition::ERROR);
            $tagSet->setInfo("Fail to connect to DataBase!");

            return ($tagSet); // Connect to DB failed return without further handling
        }

        // set the db table name
        $neoModel->setTableName($tblName);
        $queryResult = $neoModel->getTagInfoById($tagSet->getTagId());

        if (! is_bool($queryResult)) {
            $queryResult->setStatus(CommonDefinition::SUCCESS);
            $queryResult->setTagType($tagSet->getTagType());

            $neoModel->close();
            return ($queryResult);
        } else {
            $queryResult->setStatus(CommonDefinition::ERROR);
            $queryResult->setInfo("ERROR! Invalid Code scanned!");

            $neoModel->close();
            return (false);
        }
    }

    /**
     * Name : scanEventLog
     * Input : $eventData -- event data set needs to be logged
     * Output: log result
     */
    public function scanEventLog($eventSet)
    {
        $sysUtil = new SysUtility();
        $tblName = $sysUtil->getTagScanEventTblName($bid);

        $neoModel = new NeoModel(SysDefinition::USER_DB_CONFIG);
        // Connect to Database
        $db_neo_conn = $neoModel->connect();

        if (! $db_neo_conn) {
            return (false); // Connect to DB failed return without further handling
        }

        // set the db table name
        $neoModel->setTableName($tblName);
        $queryResult = $neoModel->addTagScanEvent($eventSet);

        $neoModel->close();
        return ($queryResult); // return true or false
    }

    /**
     * Name : errorEventLog
     * Input : $eventData -- error scan event data needs to be logged
     * Output: log result
     */
    public function errorEventLog($eventData)
    {
        $sysUtil = new SysUtility();
        $tblName = $sysUtil->getTagScanErrorEventTblName();

        $neoModel = new NeoModel(SysDefinition::USER_DB_CONFIG);
        // Connect to Database
        $db_neo_conn = $neoModel->connect();

        if (! $db_neo_conn) {
            return (false); // Connect to DB failed return without further handling
        }

        // set the db table name
        $neoModel->setTableName($tblName);
        $queryResult = $neoModel->addTagScanErrorEvent($eventSet);

        $neoModel->close();
        return ($queryResult); // return true or false
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
