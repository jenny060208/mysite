<?php
namespace NeoWeb\Common\Common;

// This file holds the class of information class set
class UserInfoSet
{

    private $userName;

    private $firstName;

    private $lastName;

    private $mobile;

    private $email;

    private $password;

    private $postalCode;

    private $tagId;

    private $businessId;

    private $regDate;

    private $status;

    private $address1;

    private $address2;

    private $city;

    private $province;

    private $country;

    private $birthday;

    private $birthMonth;

    private $storeNotice;

    private $neoNotice;

    // Construct function
    public function __construct($userName, $mobile, $email, $password)
    {
        $this->userName = $userName;

        $this->firstName = null;

        $this->lastName = null;

        $this->mobile = $mobile;
        $this->email = $email;
        $this->password = $password;

        $this->tagId = null;
        $this->businessId = null;

        $this->postalCode = null;
        $this->regDate = null;
        $this->status = null;
        $this->address1 = null;
        $this->address2 = null;
        $this->city = null;
        $this->province = null;
        $this->country = null;
        $this->birthday = null;
        $this->birthMonth = null;
        $this->storeNotice = null;
        $this->neoNotice = null;
    }

    // Desstruct function
    public function __destruct()
    {}

    // for user name
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    public function getUserName()
    {
        return ($this->userName);
    }

    // for first name
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    public function getFirstName()
    {
        return ($this->firstName);
    }

    // for last name
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    public function getLastName()
    {
        return ($this->lastName);
    }

    // for mobile Access
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    public function getMobile()
    {
        return ($this->mobile);
    }

    // For Email Access
    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return ($this->email);
    }

    // For Password Access
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return ($this->password);
    }

    // For postalCode Access
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }

    public function getPostalCode()
    {
        return ($this->postalCode);
    }

    // For TagId Access
    public function setTagId($tagId)
    {
        $this->tagId = $tagId;
    }

    public function getTagId()
    {
        return ($this->tagId);
    }

    // For Register date Access
    public function setRegDate($regDate)
    {
        $this->regDate = $regDate;
    }

    // For business Id Access
    public function setBusinessId($businessId)
    {
        $this->businessId = $businessId;
    }

    public function getBusinessId()
    {
        return ($this->businessId);
    }

    public function getRegDate()
    {
        return ($this->regDate);
    }

    // For user Status
    public function setUserStatus($status)
    {
        $this->status = $status;
    }

    public function getUserStatus()
    {
        return ($this->status);
    }

    // For Address 1
    public function setAddress1($address)
    {
        $this->address1 = $address;
    }

    public function getAddress1()
    {
        return ($this->address1);
    }

    // For Address 2
    public function setAddress2($address)
    {
        $this->address2 = $address;
    }

    public function getAddress2()
    {
        return ($this->address2);
    }

    // For City
    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getCity()
    {
        return ($this->city);
    }

    // For Province
    public function setProvince($province)
    {
        $this->province = $province;
    }

    public function getProvince()
    {
        return ($this->province);
    }

    // For Country
    public function setCountry($country)
    {
        $this->country = $country;
    }

    public function getCountry()
    {
        return ($this->country);
    }

    // For Birthday
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    public function getBirthday()
    {
        return ($this->birthday);
    }

    // For Birth Month
    public function setBirthMonth($birthMonth)
    {
        $this->birthMonth = $birthMonth;
    }

    public function getBirthMonth()
    {
        return ($this->birthMonth);
    }

    // For Store Notice
    public function setStoreNotice($storeNotice)
    {
        $this->storeNotice = $storeNotice;
    }

    public function getStoreNotice()
    {
        return ($this->storeNotice);
    }

    // For Neo Notice
    public function setNeoNotice($neoNotice)
    {
        $this->neoNotice = $neoNotice;
    }

    public function getNeoNotice()
    {
        return ($this->neoNotice);
    }
}

?>