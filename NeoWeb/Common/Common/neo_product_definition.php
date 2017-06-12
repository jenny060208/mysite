<?php

namespace NeoWeb\Common\Common;

class NeoDefinition {
	const ET_ORDER_NOTE_1 = "Order Note 1";
	const ET_ORDER_PAYMENT_INFO_1 = "Order payment info 1";
	const ET_ORDER_ADD_SUCCESS = "Thanks! Your order commit is received. Please contact Neo once your Email transfer is made. ";
	const ET_ORDER_ADD_FAIL = "Sorry! Your order commit process is failed. Please contact Neo directly.";
	const ET_EMAIL_INFO = "Plase make payment to this email address: 123@abc.com. ";
	const EMAIL_INTERAC_LINK = '<a href="http://www.interac.ca/en/interac-e-transfer-consumer.html" class="general_text_link_3_style">Here is the Link to Email Money Transfer</a>';
	const CC_ORDER_ADD_SUCCESS = "Thanks! Your order commit is received. Please contact Neo once your credit card payment is made.";
	const CC_ORDER_ADD_FAIL = "Sorry! Your order commit process is failed. Please contact Neo directly.";
	const PAYPAL_EMAIL_INFO = "Credit card is processed through Paypal, please make payment to this email: 123@abc.com. ";
	const PAYPAL_LINK = '<a href="http://www.paypal.com/" class="general_text_link_3_style">Here is the Link to Credit Card / Paypal</a>';
	const PAYMENT_METHOD_INDICATION = "Payment can be made with two methods above.";
	
	// Order status
	const ORDER_STATUS_EMAIL_COMMIT = 1;
	const ORDER_STATUS_EMAIL_PAYMENT_RECV = 2;
	const ORDER_STATUS_CREDIT_CARD_COMMIT = 11;
	const ORDER_STATUS_CREDIT_CARD_PAYMENT_RECV = 12;
}

?>