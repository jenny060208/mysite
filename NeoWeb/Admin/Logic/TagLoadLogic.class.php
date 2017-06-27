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

        if (CommonDefinition::SUCCESS == $queryResult["status"]) {
            $result["status"] = CommonDefinition::SUCCESS;

            $result["info"]["tag_id"] = $queryResult->getTagId();
            $result["info"]["tag_index"] = $queryResult->getTagIndex();
            $result["info"]["tag_number"] = $queryResult->getTagNumber();
            $result["info"]["bid"] = $queryResult->getBusinessId();
            $result["info"]["tag_label"] = $queryResult->getTagLabel();
            $result["info"]["tag_webpage"] = $queryResult->getWebPage();
            $result["info"]["current_tag"] = $queryResult->getCurrentTag();
            $result["info"]["total_tag"] = $queryResult->getTotalTag();
            $result["info"]["total_status"] = $queryResult->getTagStatus();
            $result["info"]["total_type"] = $queryResult->getTagType();

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

        $dbModel->close();
        return ($result);
    }
}
