<?php
namespace NeoWeb\Common\Common;

// This file holds the class of business account information class set
/**
 * Enter description here ...
 *
 * @author jazwang
 *
 */
class TagInfoSet
{

    private $status;

    private $info;

    private $tagId;

    private $tagIndex;

    private $tagType;

    private $webPage;

    private $scanTime;

    private $businessId;

    private $tagNumber;

    private $tagStatus;

    private $currentTag;

    private $totalTags;

    // describe the tag
    private $tagLabel;

    // describe the tag lable -- where is the tag located

    // Construct function
    public function __construct($tagId)
    {
        $this->status = null;
        $this->info = null;
        $this->tagId = $tagId;
        $this->tagIndex = null;
        $this->tagType = null;
        $this->tagStatus = null;
        $this->webPage = null;
        $this->scanTime = null;
        $this->businessId = null;
        $this->tagNumber = null;
        $this->tagLabel = null;

        $this->currentTag = 0;
        $this->totalTags = 0;
    }

    // Desstruct function
    public function __destruct()
    {}

    // for Tag process status
    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getStatus()
    {
        return ($this->status);
    }

    // for Tag process info
    public function setInfo($info)
    {
        $this->info = $info;
    }

    public function getInfo()
    {
        return ($this->info);
    }

    // for Tag ID
    public function setTagId($tagId)
    {
        $this->tagId = $tagId;
    }

    public function getTagId()
    {
        return ($this->tagId);
    }

    // ============================================
    // for Tag Index
    // ============================================
    public function setTagIndex($index)
    {
        $this->tagIndex = $index;
    }

    public function getTagIndex()
    {
        return ($this->tagIndex);
    }

    // for Tag type
    public function setTagType($tagType)
    {
        $this->tagType = $tagType;
    }

    public function getTagType()
    {
        return ($this->tagType);
    }

    // for Tag status
    public function setTagStatus($tagStatus)
    {
        $this->tagStatus = $tagStatus;
    }

    public function getTagStatus()
    {
        return ($this->tagStatus);
    }

    // for webPage
    public function setWebPage($webPage)
    {
        $this->webPage = $webPage;
    }

    public function getWebPage()
    {
        return ($this->webPage);
    }

    // for Scan time
    public function setScanTime($scanTime)
    {
        $this->scanTime = $scanTime;
    }

    public function getScanTime()
    {
        return ($this->scanTime);
    }

    // for Business ID
    public function setBusinessId($businessId)
    {
        $this->businessId = $businessId;
    }

    public function getBusinessId()
    {
        return ($this->businessId);
    }

    // for tag number
    public function setTagNumber($tagNumber)
    {
        $this->tagNumber = $tagNumber;
    }

    public function getTagNumber()
    {
        return ($this->tagNumber);
    }

    // for Tag Lable
    public function setTagLabel($tagLabel)
    {
        $this->tagLabel = $tagLabel;
    }

    public function getTagLabel()
    {
        return ($this->tagLabel);
    }

    // for current count tag
    public function setCurrentTag($count)
    {
        $this->currentTag = $count;
    }

    public function getCurrentTag()
    {
        return ($this->currentTag);
    }

    // for total count tag
    public function setTotalTag($count)
    {
        $this->totalTags = $count;
    }

    public function getTotalTag()
    {
        return ($this->totalTags);
    }
}

?>
