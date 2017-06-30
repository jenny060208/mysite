<?php

// +----------------------------------------------------------------------
// | Logic fortag update Create
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Admin\Logic;

use Admin\Model\TagManageModel;
use Admin\Model\AccountModel;
use Admin\Model\MerchantModel;
use NeoWeb\Admin\Common\AdminDefinition;
use NeoWeb\Admin\Common\AdminUtilities;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\SysDefinition;
use NeoWeb\Common\Common\SysUtility;
use NeoWeb\Common\Common\TagInfoSet;

/**
 * Name : TagUpdateLogic
 * Input : N/A
 * Output: N/A
 * Description: Logic for tag info update.
 */
class TagUpdateLogic extends Logic
{

    // ===========================================================
    // * Name : tagDelete
    // * Input : $recv_data-- tag data for delete operation
    // * Output: array -- tag info
    // * Description: delete the specific tag
    // ===========================================================
    public function tagDelete($recv_data)
    {
        $currentTag = (int) ($recv_data->current_tag);
        $tagId = $recv_data->tag_id;

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

        // Delete the tag by tag id
        $queryResult = $mModel->deleteTagById($tagId);

        if ($queryResult == true) {
            // the specific one deleted already, display the next one
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
                $result["status"] = CommonDefinition::ERROR;

                $result["info"]["current_tag"] = $queryResult->getCurrentTag();
                $result["info"]["total_tag"] = $queryResult->getTotalTag();
            }
        } else {
            $result["status"] = CommonDefinition::ERROR_NO_RECORD;
            $result["info"] = "No more record, Delete tag id operation failed";
        }

        $mModel->close();
        return ($result);
    }

    // ===========================================================
    // * Name : tagUpdate
    // * Input : $recv_data -- tag data for update operation
    // * Output: array -- tag info
    // * Description: specified tag info update
    // ===========================================================
    public function tagUpdate($recv_data)
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
            $result["info"] = "Error! No tag existed, please refresh and try it again!";

            $mModel->close();
            return ($result);
        }

        $tagStatsTemp = $sysUtil->getTagStatusIndex($recv_data->tag_status);
        $tagTypeTemp = $sysUtil->getTagTypeIndex($recv_data->tag_type);

        $tagSet = new TagInfoSet($recv_data->tag_id);
        $tagSet->setTagIndex($recv_data->tag_index);
        $tagSet->setTagNumber($recv_data->tag_number);
        $tagSet->setTagStatus($tagStatsTemp);
        $tagSet->setTagType($tagTypeTemp);
        $tagSet->setBusinessId($recv_data->tag_bid);
        $tagSet->setTagLabel($recv_data->tag_label);
        $tagSet->setWebPage($recv_data->tag_web_page);
        $tagSet->setCurrentTag($recv_data->current_tag);
        $tagSet->setTotalTag($recv_data->total_tag);

        // Verify the business id length
        if (strlen($tagSet->getBusinessId()) > 30) {
            // no record is found
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error! Business ID length beyond range";

            $mModel->close();
            return ($result);
        } else if (strlen($tagSet->getTagLabel()) > 100) {
            // no record is found
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error! Tag Label length beyond range";

            $mModel->close();
            return ($result);
        } else if (strlen($tagSet->getWebPage()) > 150) {
            // no record is found
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error! Tag Web Page length beyond range";

            $mModel->close();
            return ($result);
        }

        // Delete the tag by tag id
        $queryResult = $mModel->updateTagById($tagSet);

        if ($queryResult == true) {

            $result["status"] = CommonDefinition::SUCCESS;
            $result["info"] = "Success! Your Tag information is updated.";
        } else {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error! This tag information update is failed.";
        }

        $mModel->close();
        return ($result);
    }
}
