<?php

// +----------------------------------------------------------------------
// | This class defines all data base table related information:
// | Includes table used and table's column field name
// +----------------------------------------------------------------------
// | Copyright (c) 2016 http://www.neoreward.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: xyz
// +----------------------------------------------------------------------
namespace NeoWeb\Common\Common;

class AllTableInfoDefinition
{

    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------
    // Part 1 is for Neo company level data base table name and column field name
    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------
    // hold Neo product info table name
    const NEO_TBL_NAME_PRODUCT_INFO = 'neo_product_info_tbl';

    const NEO_TBL_NAME_DB1_ORDER_INFO = 'neo_db_1_order_tbl';

    const NEO_TBL_NAME_BUSINESS_MORE_INFO_INFO = 'neo_bn_serv_enquiry_tbl';

    // General business enquiry service more info
    // table
    const NEO_TBL_NAME_GEN_CONTACT_INFO = 'neo_general_in_touch_tbl';

    // General get in touch table
    const NEO_TBL_NAME_TAG_INFO = 'neo_tag_info_tbl';

    // Tag to the specified webpage and business ID table
    const NEO_TBL_NAME_PREFIX_TAG_SCAN_EVENT = 'bn_tag_scan_evt_';

    // Tag scan log event table name prfix
    const NEO_TBL_NAME_TAG_SCAN_ERROR_EVENT = 'neo_tag_scan_error_log_tbl';

    // Tag scan error code log event table name
    const NEO_TBL_NAME_PREFIX_TAG_USER_REGIST = 'bn_tag_user_regist_';

    // Tag user regist table name prfix

    // NEO_DB1_ORDER_INFO databse field name definition
    const NEO_DB_FIELD_ORDER_ID = "order_id";

    const NEO_DB_FIELD_MONTH_TERM = "month_term";

    const NEO_DB_FIELD_STORE_QTY = "store_quantity";

    const NEO_DB_FIELD_TOTAL_AMOUNT = "total_amount";

    const NEO_DB_FIELD_TAX_RATE = "tax_rate";

    const NEO_DB_FIELD_AMOUNT_PAID = "amount_paid";

    const NEO_DB_FIELD_PAYMENT_METHOD = "payment_method";

    const NEO_DB_FIELD_PAYMENT_INFO = "payment_info";

    const NEO_DB_FIELD_ORDER_STATUS = "order_status";

    const NEO_DB_FIELD_ORDER_NOTE = "order_note";

    // NEO_PRODUCT_INFO databse field name definition
    const DB_FIELD_PRODUCT_NAME = "product_name";

    const DB_FIELD_SET_UP_FEE = "set_up_fee";

    const DB_FIELD_MONTHLY_FEE = "monthly_fee";

    const DB_FIELD_PRODUCT_DETAIL = "product_detail";

    // TAG related info

    // TAG ID
    const DB_FIELD_TAG_ID = "tag_id";

    // TAG index
    const DB_FIELD_TAG_INDEX = "tag_index";

    // TAG type: 1--> QR Code; 2--> NFC; 3--> SMS;
    const DB_FIELD_TAG_TYPE = "tag_type";

    // Tag number
    const DB_FIELD_TAG_NUMBER = "tag_number";

    // Tag label
    const DB_FIELD_TAG_LABEL = "tag_label";

    // Tag web page
    const DB_FIELD_TAG_WEB_PAGE = "tag_web_page";

    // web page
    const DB_FIELD_WEB_PAGE = "web_page";

    // Tag reward message
    const DB_FIELD_TAG_REWARD_MSG = "tag_reward_msg";

    // Tag user registration success message
    const DB_FIELD_TAG_REGIST_SUCCESS_MSG = "tag_success_msg";

    // note
    const DB_FIELD_NOTE = "note";

    // date/time related field
    const DB_FIELD_TIME = "date";

    const DB_FIELD_FIRST_NAME = "first_name";

    const DB_FIELD_LAST_NAME = "last_name";

    const DB_FIELD_BUSINESS_NAME = "bn_name";

    const DB_FIELD_BUSINESS_ID = "bn_id";

    const DB_FIELD_ADMIN_ID = "admin_id";

    const DB_FIELD_EMAIL = "email";

    const DB_FIELD_PHONE = "phone";

    const DB_FIELD_MOBILE = "mobile";

    const DB_FIELD_STATUS = "status";

    const DB_FIELD_LEVEL = "level";

    const DB_FIELD_PASSWORD = "password";

    const DB_FIELD_ADDRESS = "address";

    const DB_FIELD_ADDRESS_2 = "address_2";

    const DB_FIELD_CITY = "city";

    const DB_FIELD_PROVINCE = "province";

    const DB_FIELD_COUNTRY = "country";

    const DB_FIELD_POSTAL_CODE = "postal_code";

    const DB_FIELD_DEVICE_TYPE = "device_type";

    const DB_FIELD_FACE_BOOK_ID = "facebook_id";

    const DB_FIELD_TWITTER_ID = "twitter_id";

    // Device type such as mobile or PC, etc
    const DB_FIELD_BROWSER_TYPE = "browser_type";

    // Browser type, such as Chrome, firefox, etc
    const FIRST_NAME_LENGTH = 50;

    const LAST_NAME_LENGTH = 50;

    const BUSINESS_NAME_LENGTH = 100;

    const PASS_WORD_LENGTH = 32;

    const FACE_BOOK_ID_LENGTH = 150;

    const TWITTER_ID_LENGTH = 150;

    const REWARD_MSG_LENGTH = 1000;

    const SUCCESS_MSG_LENGTH = 1000;

    const NOTE_LENGTH = 2000;

    const WEB_PAGE_LENGTH = 100;

    const ADDRESS_LENGTH = 100;

    const CITY_LENGTH = 50;

    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------
    // End of part 1 Neo company level definition
    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------

    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------
    // Part 2 is for Neo Business client level data base table name and
    // column field name
    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------
    const BN_TABLE_NAME_PREFIX = 'bn_ac_tbl_';

    // This table holds potential merchant's account
    const BN_TABLE_NAME_DASHBOARD_1 = 'bn_db_1_acnt_tbl';

    const BN_TABLE_NAME_DASHBOARD_2_POSTFIX = 'bn_db_2_acnt_tbl';

    // hold business temp account contact message table name
    const BN_TBL_NAME_DB_1_MSG = 'bn_db_1_msg_tbl';

    // hold business temp account status message table name
    const BN_TBL_NAME_DB_1_STATUS_MSG = 'bn_db_1_sts_msg_tbl';

    // ========================================================================
    // // NEO_BUSINESS_INFO field name definition
    const BN_DB_FIELD_UID = "id";

    const BN_DB_FIELD_FULL_NAME = "full_name";

    const BN_DB_FIELD_BN_NAME = "bn_name";

    const BN_DB_FIELD_EMAIL = "bn_email";

    const BN_DB_FIELD_EMAIL_ALT = "bn_email_alt";

    const BN_DB_FIELD_PHONE = "bn_phone";

    const BN_DB_FIELD_MOBILE = "bn_mobile";

    const BN_DB_FIELD_PW = "bn_password";

    const BN_DB_FIELD_ID = "bn_id";

    const BN_DB_FIELD_REG_DATE = "bn_reg_date";

    const BN_DB_FIELD_STATUS = "bn_status";

    const BN_DB_FIELD_TYPE = "bn_type";

    const BN_DB_FIELD_MSG = "bn_msg";

    const BN_DB_FIELD_MSG_SUBJECT = "bn_msg_subject";

    const BN_DB_FIELD_MSG_FLAG = "bn_msg_flag";

    const BN_DB_FIELD_ADDRESS = "bn_address";

    const BN_DB_FIELD_CITY = "bn_city";

    const BN_DB_FIELD_PROVINCE = "bn_province";

    const BN_DB_FIELD_COUNTRY = "bn_country";

    const BN_DB_FIELD_POSTAL_CODE = "bn_postal_code";

    const BN_DB_FIELD_DATE = "date";

    // DB1 status message table field definition
    const BN_DB_FIELD_STEP_1_YES = "step_1_yes";

    const BN_DB_FIELD_STEP_2_YES = "step_2_yes";

    const BN_DB_FIELD_STEP_3_YES = "step_3_yes";

    const BN_DB_FIELD_STEP_4_YES = "step_4_yes";

    const BN_DB_FIELD_STEP_5_YES = "step_5_yes";

    const BN_DB_FIELD_STEP_6_YES = "step_6_yes";

    const BN_DB_FIELD_STEP_1_NO = "step_1_no";

    const BN_DB_FIELD_STEP_2_NO = "step_2_no";

    const BN_DB_FIELD_STEP_3_NO = "step_3_no";

    const BN_DB_FIELD_STEP_4_NO = "step_4_no";

    const BN_DB_FIELD_STEP_5_NO = "step_5_no";

    const BN_DB_FIELD_STEP_6_NO = "step_6_no";

    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------
    // End of part 2 Neo Business client level definition
    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------

    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------
    // Part 3 is for Neo end user level data base table name and column field name
    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------
    const USER_TABLE_NAME_PREFIX = "user_info_tbl_";

    // NEO_USER_INFO field name definition
    const USER_DB_FIELD_NAME = "user_name";

    const USER_DB_FIELD_MOBILE = "user_mobile";

    const USER_DB_FIELD_EMAIL = "user_email";

    const USER_DB_FIELD_PASSWORD = "user_password";

    const USER_DB_FIELD_POSTAL_CODE = "user_postal_code";

    const USER_DB_FIELD_TAG = "user_tag_id";

    const USER_DB_FIELD_REG_DATE = "user_reg_date";

    const USER_DB_FIELD_STATUS = "user_status";

    const USER_DB_FIELD_ADDRESS_1 = "user_address_1";

    const USER_DB_FIELD_ADDRESS_2 = "user_address_2";

    const USER_DB_FIELD_CITY = "user_city";

    const USER_DB_FIELD_PROVINCE = "user_province";

    const USER_DB_FIELD_COUNTRY = "user_country";

    const USER_DB_FIELD_BIRTHDAY = "user_birthday";

    const USER_DB_FIELD_BIRTH_MONTH = "user_birth_month";

    const USER_DB_FIELD_STORE_NOTICE = "user_store_notice";

    const USER_DB_FIELD_NEO_NOTICE = "user_company_notice";

    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------
    // End of part 3 Neo end user level definition
    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------

    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------
    // Part 4 is for Neo administration related data base table name and column field name
    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------
    // Hold Neo administration related table name
    const ADMIN_TBL_NAME_ADMIN_ACCOUNT = 'admin_account_tbl';

    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------
    // End of part 4 Neo administration level definition
    // -----------------------------------------------------------------------
    // -----------------------------------------------------------------------
}

?>
