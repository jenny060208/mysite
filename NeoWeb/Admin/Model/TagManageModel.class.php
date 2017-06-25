<?php

// +----------------------------------------------------------------------
// | Model for user account management
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace Admin\Model;

use Think\MyModel;
// use NeoWeb\Common\Common\SysDefinition;
use NeoWeb\Common\Common\SysUtility;
use NeoWeb\Common\Common\CommonDefinition;
use NeoWeb\Common\Common\BusinessDefinition;
use NeoWeb\Common\Common\BusinessInfoSet;
use NeoWeb\Common\Common\AllTableInfoDefinition;
use NeoWeb\Common\Common\NeoInfoSet;
use NeoWeb\Common\Common\TagInfoSet;
use NeoWeb\Admin\Common\AdminDefinition;

/**
 * Name : TagManageModel
 * Input : N/A
 * Output: N/A
 * Description: model for all tag management:
 * Create/Update, etc
 */
class TagManageModel extends MyModel
{

    // =====================================================
    // Name: checkTagIndexDuplication
    // Return: true -- tag index duplicates in Database
    // false -- tag index does not duplicate in Database
    // Parameter: tag index
    // Description: check if tag index duplication in tag table database
    // =====================================================
    public function checkTagIndexDuplication($tagIndex)
    {
        $retVal = false;

        $strQuery = "SELECT " . AllTableInfoDefinition::DB_FIELD_TAG_ID . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::DB_FIELD_TAG_INDEX . "=" . '\'' . $tagIndex . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                // More than one tag index found, means duplication found
                $retVal = true;
            }
        }

        return $retVal;
    }

    // =====================================================
    // Name: checkTagNumberDuplication
    // Return: true -- tag number duplicates in Database
    // false -- tag numberdoes not duplicate in Database
    // Parameter: tag number
    // Description: check if tag number duplication in tag table database
    // =====================================================
    public function checkTagNumberDuplication($tagNumber)
    {
        $retVal = false;

        $strQuery = "SELECT " . AllTableInfoDefinition::DB_FIELD_TAG_ID . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::DB_FIELD_TAG_NUMBER . "=" . '\'' . $tagNumber . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                // More than one tag number found, means duplication found
                $retVal = true;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: checkTagLabelDuplication
    // Return: true -- tag label duplicates in Database
    // false -- tag label does not duplicate in Database
    // Parameter: tag label
    // Description: check if tag label duplication in tag info table
    // =====================================================
    public function checkTagLabelDuplication($tagLabel)
    {
        $retVal = false;

        $strQuery = "SELECT " . AllTableInfoDefinition::DB_FIELD_TAG_ID . " FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::DB_FIELD_TAG_LABEL . "=" . '\'' . $tagLabel . '\'';

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                // More than one tag label found, means duplication found
                $retVal = true;
            }
        }
        return $retVal;
    }

    // =====================================================
    // Name: addTagInfo
    // Return: true -- Add new tag information succesfully
    // false -- Add new taginformation failed
    // Parameter: new tag create information
    // Description: Add tag information to database
    // =====================================================
    public function addTagInfo($tagSet)
    {
        $retVal = false;

        // Compose the query string
        $strQuery = "INSERT INTO " . $this->dbTblName . " (";
        $strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_ID . ", "; // Tag ID
        $strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_INDEX . ", "; // Tag index
        $strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_TYPE . ", "; // tag type
        $strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_NUMBER . ", "; // tag number
        $strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_LABEL . ", "; // tag label
        $strQuery .= AllTableInfoDefinition::DB_FIELD_BUSINESS_ID . ", "; // Business ID
        $strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_WEB_PAGE . ") VALUES ( "; // Tag web page
        $strQuery .= '\'' . $tagSet->getTagId() . '\', '; // Add Tag ID
        $strQuery .= '\'' . $tagSet->getTagIndex() . '\', '; // Add Tag index
        $strQuery .= '\'' . $tagSet->getTagType() . '\', '; // Add tag type
        $strQuery .= '\'' . $tagSet->getTagNumber() . '\', '; // Add tag number
        $strQuery .= '\'' . $tagSet->getTagLabel() . '\', '; // Add tag label
        $strQuery .= '\'' . $tagSet->getBusinessId() . '\', '; // Add Business ID
        $strQuery .= '\'' . $tagSet->getWebPage() . '\')'; // Add tag web page

        $result = $this->db->execute($strQuery);

        if (! is_bool($result)) {
            $retVal = true;
        }
        return $retVal;
    }

    // =====================================================
    // Name: getTagInfo
    // Return: query result -- specific tag info
    //
    // Parameter: count of the specific tag
    // Description: get the specific tag info
    // =====================================================
    public function getTagInfo($count)
    {
        $tagSet = new TagInfoSet(null);

        // Step 1: check total records in table
        // Step 2: compare the total and count,
        // Step 3: get the tag info of specific count and return
        $strQuery = "SELECT " . AllTableInfoDefinition::DB_FIELD_TAG_ID . " FROM " . $this->dbTblName;

        $result = $this->db->query($strQuery);

        if (is_bool($result)) {
            // return error due to query result failed
            $tagSet->setStatus(CommonDefinition::ERROR);
            $tagSet->setCurrentTag(0);
            $tagSet->setTotalTag(0);

            return ($tagSet);
        }

        if ($this->db->getRowNumber() < 1) {
            // return error due to record empty
            $tagSet->setStatus(CommonDefinition::ERROR);
            $tagSet->setCurrentTag(0);
            $tagSet->setTotalTag(0);
            return ($tagSet);
        }

        if ($count > $this->db->getRowNumber()) {
            // Set to the maximum range
            $count = $this->db->getRowNumber();
        }

        $tagSet->setCurrentTag($count);
        $tagSet->setTotalTag($this->db->getRowNumber());

        // change to index
        $count = $count - 1;

        // Get the specified row of record
        $strQuery = "SELECT * FROM " . $this->dbTblName . " limit " . $count . ",1";

        $result = $this->db->query($strQuery);

        if (! is_bool($result)) {
            if ($this->db->getRowNumber() >= 1) {
                // Load tag info
                $row = $result[0];
                $tagSet->setStatus(CommonDefinition::SUCCESS);
                $tagSet->setTagId($row[AllTableInfoDefinition::DB_FIELD_TAG_ID]);
                $tagSet->setTagIndex($row[AllTableInfoDefinition::DB_FIELD_TAG_INDEX]);
                $tagSet->setTagType($row[AllTableInfoDefinition::DB_FIELD_TAG_TYPE]);
                $tagSet->setTagNumber($row[AllTableInfoDefinition::DB_FIELD_TAG_NUMBER]);
                $tagSet->setTagLabel($row[AllTableInfoDefinition::DB_FIELD_TAG_LABEL]);
                $tagSet->setBusinessId($row[AllTableInfoDefinition::DB_FIELD_BUSINESS_ID]);
                $tagSet->setTagStatus($row[AllTableInfoDefinition::DB_FIELD_STATUS]);
                $tagSet->setWebPage($row[AllTableInfoDefinition::DB_FIELD_TAG_WEB_PAGE]);
            }
        } else {
            $tagSet->setStatus(CommonDefinition::ERROR);
            $tagSet->setCurrentTag(0);
            $tagSet->setTotalTag(0);
        }
        return ($tagSet);
    }

    // =====================================================
    // Name: deleteTagById
    // Return: true -- delete tag information succesfully
    // false -- delete tag information failed
    // Parameter: tag id
    // Description: delete tag by index of tag id
    // =====================================================
    public function deleteTagById($tagId)
    {
        $retVal = false;

        // Compose the query string
        // Query the tag id column
        $strQuery = "DELETE FROM " . $this->dbTblName . " WHERE " . AllTableInfoDefinition::DB_FIELD_TAG_ID . "=" . '\'' . $tagId . "\'";

        $result = $this->db->execute($strQuery);

        if ($result == false) {
            return ($retVal);
        } else {
            $retVal = true;
            return $retVal;
        }
    }

    // =====================================================
    // Name: updateTagById
    // Return: true -- update tag information succesfully
    // false -- update tag information failed
    // Parameter: $tagSet
    // Description: update tag by index of tag id
    // =====================================================
    public function updateTagById($tagSet)
    {
        $retVal = false;

        $strQuery = "UPDATE " . $this->dbTblName . " SET ";
        $strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_ID . "=" . '\'' . $tagSet->getTagId() . '\', ';
        $strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_INDEX . "=" . '\'' . $tagSet->getTagIndex() . '\', ';
        $strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_TYPE . "=" . '\'' . $tagSet->getTagType() . '\', ';
        $strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_NUMBER . "=" . '\'' . $tagSet->getTagNumber() . '\', ';
        $strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_LABEL . "=" . '\'' . $tagSet->getTagLabel() . '\', ';
        $strQuery .= AllTableInfoDefinition::DB_FIELD_BUSINESS_ID . "=" . '\'' . $tagSet->getBusinessId() . '\', ';
        $strQuery .= AllTableInfoDefinition::DB_FIELD_STATUS . "=" . '\'' . $tagSet->getStatus() . '\', ';
        $strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_WEB_PAGE . "=" . '\'' . $tagSet->getWebPage() . '\'';
        $strQuery .= " WHERE ";
        $strQuery .= AllTableInfoDefinition::DB_FIELD_TAG_ID . "=" . '\'' . $tagSet->getTagId() . '\'';

        // 'UPDATE runoob_tbl SET runoob_title="Learning JAVA" WHERE runoob_id=3';

        $result = $this->db->execute($strQuery);

        if ($result == false) {
            return ($retVal);
        } else {
            $retVal = true;
            return $retVal;
        }
    }
}

