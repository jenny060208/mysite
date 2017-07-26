<?php

// User process related utility functions in this file
namespace NeoWeb\Common\Common;

require_once ("system_definition.php");
require_once ("common_definition.php");
require_once ("business_definition.php");
require_once ("neo_product_definition.php");
require_once ("all_table_info_definition.php");

class SysUtility
{

    // Construction register
    public function __construct()
    {}

    // Desstruct function
    public function __destruct()
    {}

    // =====================================================
    // Name: checkFormField
    // Return: Form field check result
    // TRUE -- check success
    // FALSE -- check failed
    // Parameter: $fieldValue -- user field value
    // $fieldType -- user field type
    // Description: Check the user field information
    // =====================================================
    public function checkFormField($field, $type)
    {
        $checkFlag = TRUE;
        $value = trim($field);
        $strlen = strlen($value);

        switch ($type) {
            case (CommonDefinition::REG_NAME_ID):
                {
                    // $pattern = "/^[a-zA-Z0-9_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]+$/";

                    if (($strlen < 1) || ($strlen > 100)) {
                        $checkFlag = FALSE;
                    }

                    break;
                }
            case (CommonDefinition::REG_EMAIL_ID):
                {
                    $pattern = "/^([\.a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/";

                    if (! preg_match($pattern, $value)) {
                        $checkFlag = FALSE;
                    }
                    break;
                }
            case (CommonDefinition::REG_MOBILE_ID):
                {
                    $pattern = "/^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/";

                    if (($strlen < 10) || ($strlen > 15)) {
                        $checkFlag = FALSE;
                    } else if (! preg_match($pattern, $value)) {
                        $checkFlag = FALSE;
                    }
                    break;
                }
            case (CommonDefinition::REG_PASSWORD_ID):
                {
                    if (($strlen < 4) || ($strlen > 10)) {
                        $checkFlag = FALSE;
                    }
                    break;
                }
            case (CommonDefinition::REG_POSTAL_CODE_ID):
                {
                    $pattern_ca = '/^([a-zA-Z]\d[a-zA-Z])\ {0,1}(\d[a-zA-Z]\d)$/';
                    $pattern_usa = '/^[0-9]{5}([- ]?[0-9]{4})?$/';

                    if (($strlen < 5) || ($strlen > 12)) {
                        $checkFlag = FALSE;
                    } else {
                        if (preg_match($pattern_ca, $value)) {
                            $checkFlag = TRUE;
                        } else if (preg_match($pattern_usa, $value)) {
                            $checkFlag = TRUE;
                        } else {
                            $checkFlag = FALSE;
                        }
                    }
                    break;
                }
            case (CommonDefinition::REG_BIRTHDAY_ID_1):
                {
                    if ($strlen > 5) {
                        $checkFlag = FALSE;
                    } else {
                        // Get the day first
                        $strTemp = substr($value, 0, 2);
                        $dateTemp = intval($strTemp, 10);
                        if (($dateTemp == 0) || ($dateTemp > 31)) {
                            return (FALSE);
                        }
                        // Get the Month Value
                        $strTemp = substr($value, 3, 2);
                        $dateTemp = intval($strTemp, 10);

                        if (($dateTemp == 0) || ($dateTemp > 12)) {
                            return (FALSE);
                        }
                    }
                    break;
                }
            default:
                $checkFlag = FALSE;
                break;
        }
        return ($checkFlag);
    }

    // =====================================================
    // Name: validateTelAreaCode
    // Return: validata the supported telphone number area code
    //
    // Parameter: telephone number
    // Description: areacode -- supported area code found
    // false -- not a supported area code found
    // =====================================================
    public function validateTelAreaCode($telNumber)
    {
        $retVal = false;
        // Get the input phone number area code
        $areaCode = substr($telNumber, 0, 3);

        for ($counter = 0; $counter < count(CommonDefinition::PROVINCE_INDEX_AREA_CODE); $counter ++) {
            $tempStr = CommonDefinition::PROVINCE_INDEX_AREA_CODE[$counter];

            if (CommonDefinition::SAME_RESULT == strcasecmp($areaCode, $tempStr)) {
                // return due to area code matched
                return ($tempStr);
            }
        }

        return ($retVal);
    }

    // =====================================================
    // Name: checkTagIndex
    // Return: Form field check result
    // TRUE -- check success
    // FALSE -- check failed
    // Parameter: $tagIndex-- tag index
    //
    // Description: Check the tag index information,
    // Tag index range from HEX 10 0001 -- ff ff00
    // =====================================================
    public function checkTagIndex($tagIndex)
    {
        // Tag index must be 0 - 9 or a-f
        $pattern = "/^([\.a-f0-9_-])/";

        $tempStr = strtolower($tagIndex);
        $strlen = strlen($tempStr);

        if ($strlen != 6) {
            return (false);
        }

        // String must be characters of 0-9 or a-f
        if (preg_match($pattern, $tempStr)) {
            return (true);
        } else {
            return (false);
        }
    }

    // =====================================================
    // Name: checkTagType
    // Return: Form field check result
    // TRUE -- check success
    // FALSE -- check failed
    // Parameter: $tagType-- tag type
    //
    // Description: Check the tag type information
    // =====================================================
    public function checkTagType($tagType)
    {
        // Tag type must be 1 - 3
        $pattern = "/^([\.1-3_-])/";

        $strlen = strlen($tagType);

        if ($strlen != 1) {
            return (false);
        }

        if (preg_match($pattern, $tagType)) {
            return (true);
        } else {
            return (false);
        }
    }

    // =====================================================
    // Name: decodeTagType
    // Return: tag type serial code
    // Parameter: $tagType-- tag type name
    //
    // Description: decode the tag type name to index
    // =====================================================
    public function decodeTagType($tagType)
    {
        $tagIndex = 255; // invalid indication

        for ($count = 0; $count < sizeof(CommonDefinition::TAG_TYPE_DEF); $count ++) {
            if (CommonDefinition::SAME_RESULT == strcasecmp($tagType, CommonDefinition::TAG_TYPE_DEF[$count])) {
                return ($count + 1);
            }
        }

        CommonDefinition::TAG_TYPE_DEF;
    }

    // =====================================================
    // Name: encodeTagType
    // Return: tag type name
    // Parameter: $tagTypeIndex -- tag type code
    //
    // Description: encode the tag type index to name
    // =====================================================
    public function encodeTagType($tagTypeIndex)
    {
        if ($tagTypeIndex > sizeof(CommonDefinition::TAG_TYPE_DEF)) {
            // return due to index beyond range
            return (null);
        }

        $tagTypeIndex = $tagTypeIndex - 1;

        return (CommonDefinition::TAG_TYPE_DEF[$tagTypeIndex]);
    }

    // =====================================================
    // Name: checkTagNumber
    // Return: Form field check result
    // TRUE -- check success
    // FALSE -- check failed
    // Parameter: $tagNumber-- tag number
    //
    // Description: Check the tag number information
    // Tag number range from HEX 1000 0001 -- ffff f000
    // =====================================================
    public function checkTagNumber($tagNumber)
    {
        // Tag number must be 0 - 9 or a-f
        $pattern = "/^([\.a-f0-9_-])/";

        $strlen = strlen($tagNumber);

        if ($strlen > 8) {
            return (false);
        }

        if (preg_match($pattern, $tagNumber)) {
            return (true);
        } else {
            return (false);
        }
    }

    // =====================================================
    // Name: checkTagLabel
    // Return: Form field check result
    // TRUE -- check success
    // FALSE -- check failed
    // Parameter: $tagLabel-- tag label
    //
    // Description: Check the tag label information
    // =====================================================
    public function checkTagLabel($tagLabel)
    {
        // Tag number must be 0 - 9
        // $pattern = "/^([\.0-9_-])/";
        $strlen = strlen($tagType);

        if ($strlen > 100) {
            return (false);
        } else if ($strlen == 0) {
            return (false);
        } else {
            return (true);
        }

        // if (preg_match($pattern, $tagNumber)) {
        // return (true);
        // } else {
        // return (false);
        // }
    }

    // =====================================================
    // Name: checkTagWebPage
    // Return: Form field check result
    // TRUE -- check success
    // FALSE -- check failed
    // Parameter: $webPage-- tag web page
    //
    // Description: Check the tag web pageinformation
    // =====================================================
    public function checkTagWebPage($webPage)
    {
        // Tag number must be 0 - 9
        // $pattern = "/^([\.0-9_-])/";
        $strlen = strlen($tagType);

        if ($strlen > 150) {
            return (false);
        } else if ($strlen == 0) {
            return (false);
        } else {
            return (true);
        }

        // if (preg_match($pattern, $tagNumber)) {
        // return (true);
        // } else {
        // return (false);
        // }
    }

    // =====================================================
    // Name: generateUserInfoTableName
    // Return: user account info table name
    //
    // Parameter: user mobile
    // Description: generate the user account info table name
    // =====================================================
    public function generateUserInfoTableName($str_user_mobile)
    {
        $strAreaCode = trim($str_user_mobile);
        $strAreaCode = substr($strAreaCode, 0, 3); // get area code from the phone number

        $strTableName = AllTableInfoDefinition::USER_TABLE_NAME_PREFIX;
        $strTableName = $strTableName . $strAreaCode . $strPostalCode;

        return ($strTableName);
    }

    // =====================================================
    // Name: generateUserTagId
    // Return: user account info table name
    //
    // Parameter: user mobile
    // Description: generate the user tag ID:
    // Algorithm: phone area code + first three digits of postal code
    // + unique ID + md5 hash last four digits of the ID
    // =====================================================
    public function generateUserTagId($str_user_mobile)
    {
        $strUserTag = "NEOUD"; //

        $strTemp = trim($str_user_mobile);
        $strTemp = substr($strTemp, 0, 3); // get area code from the phone number
        $strTemp = base_convert($strTemp, 10, 36); // conver the area code from decimal to 36-cimal

        $strUserTag = $strUserTag . $strTemp;

        $strTemp = uniqid();
        $strTemp = substr($strTemp, 6); // Only use LSB 7 digits
                                        // Convert to 36-cimal string
        $strTemp = base_convert($strTemp, 16, 36);

        $strUserTag = $strUserTag . $strTemp;

        $strTemp = md5($strUserTag);
        // get the last four digits of MD5
        $strTemp = substr($strTemp, - 4);
        $strUserTag = $strUserTag . $strTemp;

        return ($strUserTag);
    }

    // =====================================================
    // Name: generateBnAccountInfoTableName
    // Return: business account info table name
    //
    // Parameter: business phone
    // Description: generate the business account info table name
    // =====================================================
    public function generateBnAccountInfoTableName($strPhone)
    {
        $strAreaCode = trim($strPhone);
        $strAreaCode = substr($strAreaCode, 0, 3); // get area code from the phone number

        $strTableName = AllTableInfoDefinition::BN_TABLE_NAME_PREFIX;
        $strTableName = $strTableName . $strAreaCode . $strPostalCode;

        return ($strTableName);
    }

    // =====================================================
    // Name: genPotentialBnAcntTblName
    // Return: Potential business account info table name
    //
    // Parameter: None
    // Description: generate the business account info table name
    // =====================================================
    public function genDashboard1AcntTblName()
    {
        return (AllTableInfoDefinition::BN_TABLE_NAME_DASHBOARD_1);
    }

    // =====================================================
    // Name: getDashboard1StatusMsgTblName
    // Return: Potential business account status message table name
    //
    // Parameter: None
    // Description: generate the business account info table name
    // =====================================================
    public function getDashboard1StatusMsgTblName()
    {
        return (AllTableInfoDefinition::BN_TBL_NAME_DB_1_STATUS_MSG);
    }

    // =====================================================
    // Name: getDb1ContactMsgTblName
    // Return: Temp business account contact message table name
    //
    // Parameter: None
    // Description: generate the business account contact message table name
    // =====================================================
    public function getDb1ContactMsgTblName()
    {
        return (AllTableInfoDefinition::BN_TBL_NAME_DB_1_MSG);
    }

    // =====================================================
    // Name: getMerchantAccountInfoTblName
    // Return: merchant account info table name
    //
    // Parameter: telphone area code
    // Description: get merchant account table name
    // =====================================================
    public function getMerchantAccountInfoTblName($telAreaCode)
    {
        $tblName = $telAreaCode . AllTableInfoDefinition::BN_TABLE_NAME_DASHBOARD_2_POSTFIX;

        return ($tblName);
    }

    // =====================================================
    // Name: getNeoProductInfoTblName
    // Return: Neo product info table name
    //
    // Parameter: None
    // Description: get neo product info table name
    // =====================================================
    public function getNeoProductInfoTblName()
    {
        return (AllTableInfoDefinition::NEO_TBL_NAME_PRODUCT_INFO);
    }

    // =====================================================
    // Name: getNeoDb1OrderTblName
    // Return: Neo Dashboard 1 order table name
    //
    // Parameter: None
    // Description: get neo dashboard 1 order info table name
    // =====================================================
    public function getNeoDb1OrderTblName()
    {
        return (AllTableInfoDefinition::NEO_TBL_NAME_DB1_ORDER_INFO);
    }

    // =====================================================
    // Name: getNeoBusinessEnquiryTblName
    // Return: Neo business enquiry service table name
    //
    // Parameter: None
    // Description: get neo business enquiry service table name
    // =====================================================
    public function getNeoBusinessEnquiryTblName()
    {
        return (AllTableInfoDefinition::NEO_TBL_NAME_BUSINESS_MORE_INFO_INFO);
    }

    // =====================================================
    // Name: getNeoInTouchTblName
    // Return: Neo get in touch table name
    //
    // Parameter: None
    // Description: get neo in touch table name
    // =====================================================
    public function getNeoInTouchTblName()
    {
        return (AllTableInfoDefinition::NEO_TBL_NAME_GEN_CONTACT_INFO);
    }

    // =====================================================
    // Name: getTagInfoTblName
    // Return: Neo get tag info according to the tag ID table name
    //
    // Parameter: None
    // Description: Neo get ifo according to the tag ID table name
    // =====================================================
    public function getTagInfoTblName()
    {
        return (AllTableInfoDefinition::NEO_TBL_NAME_TAG_INFO);
    }

    // =====================================================
    // Name: getTagScanEventTblName
    // Return: Neo get tag scan event table name
    //
    // Parameter: $bid -- business ID
    // Description: Neo get tag scan event table name
    // =====================================================
    public function getTagScanEventTblName($bid)
    {
        $tblName = AllTableInfoDefinition::NEO_TBL_NAME_PREFIX_TAG_SCAN_EVENT;
        $tblName = $tblName . $bid . "_tbl";

        return ($tblName);
    }

    // =====================================================
    // Name: getTagScanEventTblName
    // Return: Neo get tag scan event table name
    //
    // Parameter: $bid -- business ID
    // Description: Neo get tag scan event table name
    // =====================================================
    public function getTagScanErrorEventTblName()
    {
        $tblName = AllTableInfoDefinition::NEO_TBL_NAME_TAG_SCAN_ERROR_EVENT;

        return ($tblName);
    }

    // =====================================================
    // Name: getTagScanEventTblName
    // Return: Neo get tag scan event table name
    //
    // Parameter: $bid -- business ID
    // Description: Neo get tag scan event table name
    // =====================================================
    public function getTagUserRegistTblName($bid)
    {
        $tblName = AllTableInfoDefinition::NEO_TBL_NAME_PREFIX_TAG_USER_REGIST;
        $tblName = $tblName . $bid . "_tbl";

        return ($tblName);
    }

    // =====================================================
    // Name: generateTagIndex
    // Return: tag index
    //
    // Parameter: None
    // Description:generate tag index -- 6 characters
    // =====================================================
    public function generateTagIndex()
    {
        $strTemp = uniqid();
        $strTemp = substr($strTemp, 7); // Only use LSB 6 digits

        return ($strTemp);
    }

    // =====================================================
    // Name: generateTagNumber
    // Return: tag number
    //
    // Parameter: None
    // Description:generate tag number -- 8 characters
    // =====================================================
    public function generateTagNumber()
    {
        $strTemp = uniqid(TRUE);
        $strTemp = substr($strTemp, 2, 8); // Only use 8 digits

        return ($strTemp);
    }

    // =====================================================
    // Name: generateTagId
    // Return: tag id
    //
    // Parameter: tag set includes tag index and type
    // Description:generate tag ID
    // Tag ID is composed:
    // First: 6 characters of tag index
    // Second: 1 characters of tag type (1 -- 9)
    // Third: validation code with 3 characters

    // =====================================================
    public function generateTagId($tagSet)
    {
        $indexTemp = $tagSet->getTagIndex();
        $typeTemp = $tagSet->getTagType();

        $tagIdTemp = $indexTemp . $typeTemp;

        $strTemp = md5($indexTemp);
        $strTemp = $strTemp . "Neo";
        $strTemp = md5($strTemp);
        $strTemp = substr($strTemp, 2, 3); // three characters from third one to fifth

        $tagIdTemp = $tagIdTemp . $strTemp;

        return ($tagIdTemp);
    }

    // =====================================================
    // Name: decodeTagId
    // Return: tag index and type in tag set
    //
    // Parameter: tag set includes tag ID
    // Description:decode tag ID
    // Tag ID is composed:
    // First: 6 characters of tag index
    // Second: 1 characters of tag type (1 -- 9)
    // Third: validation code with 3 characters
    // Return tag index and type if valid tag ID received.
    // For an invalid tag ID, index and type shall be null
    // =====================================================
    public function decodeTagId($tagSet)
    {
        $setTemp = new TagInfoSet($tagSet->getTagId());

        // Preset to false state
        $setTemp->setStatus(false);
        $tagIdTemp = $tagSet->getTagId();

        // Validate the tag ID length
        if (strlen($tagIdTemp) != CommonDefinition::TAG_STR_LENGTH) {
            return ($setTemp);
        }

        $indexTemp = substr($tagIdTemp, 0, 6);
        $typeTemp = substr($tagIdTemp, 6, 1);
        $typeTemp = (int) $typeTemp; // convert to INT

        // validate the tag type
        if (($typeTemp != CommonDefinition::TAG_TYPE_QR_CODE) && ($typeTemp != CommonDefinition::TAG_TYPE_NFC) && ($typeTemp != CommonDefinition::TAG_TYPE_SMS)) {
            return ($setTemp);
        }

        // validate the tag
        $tagValidation = substr($tagIdTemp, 7); // Tag validition part

        $strTemp = md5($indexTemp);
        $strTemp = $strTemp . "Neo";
        $strTemp = md5($strTemp);

        $strTemp = substr($strTemp, 2, 3); // three characters from third one to fifth

        // Code validation failed
        if (CommonDefinition::SUCCESS != strcasecmp($strTemp, $tagValidation)) {
            return ($setTemp);
        }

        // pass the tag index and type
        $setTemp->setTagIndex($indexTemp);
        $setTemp->setTagType($typeTemp);
        $setTemp->setStatus(true);

        return ($setTemp);
    }

    // =====================================================
    // Name: getAdminAccountTblName
    // Return: Neo get administrator account table name
    //
    // Parameter: none
    // Description: Neo get administrator account table name
    // =====================================================
    public function getAdminAccountTblName()
    {
        $tblName = AllTableInfoDefinition::ADMIN_TBL_NAME_ADMIN_ACCOUNT;
        return ($tblName);
    }

    // =====================================================
    // Name: generateBnId
    // Return: Generate business name ID
    //
    // Parameter: phone
    // Description: generate the business ID:
    // Algorithm: phone area code + unique ID
    //
    // =====================================================
    public function generateBnId($strPhone)
    {
        $strBusinessId = "MD"; //

        $strTemp = trim($strPhone);
        $strTemp = substr($strPhone, 0, 3); // get area code from the phone number
        $strTemp = base_convert($strTemp, 10, 36); // conver the area code from decimal to 36-cimal

        $strBusinessId = $strBusinessId . $strTemp;

        $strTemp = uniqid();
        $strTemp = substr($strTemp, 6); // Only use LSB 7 digits
                                        // Convert to 36-cimal string
        $strTemp = base_convert($strTemp, 16, 36);

        $strBusinessId = $strBusinessId . $strTemp;
        // Count the MD5 of the business ID string
        $strTemp = md5($strBusinessId);
        // get the last four digits of MD5
        $strTemp = substr($strTemp, - 4);

        $strBusinessId = $strBusinessId . $strTemp;

        return ($strBusinessId);
    }

    // =====================================================
    // Name: generateBnTempId
    // Return: Generate business account temp ID
    //
    // Parameter: phone
    // Description: generate the business ID:
    // Algorithm: phone area code + unique ID
    //
    // =====================================================
    public function generateBnTempId($strPhone)
    {
        $strBusinessId = "BT"; //

        $strTemp = trim($strPhone);
        $strTemp = substr($strPhone, 0, 3); // get area code from the phone number
        $strTemp = base_convert($strTemp, 10, 36); // conver the area code from decimal to 36-cimal

        $strBusinessId = $strBusinessId . $strTemp;

        $strTemp = uniqid();
        $strTemp = substr($strTemp, 6); // Only use LSB 7 digits
                                        // Convert to 36-cimal string
        $strTemp = base_convert($strTemp, 16, 36);

        $strBusinessId = $strBusinessId . $strTemp;

        // Count the MD5 of the business ID string
        $strTemp = md5($strBusinessId);
        // get the last four digits of MD5
        $strTemp = substr($strTemp, - 4);
        $strBusinessId = $strBusinessId . $strTemp;

        return ($strBusinessId);
    }

    // =====================================================
    // Name: generateDb1OrderId
    // Return: Generate Dash board 1 order ID
    //
    // Parameter:
    // Description: generate the Dash board 1 order ID
    // Algorithm: phone area code + unique ID
    //
    // =====================================================
    public function generateDb1OrderId($bid)
    {
        // get the unique value
        $strTemp = md5(uniqid(md5(microtime(true)), true));
        $strTemp = $bid . $strTemp;
        $strTemp = md5($strTemp);
        // Convert to base 36 data
        $strTemp = base_convert($strTemp, 16, 36);

        return ($strTemp);
    }

    // =====================================================
    // Name : convertToStepStatus
    // Input : $stpe -- number
    // $status -- status in eneral
    // Output: detail step status
    //
    // Description: Convert the general status to detail step status enable/disable
    // =====================================================
    public function convertToStepStatus($step, $status)
    {
        $result = false;

        switch ($step) {
            case (BusinessDefinition::BN_REG_STEP_1):
                {
                    if ($status >= BusinessDefinition::BN_REG_STEP_1_READY) {
                        $result = true;
                    }
                    break;
                }
            case (BusinessDefinition::BN_REG_STEP_2):
                {
                    if ($status >= BusinessDefinition::BN_REG_STEP_2_READY) {
                        $result = true;
                    }
                    break;
                }
            case (BusinessDefinition::BN_REG_STEP_3):
                {
                    if ($status >= BusinessDefinition::BN_REG_STEP_3_READY) {
                        $result = true;
                    }
                    break;
                }
            case (BusinessDefinition::BN_REG_STEP_4):
                {
                    if ($status >= BusinessDefinition::BN_REG_STEP_4_READY) {
                        $result = true;
                    }
                    break;
                }
            case (BusinessDefinition::BN_REG_STEP_5):
                {
                    if ($status >= BusinessDefinition::BN_REG_STEP_5_READY) {
                        $result = true;
                    }
                    break;
                }
            case (BusinessDefinition::BN_REG_STEP_6):
                {
                    if ($status >= BusinessDefinition::BN_REG_STEP_6_READY) {
                        $result = true;
                    }
                    break;
                }
            default:
                break;
        }

        return ($result);
    }

    // =====================================================
    // Name : checkStringlength
    // Input : $strMsg -- string needs to be check
    // $maxLimit -- maximum limit to be checked
    // Output: true -- string length less or equal to the limit
    // false -- string length greater the limit
    //
    // Description: Check the string length limit
    // =====================================================
    public function checkStringlength($strMsg, $maxLimit)
    {
        if (strlen($strMsg) <= $maxLimit) {
            return true;
        } else {
            return false;
        }
    }

    // =====================================================
    // Name : getProvinceName
    // Input : $provinceIndex -- Province Index
    //
    // Output: province name
    //
    // Description: get province name by index
    // =====================================================
    public function getProvinceName($provinceIndex)
    {
        return (CommonDefinition::PROVINCE_NAME[$provinceIndex]);
    }

    // =====================================================
    // Name : getProvinceIndex
    // Input : $provinceName -- Province name
    //
    // Output: province index
    // ERROR -- if province name does not match in array
    //
    //
    // Description: get province index according to name
    // =====================================================
    public function getProvinceIndex($provinceName)
    {
        for ($index = 0; $index < sizeof(CommonDefinition::PROVINCE_NAME); $index ++) {
            if (CommonDefinition::SUCCESS == strcmp($provinceName, CommonDefinition::PROVINCE_NAME[$index])) {
                return ($index);
            }
        }

        return (CommonDefinition::ERROR);
    }

    // =====================================================
    // Name : getCountryName
    // Input : $countryIndex -- Country Index
    //
    // Output: Country name
    //
    // Description: get Country name by index
    // =====================================================
    public function getCountryName($countryIndex)
    {
        return (CommonDefinition::COUNTRY_NAME[$countryIndex]);
    }

    // =====================================================
    // Name : getCountryIndex
    // Input : $countryName -- Country name
    //
    // Output: Country index
    // ERROR -- if Country name does not match in array
    //
    //
    // Description: get country index according to name
    // =====================================================
    public function getCountryIndex($countryName)
    {
        for ($index = 0; $index < sizeof(CommonDefinition::COUNTRY_NAME); $index ++) {
            if (CommonDefinition::SUCCESS == strcmp($countryName, CommonDefinition::COUNTRY_NAME[$index])) {
                return ($index);
            }
        }

        return (CommonDefinition::ERROR);
    }

    // =====================================================
    // Name : getBusinessType
    // Input : $typeIndex -- business type Index
    //
    // Output: business type name
    //
    // Description: get business type name by index
    // =====================================================
    public function getBusinessType($typeIndex)
    {
        return (CommonDefinition::BUSINESS_TYPE[$typeIndex]);
    }

    // =====================================================
    // Name : getBusinessTypeIndex
    // Input : $businessType -- business type name
    //
    // Output: business type index
    // ERROR -- if business type name does not match in array
    //
    //
    // Description: get business type index according to name
    // =====================================================
    public function getBusinessTypeIndex($businessType)
    {
        for ($index = 0; $index < count(CommonDefinition::BUSINESS_TYPE); $index ++) {
            if (CommonDefinition::SUCCESS == strcmp($businessType, CommonDefinition::BUSINESS_TYPE[$index])) {
                return ($index);
            }
        }

        return (CommonDefinition::ERROR);
    }

    // =====================================================
    // Name : getBusinessStatusType
    // Input : $typeIndex -- business status Index
    //
    // Output: business status name
    //
    // Description: get business status name by index
    // =====================================================
    public function getBusinessStatusType($statusIndex)
    {
        return (CommonDefinition::BUSINESS_STATUS_DEF[$statusIndex - 1]);
    }

    // =====================================================
    // Name : getBusinessStatusIndex
    // Input : $businessStatusName-- business status name
    //
    // Output: business status index
    // ERROR -- if business status name does not match in array
    //
    //
    // Description: get business status index according to name
    // =====================================================
    public function getBusinessStatusIndex($businessStatusName)
    {
        for ($index = 0; $index < count(CommonDefinition::BUSINESS_STATUS_DEF); $index ++) {
            if (CommonDefinition::SUCCESS == strcmp($businessStatusName, CommonDefinition::BUSINESS_STATUS_DEF[$index])) {
                return ($index);
            }
        }

        return (CommonDefinition::ERROR);
    }

    // =====================================================
    // Name : getPaymentMethodByIndex
    // Input : $businessType -- business type name
    //
    // Output: business type index
    // ERROR -- if business type name does not match in array
    //
    //
    // Description: get business type index according to name
    // =====================================================
    public function getPaymentMethodByIndex($index)
    {
        $retVal = CommonDefinition::PAY_METHOD_EMAIL_MSG;

        switch ($index) {
            case (CommonDefinition::PAY_METHOD_EMAIL):
                {
                    $retVal = CommonDefinition::PAY_METHOD_EMAIL_MSG;
                    break;
                }
            case (CommonDefinition::PAY_METHOD_PAYPAL):
                {
                    $retVal = CommonDefinition::PAY_METHOD_PAYPAL_MSG;
                    break;
                }
            case (CommonDefinition::PAY_METHOD_CREDIT_CARD):
                {
                    $retVal = CommonDefinition::PAY_METHOD_CREDIT_CARD_MSG;
                    break;
                }
            default:
                break;
        }

        return ($retVal);
    }

    // =====================================================
    // Name : getTagStatusIndex
    // Input : $tagStatus-- tag status name
    //
    // Output: tag status index
    //
    //
    //
    // Description: get tag status index according to name
    // =====================================================
    public function getTagStatusIndex($tagStatus)
    {
        for ($count = 0; $count < count(CommonDefinition::TAG_STATUS_DEF); $count ++) {
            if (CommonDefinition::SUCCESS == strcasecmp(CommonDefinition::TAG_STATUS_DEF[$count], $tagStatus)) {
                return ($count + 1);
            }
        }

        // Force to Initial state
        return (1);
    }

    // =====================================================
    // Name : getTagTypeIndex
    // Input : $tagType-- tag type name
    //
    // Output: tag type index
    //
    //
    //
    // Description: get tag type index according to name
    // =====================================================
    public function getTagTypeIndex($tagType)
    {
        for ($count = 0; $count < count(CommonDefinition::TAG_TYPE_DEF); $count ++) {
            if (CommonDefinition::SUCCESS == strcasecmp(CommonDefinition::TAG_TYPE_DEF[$count], $tagType)) {
                return ($count + 1);
            }
        }

        // Force to QR CODE
        return (1);
    }

    // =====================================================
    // Name : validateBusinessInfoSet
    // Input : $businessSet--business info set
    //
    // Output: validate result
    //
    // Description: validate business info set
    // =====================================================
    public function validateBusinessInfoSet($businessSet)
    {
        $result = array();
        $result["status"] = CommonDefinition::SUCCESS;

        // Validate all fields possible

        if (! $this->checkFormField($businessSet->getFirstName(), CommonDefinition::REG_NAME_ID)) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error, First Name field is wrong!";
        } else if (! $this->checkFormField($businessSet->getLastName(), CommonDefinition::REG_NAME_ID)) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error, Last Name field is wrong!";
        } else if (! $this->checkFormField($businessSet->getBusinessName(), CommonDefinition::REG_NAME_ID)) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error, Business Name field is wrong!";
        } else if (! $this->checkFormField($businessSet->getEmail(), CommonDefinition::REG_EMAIL_ID)) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error, Invalid email!";
        } else if (! $this->checkFormField($businessSet->getPhone(), CommonDefinition::REG_MOBILE_ID)) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error, Invalid phone number!";
        } else if (! $this->checkFormField($businessSet->getMobile(), CommonDefinition::REG_MOBILE_ID)) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error, Invalid Mobile number!";
        } else if (! empty($businessSet->getPostalCode())) {
            if (! $this->checkFormField($businessSet->getPostalCode(), CommonDefinition::REG_POSTAL_CODE_ID)) {
                $result["status"] = CommonDefinition::ERROR;
                $result["info"] = "Error, Invalid postal code!";
            }
        } else if (! empty($businessSet->getFaceBookId())) {
            if (strlen($businessSet->getFaceBookId()) > AllTableInfoDefinition::FACE_BOOK_ID_LENGTH) {
                $result["status"] = CommonDefinition::ERROR;
                $result["info"] = "Error, Face book id field length beyond " . AllTableInfoDefinition::FACE_BOOK_ID_LENGTH . " characteres!";
            }
        } else if (! empty($businessSet->getTwitterId())) {
            if (strlen($businessSet->getTwitterId()) > AllTableInfoDefinition::TWITTER_ID_LENGTH) {
                $result["status"] = CommonDefinition::ERROR;
                $result["info"] = "Error, Twitter id field length beyond " . AllTableInfoDefinition::TWITTER_ID_LENGTH . " characteres!";
            }
        } else if (! empty($businessSet->getRewardMsg())) {
            if (strlen($businessSet->getRewardMsg()) > AllTableInfoDefinition::REWARD_MSG_LENGTH) {
                $result["status"] = CommonDefinition::ERROR;
                $result["info"] = "Error, Reward message field length beyond " . AllTableInfoDefinition::REWARD_MSG_LENGTH . " characteres!";
            }
        } else if (! empty($businessSet->getSuccessMsg())) {
            if (strlen($businessSet->getSuccessMsg()) > AllTableInfoDefinition::SUCCESS_MSG_LENGTH) {
                $result["status"] = CommonDefinition::ERROR;
                $result["info"] = "Error, Success message field length beyond " . AllTableInfoDefinition::SUCCESS_MSG_LENGTH . " characteres!";
            }
        } else if (! empty($businessSet->getNote())) {
            if (strlen($businessSet->getNote()) > AllTableInfoDefinition::NOTE_LENGTH) {
                $result["status"] = CommonDefinition::ERROR;
                $result["info"] = "Error, Note message field length beyond " . AllTableInfoDefinition::NOTE_LENGTH . " characteres!";
            }
        } else if (! empty($businessSet->getWebPage())) {
            if (strlen($businessSet->getWebPage()) > AllTableInfoDefinition::WEB_PAGE_LENGTH) {
                $result["status"] = CommonDefinition::ERROR;
                $result["info"] = "Error, Web page message field length beyond " . AllTableInfoDefinition::WEB_PAGE_LENGTH . " characteres!";
            }
        } else if (! empty($businessSet->getAddress())) {
            if (strlen($businessSet->getAddress()) > AllTableInfoDefinition::ADDRESS_LENGTH) {
                $result["status"] = CommonDefinition::ERROR;
                $result["info"] = "Error, Address field length beyond " . AllTableInfoDefinition::ADDRESS_LENGTH . " characteres!";
            }
        } else if (! empty($businessSet->getCity())) {
            if (strlen($businessSet->getCity()) > AllTableInfoDefinition::CITY_LENGTH) {
                $result["status"] = CommonDefinition::ERROR;
                $result["info"] = "Error, City field length beyond " . AllTableInfoDefinition::CITY_LENGTH . " characteres!";
            }
        } else if (strlen($businessSet->getFirstName()) > AllTableInfoDefinition::FIRST_NAME_LENGTH) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error, First Name field length beyond " . AllTableInfoDefinition::FIRST_NAME_LENGTH . " characteres!";
        } else if (strlen($businessSet->getLastName()) > AllTableInfoDefinition::LAST_NAME_LENGTH) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error, Last Name field length beyond " . AllTableInfoDefinition::LAST_NAME_LENGTH . " characteres!";
        } else if (strlen($businessSet->getBusinessName()) > AllTableInfoDefinition::PASS_WORD_LENGTH) {
            $result["status"] = CommonDefinition::ERROR;
            $result["info"] = "Error, Business Name field length beyond " . AllTableInfoDefinition::BUSINESS_NAME_LENGTH . " characteres!";
        }

        return ($result);
    }

    // =====================================================
    // Name : validateBusinessInfoSet
    // Input : $bnSet1 -- business info set
    // $bnSet2 -- business info set
    //
    // Output: SUCCESS -- two business info sets are the same
    // ERROR -- not the same
    // Description: validate business info set
    // =====================================================
    public function compareBusinessInfoSet($bnSet1, $bnSet2)
    {
        $retVal = CommonDefinition::ERROR;

        if (CommonDefinition::SUCCESS != strcmp($bnSet1->getBusinessId(), $bnSet2->getBusinessId())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getFirstName(), $bnSet2->getFirstName())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getLastName(), $bnSet2->getLastName())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getBusinessName(), $bnSet2->getBusinessName())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getBusinessStatus(), $bnSet2->getBusinessStatus())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getWebPage(), $bnSet2->getWebPage())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getEmail(), $bnSet2->getEmail())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getPhone(), $bnSet2->getPhone())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getMobile(), $bnSet2->getMobile())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getAddress(), $bnSet2->getAddress())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getCity(), $bnSet2->getCity())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getProvince(), $bnSet2->getProvince())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getCountry(), $bnSet2->getCountry())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getPostalCode(), $bnSet2->getPostalCode())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getFaceBookId(), $bnSet2->getFaceBookId())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getTwitterId(), $bnSet2->getTwitterId())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getRewardMsg(), $bnSet2->getRewardMsg())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getSuccessMsg(), $bnSet2->getSuccessMsg())) {
            return ($retVal);
        } else if (CommonDefinition::SUCCESS != strcmp($bnSet1->getNote(), $bnSet2->getNote())) {
            return ($retVal);
        } else {
            return (CommonDefinition::SUCCESS);
        }
    }
}
?>
