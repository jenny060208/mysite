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
            // Connect to DB failed return without further handling
            $result["status"] = CommonDefinition::ERROR_CONN;
            $result["info"] = "Failed to connect to Server!";
        }
        // set the table name
        $mModel->setTableName($tblName);

        // Tag Info query
        $queryResult = $mModel->getTagInfo($count);

        if (CommonDefinition::SUCCESS == $queryResult->getStatus()) {
            $result["status"] = CommonDefinition::SUCCESS;

            $result["info"]["tag_id"] = $queryResult->getTagId();
            $result["info"]["tag_index"] = $queryResult->getTagIndex();
            $result["info"]["tag_number"] = $queryResult->getTagNumber();
            $result["info"]["bid"] = $queryResult->getBusinessId();
            $result["info"]["tag_label"] = $queryResult->getTagLabel();
            $result["info"]["tag_webpage"] = $queryResult->getWebPage();
            $result["info"]["current_tag"] = $queryResult->getCurrentTag();
            $result["info"]["total_tag"] = $queryResult->getTotalTag();
            $result["info"]["tag_status"] = $queryResult->getTagStatus();
            $result["info"]["tag_type"] = $queryResult->getTagType();

            // Load the tag type definition
            for ($count = 0; $count < sizeof(CommonDefinition::TAG_TYPE_DEF); $count ++) {
                $result["info"]["tag_type_def"][$count] = CommonDefinition::TAG_TYPE_DEF[$count];
            }

            // Load the tag status defition
            for ($count = 0; $count < sizeof(CommonDefinition::TAG_STATUS_DEF); $count ++) {
                $result["info"]["tag_status_def"][$count] = CommonDefinition::TAG_STATUS_DEF[$count];
            }
        } else {
            $result["status"] = CommonDefinition::ERROR;

            $result["info"]["current_tag"] = $queryResult->getCurrentTag();
            $result["info"]["total_tag"] = $queryResult->getTotalTag();
        }

        $mModel->close();
        return ($result);
    }

    // ===========================================================
    // * Name : getPreviousTagInfo
    // * Input : $$recv_data-- include current tag
    // * Output: array -- tag info
    // * Description: get the previous specified tag info
    // ===========================================================
    public function getPreviousTagInfo($recv_data)
    {
        $currentTag = $recv_data->current_tag;

        $result = array();
        $sysUtil = new SysUtility();
        $tblName = $sysUtil->getTagInfoTblName();

        $mModel = new TagManageModel(SysDefinition::USER_DB_CONFIG);
        $db_conn = $mModel->connect();

        if (! $db_conn) {
            // Connect to DB failed return without further handling
            $result["status"] = CommonDefinition::ERROR_CONN;
            $result["info"] = "Failed to connect to Server!";
            return ($result);
        }
        // set the table name
        $mModel->setTableName($tblName);

        // Step 1: Make sure db record is not empty
        // Step 2: if current tag is 1, then set the current id = 1, otherwise minus 1
        // Step 3: Load the specific tag info
        $totalTag = $mModel->getTagQuantity();

        if ($totalTag == CommonDefinition::ZERO_NUM) {
            // no record is found
            $result["status"] = CommonDefinition::ERROR_NO_RECORD;
            $result["info"] = "No more record";

            $mModel->close();
            return ($result);
        }

        if ($currentTag > $totalTag) {
            $currentTag = $totalTag;
        } else if ($currentTag == 1) {
            // No change, already the first one
            $currentTag = $currentTag;
        } else {
            $currentTag = $currentTag - 1;
        }

        // Tag Info query
        $queryResult = $mModel->getTagInfo($currentTag);

        if (CommonDefinition::SUCCESS == $queryResult->getStatus()) {
            $result["status"] = CommonDefinition::SUCCESS;

            $result["info"]["tag_id"] = $queryResult->getTagId();
            $result["info"]["tag_index"] = $queryResult->getTagIndex();
            $result["info"]["tag_number"] = $queryResult->getTagNumber();
            $result["info"]["bid"] = $queryResult->getBusinessId();
            $result["info"]["tag_label"] = $queryResult->getTagLabel();
            $result["info"]["tag_webpage"] = $queryResult->getWebPage();
            $result["info"]["current_tag"] = $queryResult->getCurrentTag();
            $result["info"]["total_tag"] = $queryResult->getTotalTag();
            $result["info"]["tag_status"] = $queryResult->getTagStatus();
            $result["info"]["tag_type"] = $queryResult->getTagType();

            // Load the tag type definition
            for ($count = 0; $count < sizeof(CommonDefinition::TAG_TYPE_DEF); $count ++) {
                $result["info"]["tag_type_def"][$count] = CommonDefinition::TAG_TYPE_DEF[$count];
            }

            // Load the tag status defition
            for ($count = 0; $count < sizeof(CommonDefinition::TAG_STATUS_DEF); $count ++) {
                $result["info"]["tag_status_def"][$count] = CommonDefinition::TAG_STATUS_DEF[$count];
            }
        } else {
            $result["status"] = CommonDefinition::ERROR_NO_RECORD;
            $result["info"] = "No more record";
        }

        $mModel->close();
        return ($result);
    }

    // ===========================================================
    // * Name : getNextTagInfo
    // * Input : $count -- tag count number start from 1
    // * Output: array -- tag info
    // * Description: get the next specified tag info
    // ===========================================================
    public function getNextTagInfo($recv_data)
    {
        $currentTag = $recv_data->current_tag;

        $result = array();
        $sysUtil = new SysUtility();
        $tblName = $sysUtil->getTagInfoTblName();

        $mModel = new TagManageModel(SysDefinition::USER_DB_CONFIG);
        $db_conn = $mModel->connect();

        if (! $db_conn) {
            // Connect to DB failed return without further handling
            $result["status"] = CommonDefinition::ERROR_CONN;
            $result["info"] = "Failed to connect to Server!";
            return ($result);
        }
        // set the table name
        $mModel->setTableName($tblName);

        // Step 1: Make sure db record is not empty
        // Step 2: if current tag is 1, then set the current id = 1, otherwise minus 1
        // Step 3: Load the specific tag info
        $totalTag = $mModel->getTagQuantity();

        if ($totalTag == CommonDefinition::ZERO_NUM) {
            // no record is found
            $result["status"] = CommonDefinition::ERROR_NO_RECORD;
            $result["info"] = "No more record";

            $mModel->close();
            return ($result);
        }

        if ($currentTag >= $totalTag) {
            $currentTag = $totalTag;
        } else {
            $currentTag = $currentTag + 1;
        }

        // Tag Info query
        $queryResult = $mModel->getTagInfo($currentTag);

        if (CommonDefinition::SUCCESS == $queryResult->getStatus()) {
            $result["status"] = CommonDefinition::SUCCESS;

            $result["info"]["tag_id"] = $queryResult->getTagId();
            $result["info"]["tag_index"] = $queryResult->getTagIndex();
            $result["info"]["tag_number"] = $queryResult->getTagNumber();
            $result["info"]["bid"] = $queryResult->getBusinessId();
            $result["info"]["tag_label"] = $queryResult->getTagLabel();
            $result["info"]["tag_webpage"] = $queryResult->getWebPage();
            $result["info"]["current_tag"] = $queryResult->getCurrentTag();
            $result["info"]["total_tag"] = $queryResult->getTotalTag();
            $result["info"]["tag_status"] = $queryResult->getTagStatus();
            $result["info"]["tag_type"] = $queryResult->getTagType();

            // Load the tag type definition
            for ($count = 0; $count < sizeof(CommonDefinition::TAG_TYPE_DEF); $count ++) {
                $result["info"]["tag_type_def"][$count] = CommonDefinition::TAG_TYPE_DEF[$count];
            }

            // Load the tag status defition
            for ($count = 0; $count < sizeof(CommonDefinition::TAG_STATUS_DEF); $count ++) {
                $result["info"]["tag_status_def"][$count] = CommonDefinition::TAG_STATUS_DEF[$count];
            }
        } else {
            $result["status"] = CommonDefinition::ERROR_NO_RECORD;
            $result["info"] = "No more record";
        }

        $mModel->close();
        return ($result);
    }

    // ===========================================================
    // * Name : getTagReport
    // * Input : None
    // * Output: array -- tag report
    // * Description: get the general tag report
    // ===========================================================
    public function getTagReport()
    {
        $result = array();
        $sysUtil = new SysUtility();
        $tblName = $sysUtil->getTagInfoTblName();

        $mModel = new TagManageModel(SysDefinition::USER_DB_CONFIG);
        $db_conn = $mModel->connect();

        if (! $db_conn) {
            // Connect to DB failed return without further handling
            $result["tag_report_total"] = CommonDefinition::ZERO_NUM;
            $result["tag_report_initial"] = CommonDefinition::ZERO_NUM;
            $result["tag_report_enable"] = CommonDefinition::ZERO_NUM;
            $result["tag_report_disable"] = CommonDefinition::ZERO_NUM;
            return ($result);
        }
        // set the table name
        $mModel->setTableName($tblName);

        // Step 1: Make sure db record is not empty
        // Step 2: if current tag is 1, then set the current id = 1, otherwise minus 1
        // Step 3: Load the specific tag info
        $result["tag_report_total"] = $mModel->getTagQuantity();

        if ($result["tag_report_total"] == CommonDefinition::ZERO_NUM) {
            // no record is found
            $result["tag_report_initial"] = CommonDefinition::ZERO_NUM;
            $result["tag_report_enable"] = CommonDefinition::ZERO_NUM;
            $result["tag_report_disable"] = CommonDefinition::ZERO_NUM;

            $mModel->close();
            return ($result);
        }
        // Status Initial
        $result["tag_report_initial"] = $mModel->getTagQuantityByStatus(1);
        // Status Enable
        $result["tag_report_disable"] = $mModel->getTagQuantityByStatus(2);
        // Status disable
        $result["tag_report_enable"] = $mModel->getTagQuantityByStatus(3);

        $mModel->close();
        return ($result);
    }
}
