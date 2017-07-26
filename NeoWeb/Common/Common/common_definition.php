<?php
namespace NeoWeb\Common\Common;

class CommonDefinition
{

    // SUCCESS definition
    const SUCCESS = 0;

    const SUCCESS_CHECK_FIELD = 100;

    const SUCCESS_NO_RESULT = 110;

    // ERROR related definition
    const ERROR = - 1;

    const ERROR_CHECK_FIELD = 500;

    const ERROR_CONN = 501;

    const ERROR_INFO_UPDATE = 510;

    const ERROR_COMPARE_FIELD = 520;

    const ERROR_DUPLICATION_FIELD = 530;

    const ERROR_NO_RECORD = 533;

    // Data number definition
    const ZERO_NUM = 0;

    // String compare definition
    const SAME_RESULT = 0;

    const NO_RESULT = 0;

    const ONE_RESULT = 1;

    const FIRST_ORDER = 1;

    // Common data definition
    const STR_NULL_DATA = "NULL_DATA";

    const STR_TRUE = "true";

    const STR_FALSE = "false";

    // Array index for register data
    const REG_NAME_ID = 0;

    const REG_MOBILE_ID = 1;

    const REG_EMAIL_ID = 2;

    const REG_PASSWORD_ID = 3;

    const REG_POSTAL_CODE_ID = 4;

    const REG_TAG_ID = 5;

    const REG_DATE_ID = 6;

    const REG_STATUS_ID = 7;

    const REG_BIRTHDAY_ID_1 = 8;

    // only check day and month of(dd/mm)

    // Define the promotion notice preference method
    const USER_NOTICE_DISABLE = 1;

    // user notification is disable
    const USER_NOTICE_SMS_ONLY = 2;

    // user notification by SMS only
    const USER_NOTICE_EMAIL_ONLY = 3;

    // user notification by EMail only
    const USER_NOTICE_ALL = 4;

    // user notification by both sms and email

    // Define Contact message type information
    const MSG_FLAG_NEW = 1;

    const MSG_FLAG_PROCESSED = 20;

    // Define the tag string length
    const TAG_STR_LENGTH = 10;

    // Tag from QR code
    const TAG_TYPE_QR_CODE = 1;

    // Tag from NFC
    const TAG_TYPE_NFC = 2;

    // Tag from SMS
    const TAG_TYPE_SMS = 3;

    // Define Contact Message related
    const MAX_CONTACT_MSG_LENGTH = 300;

    // Maximum 300 characters
    const MAX_CONTACT_MSG_SUBJECT_LENGTH = 100;

    // Maximum 300 characters

    // Define Tax rate
    const TAX_RATE_CANADA = 1.13;

    // Tax rate Canada
    const TAX_RATE_INT = 1.00;

    // Tax rate outside of Canada

    // Payment method definition
    const PAY_METHOD_EMAIL = 1;

    // email transfer
    const PAY_METHOD_PAYPAL = 2;

    // Paypal
    const PAY_METHOD_CREDIT_CARD = 3;

    // credit card

    // Payment method detail definition
    const PAY_METHOD_EMAIL_MSG = "Email Transfer";

    // email transfer
    const PAY_METHOD_PAYPAL_MSG = "Paypal Method";

    // Paypal
    const PAY_METHOD_CREDIT_CARD_MSG = "Credit Card method";

    const TAG_TYPE_DEF = array(
        "QR Code",
        "NFC",
        "SMS"
    );

    const TAG_STATUS_DEF = array(
        "Initial",
        "Disable",
        "Enable"
    );

    // credit card

    // Province name and index array
    const PROVINCE_NAME = array(
        "ON -- Ontario",
        "QC -- Quebec",
        "BC -- British Columbia",
        "AB -- Alberta",
        "MB -- Manitoba",
        "SK -- Saskatchewan",
        "NB -- New Brunswick",
        "NL -- Newfoundland and Labrador",
        "NS -- Nova Scotia",
        "PE -- Prince Edward Island",
        "NT -- Northwest Territories",
        "NU -- Nunavut",
        "YT -- Yukon"
    );

    // Province index and phone area code match table
    const PROVINCE_INDEX_AREA_CODE = array(
        // Ontario
        "416", // Toronto and area
        "647", // Toronto and area
        "437", // Toronto and area
        "289", // Overlay of 905
        "365", // Overlay of 905
        "905", // GTA, Niagara
        "249", // Barrie, Collingwood, Lindsay, North Bay, Orillia, Peterborough, Sault Ste. Marie, Sudbury, Timmins
        "705", // Ontario Notrh/west
        "343", // Belleville, Brighton, Brockville, Cornwall, Kingston, Ottawa, Pembroke, Petawawa, Trenton, Whitney
        "613", // Oatawa
        "226", // Brantford, Cambridge, Chatham, Guelph, Kitchener, London, Sarnia, Windsor
        "519", // Ontario k-W area, London, south/west
        "548", // Ontario
        "807"
    );

    // Aroland, Atikokan, Dryden, Ft. Frances, Kenora, Marathon, Nipigon, Redditt, Thunder Bay, Vermillion Bay,
    // White River
    // Quebec
    // array(
    // 418,
    // 438,
    // 450,
    // 514,
    // 581,
    // 819,
    // 873),
    // British Columbia
    // array(
    // 604,
    // 250,
    // 778,
    // 236,
    // 672),
    // Alberta
    // array(
    // 780,
    // 403,
    // 587,
    // 825),
    // Manitoba
    // array(
    // 204,
    // 431),
    // Saskatchewan
    // array(
    // 303,
    // 639),
    // // New Brunswick
    // array(
    // 506),
    // Newfoundland and Labrador
    // array(
    // 709)

    // Special area code for
    // Nova Scotia,Prince Edward Island, Northwest Territories, Nunavut, Yukon
    const OVERLAY_AREA_CODE = array(
        782,
        902,
        867
    );

    // Country name and index array
    const COUNTRY_NAME = array(
        "CANADA",
        "UNITED STATES"
    );

    // Business type name and index array
    const BUSINESS_TYPE = array(
        "Restaurant",
        "Retail",
        "Spa"
    );

    const BUSINESS_STATUS_DEF = array(
        "Initial",
        "Disable",
        "Enable"
    );
}
?>

