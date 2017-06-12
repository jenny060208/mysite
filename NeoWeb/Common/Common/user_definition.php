<?php

namespace NeoWeb\Common\Common;

class UserDefinition {
	// User related definition
	const PKG_TYPE_REGISTER = "register";
	const PKG_TYPE_LOGIN = "login";
	const PKG_TYPE_RECOVER = "recover";
	
	// set json string field name
	const FIELD_TYPE = "pkgType";
	const FIELD_USER_NAME = "username";
	const FIELD_USER_MOBILE = "mobile";
	const FIELD_USER_EMAIL = "email";
	const FIELD_USER_PASSWORD = "password";
	const FIELD_USER_POSTAL_CODE = "postalCode";
	const FIELD_USER_TAG_ID = "tagId";
	const FIELD_USER_STATUS = "status";
	
	// Array index for login data
	const LOG_EMAIL_ID = 0;
	const LOG_PASSWORD_ID = 1;
	// User status definition
	const USER_STATUS_ACTIVE = 1; // user is active
	const USER_STATUS_SUSPEND = 2;
	const USER_STATUS_DISABLE = 3;
}

?>