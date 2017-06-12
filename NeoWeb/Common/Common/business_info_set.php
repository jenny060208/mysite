<?php

namespace NeoWeb\Common\Common;

// This file holds the class of business account information class set
/**
 * Enter description here ...
 *
 * @author jazwang
 *        
 */
class BusinessInfoSet {
	private $fullName;
	private $email;
	private $emailAlt;
	private $phone;
	private $mobile;
	private $businessName;
	private $password;
	private $businessId;
	private $regDate;
	private $status;
	private $bnType;
	private $address;
	private $addressAlt;
	private $city;
	private $province;
	private $country;
	private $postalCode;
	private $msg;
	private $msgSubject;
	private $msgFlag;
	private $uid;
	
	// Construct function
	public function __construct($fullName, $email, $phone, $businessName) {
		$this->fullName = $fullName;
		$this->email = $email;
		$this->phone = $phone;
		$this->businessName = $businessName;
		$this->password = null;
		$this->businessId = null;
		$this->regDate = null;
		$this->status = null;
		$this->emailAlt = null;
		$this->mobile = null;
		$this->bnType = null;
		$this->address = null;
		$this->addressAlt = null;
		$this->city = null;
		$this->province = null;
		$this->country = null;
		$this->postalCode = null;
		$this->msg = null;
		$this->msgSubject = null;
		$this->msgFlag = null;
		$this->uid = null;
	}
	
	// Desstruct function
	public function __destruct() {
	}
	
	// for full name
	public function setFullName($fullName) {
		$this->fullName = $fullName;
	}
	public function getFullName() {
		return ($this->fullName);
	}
	
	// for email
	public function setEmail($email) {
		$this->email = $email;
	}
	public function getEmail() {
		return ($this->email);
	}
	
	// for phone
	public function setPhone($phone) {
		$this->phone = $phone;
	}
	public function getPhone() {
		return ($this->phone);
	}
	
	// for business name
	public function setBusinessName($businessName) {
		$this->businessName = $businessName;
	}
	public function getBusinessName() {
		return ($this->businessName);
	}
	
	// for password
	public function setPassword($password) {
		$this->password = $password;
	}
	public function getPassword() {
		return ($this->password);
	}
	
	// for Regist date
	public function setRegDate($regDate) {
		$this->regDate = $regDate;
	}
	public function getRegDate() {
		return ($this->regDate);
	}
	
	// for business id
	public function setBusinessId($businessId) {
		$this->businessId = $businessId;
	}
	public function getBusinessId() {
		return ($this->businessId);
	}
	
	// for business account status
	public function setStatus($status) {
		$this->status = $status;
	}
	public function getStatus() {
		return ($this->status);
	}
	
	// for business email alt
	public function setEmailAlt($email) {
		$this->emailAlt = $email;
	}
	public function getEmailAlt() {
		return ($this->emailAlt);
	}
	
	// for business mobile
	public function setMobile($mobile) {
		$this->mobile = $mobile;
	}
	public function getMobile() {
		return ($this->mobile);
	}
	
	// for business type
	public function setBnType($type) {
		$this->bnType = $type;
	}
	public function getBnType() {
		return ($this->bnType);
	}
	
	// for business address
	public function setAddress($address) {
		$this->address = $address;
	}
	public function getAddress() {
		return ($this->address);
	}
	
	// for business address Alternative
	public function setAddressAlt($address) {
		$this->addressAlt = $address;
	}
	public function getAddressAlt() {
		return ($this->addressAlt);
	}
	
	// for business city
	public function setCity($city) {
		$this->city = $city;
	}
	public function getCity() {
		return ($this->city);
	}
	
	// for business province
	public function setProvince($province) {
		$this->province = $province;
	}
	public function getProvince() {
		return ($this->province);
	}
	
	// for business country
	public function setCountry($country) {
		$this->country = $country;
	}
	public function getCountry() {
		return ($this->country);
	}
	
	// for business postal code
	public function setPostalCode($postalCode) {
		$this->postalCode = $postalCode;
	}
	public function getPostalCode() {
		return ($this->postalCode);
	}
	
	// for business account msg subject
	public function setMsgSubject($msgSubject) {
		$this->msgSubject = $msgSubject;
	}
	public function getMsgSubject() {
		return ($this->msgSubject);
	}
	
	// for business account msg
	public function setMsg($msg) {
		$this->msg = $msg;
	}
	public function getMsg() {
		return ($this->msg);
	}
	
	// for business account msg flag
	public function setMsgFlag($msgFlag) {
		$this->msgFlag = $msgFlag;
	}
	public function getMsgFlag() {
		return ($this->msgFlag);
	}
	
	// for Uinque ID
	public function setUid($uid) {
		$this->uid = $uid;
	}
	public function getUid() {
		return ($this->uid);
	}
}

?>
