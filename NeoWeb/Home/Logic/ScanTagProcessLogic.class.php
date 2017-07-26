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

        if (false == $tagSet->getStatus()) {
            $tagSet->setStatus(false);
            $tagSet->setInfo("5678 ERROR! Invalid Code scanned!");

            return ($tagSet); // Connect to DB failed return without further handling
        }

        // Step 1: find the matched advertisement web page
        // Step 2: Log the scan event
        // Step 3: direct to the desired web page

        $tblName = $sysUtil->getTagInfoTblName();

        $neoModel = new NeoModel(SysDefinition::USER_DB_CONFIG);
        // Connect to Database
        $db_neo_conn = $neoModel->connect();

        if (! $db_neo_conn) {
            $tagSet->setStatus(false);
            $tagSet->setInfo("Fail to connect to DataBase!");

            return ($tagSet); // Connect to DB failed return without further handling
        }

        // set the db table name
        $neoModel->setTableName($tblName);
        $queryResult = $neoModel->getTagInfoById($tagSet->getTagId());

        if ($queryResult->getStatus()) {
            $queryResult->setTagType($tagSet->getTagType());
        } else {
            $queryResult->setStatus(false);
            $queryResult->setInfo("7367 ERROR! Invalid Code scanned!");
        }

        $neoModel->close();
        return ($queryResult);
    }

    /**
     * Name : scanEventLog
     * Input : $eventData -- event data set needs to be logged
     * Output: log result
     */
    public function scanEventLog($setData)
    {
        $sysUtil = new SysUtility();
        $tblName = $sysUtil->getTagScanEventTblName($setData->getBusinessId());

        $neoModel = new NeoModel(SysDefinition::USER_DB_CONFIG);
        // Connect to Database
        $db_neo_conn = $neoModel->connect();

        if (! $db_neo_conn) {
            return (false); // Connect to DB failed return without further handling
        }

        echo ("scan log Table name = " . $tblName);

        // set the db table name
        $neoModel->setTableName($tblName);
        $queryResult = $neoModel->addTagScanEvent($setData);

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
}
