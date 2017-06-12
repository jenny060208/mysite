<?php

namespace NeoWeb\Common\Common;

class BusinessDefinition {
	const BN_STATUS_ACTIVE = 1; // business is active
	const BN_STATUS_DISABLE = 2; // business status is disable
	                             
	// Db1 status definition
	const BN_REG_STEP_1 = 1; // business account creat step 1
	const BN_REG_STEP_2 = 2; // business account creat step 2
	const BN_REG_STEP_3 = 3; // business account creat step 3
	const BN_REG_STEP_4 = 4; // business account creat step 4
	const BN_REG_STEP_5 = 5; // business account creat step 5
	const BN_REG_STEP_6 = 6; // business account creat step 6
	const BN_REG_STEP_1_READY = 1; // business account creat step 1 ready thread
	const BN_REG_STEP_2_READY = 10; // business account creat step 2 ready thread
	const BN_REG_STEP_3_READY = 20; // business account creat step 3 ready thread
	const BN_REG_STEP_4_READY = 30; // business account creat step 4 ready thread
	const BN_REG_STEP_5_READY = 40; // business account creat step 5 ready thread
	const BN_REG_STEP_6_READY = 50; // business account creat step 6 ready thread
}

?>