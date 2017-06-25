<?php

// +----------------------------------------------------------------------
// | Logic for Tag Create
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
class TagCreateLogic extends Logic
{

    /**
     * Name : tagCreate
     * Input : create tag information
     * Output: array -- create tag process result
     * Description: Tag Id process result
     * TAG Rule: tag length should be 10 characters:
     * raw tag ID: 6 characters;
     * Tag type: is 1 characters: 1 --> QR code; 2 --> NFC; 3 --> SMS input
     * validation: 3 characters:
     * Step 1: MD5 hash for the first six characters
     * Step 2: hash string + "Neo"
     * Step 3: md5 hash for the above string, pick characters from 3 -- 5
     * Step 4: then compare to the validation characters
     */
    public function tagCreate($recvData)
    {
        $result = array();
        $sysUtil = new SysUtility();
        $tagSet = new TagInfoSet(null);

        $tagTypeIndex = $sysUtil->decodeTagType($recvData->c_tag_type);
        if ($tagTypeIndex == 255) {
            $result["status"] = CommonDefinition::ERROR_CHECK_FIELD;
            $result["info"] = "Error! Invalid Tag Type!!!";
        }

        $tagSet->setTagType($tagTypeIndex);

        // Step 1: input field data validation
        // Step 2: check code validation
        // Step 3: check if root account existed already

        // Create tag index ID,
        $mModel = new TagManageModel(SysDefinition::USER_DB_CONFIG);
        $db_conn = $mModel->connect();

        if (! $db_conn) {
            $result["status"] = CommonDefinition::ERROR_CONN;
            $result["info"] = "Failed to connect to Server!";
            return ($result); // Connect to DB failed return without further handling
        }

        $tblName = $sysUtil->getTagInfoTblName();
        $mModel->setTableName($tblName);

        // $tagSet->setTagIndex("abcdef");
        $tagSet->setTagNumber("12345678");

        // generate tag index
        // Check the tag index duplication:
        $stepFlag = true;
        while ($stepFlag) {
            $strTemp = $sysUtil->generateTagIndex();
            if (! $mModel->checkTagIndexDuplication($strTemp)) {
                $stepFlag = false; // exit loop
                $tagSet->setTagIndex($strTemp);
            }
        }

        // generate tag number
        // Check the tag number duplication:
        $stepFlag = true;
        while ($stepFlag) {
            $strTemp = $sysUtil->generateTagNumber();
            if (! $mModel->checkTagNumberDuplication($strTemp)) {
                $stepFlag = false; // exit loop
                $tagSet->setTagNumber($strTemp);
            }
        }

        // generate the TAG ID
        $tagIdTemp = $sysUtil->generateTagId($tagSet);

        $tagSet->setTagId($tagIdTemp);

        $tagSet->setTagLabel("New Tag Label");
        $tagSet->setBusinessId("New Tag");
        $tagSet->setWebPage("New Web Page");

        if ($mModel->addTagInfo($tagSet)) {
            $result['status'] = CommonDefinition::SUCCESS;
            $result['info'] = "Success to create the new tag!";
        } else {
            $result['status'] = CommonDefinition::ERROR;
            $result['info'] = "ERROR: Create new tag failed!!!";
        }

        $mModel->close();
        return ($result);
    }
}
