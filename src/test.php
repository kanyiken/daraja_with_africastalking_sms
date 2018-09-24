<?php


require_once 'functions.php';

//echo initiateB2C('254726991992', '10', 'SalaryPayment', 'Nice Thing');

//echo generateToken();

echo initiateB2B('BusinessTransferFromUtilityToMMF', '4', '', 1000, '', '1005303447', 'Test');
//initiateB2B($COMMAND_ID, $SENDER_IDENTIFIER, $RECEIVER_IDENTIFIER, $AMOUNT, $TO_PAYBILL, $ACCOUNT_NO, $REMARKS)

?>