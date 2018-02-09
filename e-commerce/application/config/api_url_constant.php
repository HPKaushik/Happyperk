<?php

defined('BASEPATH') OR exit('No direct script access allowed');

define('API_URL', 'http://122.15.12.37:8119/WalletAPI/api/');

define('MOBILE_VERIFICATION_URL', API_URL.'verificationcode');
define('CREATE_WALLET_URL', API_URL.'CreateWallet');
define('VERIFY_WALLET_URL', API_URL.'verifywallet');
define('SEND_OTP_WALLET_URL', API_URL.'SendOtp');
define('TRANSFERWALLET_URL', API_URL.'Transferwallet');

//Wallet Transaction
define('LOAD_TO_WALLET_URL', API_URL.'Load');
define('WALLET_BALANCE_URL', API_URL.'Balance');
define('MERCHANT_BALANCE_URL', API_URL.'GetMerchantBalance');
define('SEND_TO_OTHER_WALLET_URL', API_URL.'Transferwallet');
define('PAYMENT_URL', API_URL.'Payment');
define('PAYMENT_REVERSE_URL', API_URL.'PaymentReverse');
define('PAYMENT_ENQUIRY_URL', API_URL.'PaymentEnquiry');
define('PAYMENT_PART_REVERSE_URL', API_URL.'PartReversal');

//Recharge API
define('OPERATOR_LIST', API_URL.'OperatorList'); //get method //no parameter
define('OPERATOR_INFO', API_URL.'OperatorInfo'); //get method //parameter->Mobilenumber
define('RECHARGE_PLAN', API_URL.'RechargePlan'); //get method // parameter-> 1. OperatorAlias 2. RegionAlias    like:API_URL.'RechargePlan?OperatorAlias=IDEA&RegionAlias=mp
define('OXIGEN_RECHARGE_SERVICE', API_URL.'OxigenService'); //get method // parameter-> 1. OperatorAlias 2. RegionAlias    like:API_URL.'RechargePlan?OperatorAlias=IDEA&RegionAlias=mp
?>