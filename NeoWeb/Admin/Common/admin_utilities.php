<?php
namespace NeoWeb\Admin\Common;

use NeoWeb\Common\Common\AllTableInfoDefinition;
require_once ("admin_definition.php");

class AdminUtilities
{

    // =====================================================
    // Name: getRootAccountInfoTblName
    // Return: Root account info table name
    //
    // Parameter: None
    // Description: get root account table name
    // =====================================================
    public function getRootAccountInfoTblName()
    {
        return (AdminDefinition::NEO_TBL_ROOT_ACCOUNT_INFO);
    }

    // =====================================================
    // Name: getAdminAccountInfoTblName
    // Return: Admin account info table name
    //
    // Parameter: None
    // Description: get admin account table name
    // =====================================================
    public function getAdminAccountInfoTblName()
    {
        return (AdminDefinition::NEO_TBL_ADMIN_ACCOUNT_INFO);
    }

    // =====================================================
    // Name: generateAdminAccountPassword
    // Return: Admin account password
    //
    // Parameter: generate temp admin account:
    // compbine the first name, email and phone,
    // get four characters start from 2.
    // Description: get admin account table name
    // =====================================================
    public function generateAdminAccountPassword($fName, $email, $phone)
    {
        $strTemp = $fName . $email . $phone;

        $strTemp = md5($strTemp);
        $strTemp = substr($strTemp, 2, 4);
        return ($strTemp);
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
    // Name: getMerchantId
    // Return: get merchant ID
    //
    // Parameter: email, phone and business name
    // Description: get merchant account ID:
    // Note: merchant ID starts with MD, three characters of phone area code, 8 characters of identification
    // the identification is md5 hash 2 -- 9, the hash source is email + phone + merchant name + current time
    // =====================================================
    public function getMerchantId($email, $phone, $name)
    {
        $midStr = "MD";

        $telAreaCode = substr($phone, 0, 3);
        $midStr = $midStr . $telAreaCode;

        $tempStr = $email . $phone . $name;

        $currentTime = date("h:i:sa");
        $tempStr = $tempStr . $currentTime;
        $tempStr = md5($tempStr);
        $tempStr = substr($tempStr, 2, 8);

        $midStr = $midStr . $tempStr;

        return ($midStr);
    }

    // =====================================================
    // Name: generateMerchantAcntPassword
    // Return: Merchant account password
    //
    // Parameter: generate temp merchant account password:
    // compbine the merchant name, email and phone,
    // get four characters start from 2.
    // Description: get admin account table name
    // =====================================================
    public function generateMerchantAcntPassword($name, $email, $phone)
    {
        $strTemp = $name . $email . $phone;

        $strTemp = md5($strTemp);
        $strTemp = substr($strTemp, 2, 4);
        return ($strTemp);
    }
}
?>

