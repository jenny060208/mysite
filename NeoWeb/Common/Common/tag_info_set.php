<?php

namespace NeoWeb\Common\Common;

// This file holds the class of business account information class set
/**
 * Enter description here ...
 *
 * @author jazwang
 *        
 */
class TagInfoSet {
	private $status;
	private $info;
	private $tagId;
	private $tagSrc;
	private $webPage;
	private $scanTime;
	private $businessId;
	private $tagNumber; // describe the tag number
	private $tagLable; // describe the tag lable -- where is the tag located
	                   
	// Construct function
	public function __construct($tagId) {
		$this->status = null;
		$this->info = null;
		$this->tagId = $tagId;
		$this->tagSrc = null;
		$this->webPage = null;
		$this->scanTime = null;
		$this->businessId = null;
		$this->tagNumber = null;
		$this->tagLable = null;
	}
	
	// Desstruct function
	public function __destruct() {
	}
	
	// for Tag process status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return ($this->status);
	}
	
	// for Tag process info
	public function setInfo($info) {
		$this->info = $info;
	}
	public function getInfo() {
		return ($this->info);
	}
	
	// for Tag ID
	public function setTagId($tagId) {
		$this->tagId = $tagId;
	}
	public function getTagId() {
		return ($this->tagId);
	}
	
	// for Tag Soruce
	public function setTagSrc($tagSrc) {
		$this->tagSrc = $tagSrc;
	}
	public function getTagSrc() {
		return ($this->tagSrc);
	}
	
	// for webPage
	public function setWebPage($webPage) {
		$this->webPage = $webPage;
	}
	public function getWebPage() {
		return ($this->webPage);
	}
	
	// for Scan time
	public function setScanTime($scanTime) {
		$this->scanTime = $scanTime;
	}
	public function getScanTime() {
		return ($this->scanTime);
	}
	
	// for Business ID
	public function setBusinessId($businessId) {
		$this->businessId = $businessId;
	}
	public function getBusinessId() {
		return ($this->businessId);
	}
	
	// for tag number
	public function setTagNumber($tagNumber) {
		$this->tagNumber = $tagNumber;
	}
	public function getTagNumber() {
		return ($this->tagNumber);
	}
	
	// for Tag Lable
	public function setTagLable($tagLable) {
		$this->tagLable = $tagLable;
	}
	public function getTagLable() {
		return ($this->tagLable);
	}
}

?>
