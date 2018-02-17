<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Front_Home/index';
$route['404_override'] = 'Error404/error_404';
$route['translate_uri_dashes'] = FALSE;



$route['home'] = 'Front_Home/index';
$route['home/markasread'] = 'Front_Home/MarkAsReadAnnoucements';
$route['change_location/(:num)'] = "Front_Home/change_location/$1";

$route['api/get_operator_info'] = "api/ApiController/get_operator_info";
$route['api/get_recharge_plan'] = "api/ApiController/get_recharge_plan";

//Vouchers
$route['vouchers'] = "Front_Vouchers/index";
$route['vouchers/getmore'] = "Front_Vouchers/getMoreVoucher";
$route['vouchers/search'] = "Front_Vouchers/search";
$route['vc/(:num)/(:any)'] = "Front_Vouchers/get_coupon/$1";

//Users
$route['login'] = "Front_User/login";
$route['auth'] = "Front_User/auth";
$route['user/login'] = "Front_User/login";
$route['user/logout'] = "Front_User/logout";
$route['user/profile'] = "Front_User/profile";
$route['user/upload/profile'] = "Front_User/updateprofilepicture";
$route['user/updateprofile'] = "Front_User/updateprofile";
$route['user/forgotpassword'] = "Front_User/forgotpassword";
$route['user/changepassword'] = "Front_User/updatepassword";
$route['user/changepassword/(:any)'] = "Front_User/resetpassword/$1";
$route['user/updatepassword'] = "Front_User/updatepassword";


$route['user/address'] = "Front_User/addAddress";
$route['user/address/getcity'] = "Front_User/getCity";
$route['user/address/edit'] = "Front_User/editAddress";
$route['user/address/delete'] = "Front_User/deleteAddress";



$route['cart'] = "Front_Cart/index";
$route['cart/add'] = "Front_Cart/add";
$route['cart/recharges'] = "Front_Cart/recharges";
$route['cart/review'] = "Front_Cart/review";

$route['placeorder'] = "Front_Orders/placeorder";
$route['cart/ordersuccess'] = "Front_Buy/order_success";
$route['placerechargeorder'] = "Front_Buy/placerechargeorder";
$route['order/invoice/(:num)'] = "Front_Orders/generated_invoice/$1";

//Wallet.
$route['user/wallet/verify'] = "Front_User/verifyWallet";
$route['user/wallet/verificationcode'] = "Front_User/SendVerificationCode";
$route['user/wallet/create'] = "Front_User/createwallet";
$route['user/wallet/save'] = "Front_User/savewallet";
$route['user/wallet/sendotp'] = "Front_User/sendOTPForMoney";
$route['user/wallet/dosend'] = "Front_User/DoSendMoney";
$route['user/wallet/doload'] = "Front_User/DoLoadMoney";
$route['user/wallet/dowithdraw'] = "Front_User/DoWithdrawMoney";

$route['user/getEmployee'] = "Front_User/getEmployee";




$route['brands'] = "Front_Brands/index";
$route['about-us'] = "Front_Pages/about_us";
$route['career'] = "Front_Pages/career";
$route['enqiry'] = "Front_Pages/enqiry";
$route['contact-us'] = "ContactUs";