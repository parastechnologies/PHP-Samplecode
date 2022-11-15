<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);
$routes->resource('User');

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
$userController = 'User::';
$userControllerRoute = 'user/';

$homeController = 'Home::';
$homeControllerRoute = 'home/';

$dashboardController = 'Dashboard::';
$dashboardControllerRoute = '/WS0maaraFZ9D/';

$loginController = 'Login::';

$landingController = 'Landing::';
$lanControllerRoute = '/';

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//$routes->get('/', 'Home::index');


/*Start API routes*/

$routes->post($userControllerRoute.'register', $userController.'register');
$routes->post($userControllerRoute.'login', $userController.'login');

$routes->get($userControllerRoute.'profile', $userController.'getUserProfile');
$routes->post($userControllerRoute.'profile/update', $userController.'updateProfile');
$routes->post($userControllerRoute.'profile/status', $userController.'userStatus');
$routes->post($userControllerRoute.'business/staff/status', $userController.'businessStaffStatus');
$routes->get($userControllerRoute.'accounts', $userController.'userAccounts');

$routes->post($userControllerRoute.'change/password', $userController.'changePassword');
$routes->post($userControllerRoute.'forgot/password', $userController.'forgotPassword');
$routes->post($userControllerRoute.'reset/password', $userController.'resetPassword');
$routes->post($userControllerRoute.'otp/verify', $userController.'verifyOTP');
$routes->post($userControllerRoute.'otp/resend', $userController.'resendOtp');

$routes->post($userControllerRoute.'logout', $userController.'logout');
$routes->post($homeControllerRoute.'pages', $homeController.'pages');



$routes->post($homeControllerRoute.'private/account/add', $homeController.'privateAccountAdd');
$routes->post($homeControllerRoute.'private/account/update', $homeController.'privateAccountUpdate');
$routes->get($homeControllerRoute.'private/account/view/(:any)', $homeController.'privateAccountView/$1');
$routes->get($homeControllerRoute.'private/account/list', $homeController.'privateAccountList');

$routes->post($homeControllerRoute.'business/account/add', $homeController.'businessAccountAdd');
$routes->post($homeControllerRoute.'business/account/update', $homeController.'businessAccountUpdate');
$routes->get($homeControllerRoute.'business/account/view/(:any)', $homeController.'businessAccountView/$1');
$routes->get($homeControllerRoute.'business/account/list', $homeController.'businessAccountList');

$routes->post($homeControllerRoute.'business/staff/add', $homeController.'businessStaffAdd');
$routes->post($homeControllerRoute.'business/staff/update', $homeController.'businessStaffUpdate');
$routes->delete($homeControllerRoute.'business/staff/delete/(:any)', $homeController.'businessStaffDelete/$1');
$routes->get($homeControllerRoute.'business/staff/view/(:any)', $homeController.'businessStaffView/$1');
$routes->post($homeControllerRoute.'business/staff/list', $homeController.'businessStaffList');

$routes->get($homeControllerRoute.'devices/types/list', $homeController.'userDeviceTypesList');
$routes->get($userControllerRoute.'devices/list', $homeController.'userDeviceList');
$routes->post($homeControllerRoute.'device/scan', $homeController.'deviceScan');
$routes->post($homeControllerRoute.'device/assign/account', $homeController.'deviceAssignedToAccount');
$routes->post($homeControllerRoute.'device/scan', $homeController.'deviceScan');
$routes->post($userControllerRoute.'device/rename', $homeController.'renameDevice');
$routes->post($userControllerRoute.'device/status/change', $homeController.'unlinkOrRemoveDevice');


$routes->get($homeControllerRoute.'platforms', $homeController.'plateforms');
$routes->post($userControllerRoute.'platform/add', $userController.'addPlatforms');
$routes->post($userControllerRoute.'platform/update', $userController.'updatePlatform');
$routes->delete($userControllerRoute.'platform/delete/(:any)', $userController.'deletePlatform/$1');
$routes->post($userControllerRoute.'platforms', $userController.'getPlatforms');
$routes->post($userControllerRoute.'platforms/order', $homeController.'userPlatformOrder');



$routes->post($userControllerRoute.'direct/link/status', $userController.'setDirectLink');

$routes->get($homeControllerRoute.'themes', $homeController.'themes');
$routes->post($userControllerRoute.'theme/customize', $userController.'customizeTheme');

$routes->post($userControllerRoute.'connection/add', $homeController.'addConnection');
$routes->post($userControllerRoute.'connections/list', $homeController.'userConnectionList');
$routes->post($userControllerRoute.'connection/user/detail', $homeController.'connectionUserDetail');

$routes->post($homeControllerRoute.'subscription', $homeController.'subscription');

$routes->post($homeControllerRoute.'subscriptions', $homeController.'subscription');
$routes->post($homeControllerRoute.'subscriptionsios', $homeController.'subscriptionIOS');


$routes->post($userControllerRoute.'analytics', $userController.'analytics');

$routes->post($userControllerRoute.'subscription/add', $homeController.'addSubscription');

$routes->post($userControllerRoute.'change/language', $userController.'changeLanguage');
$routes->post($userControllerRoute.'test', $userController.'test');

$routes->delete($userControllerRoute.'account/delete', $userController.'deleteAccount');


/*Stop API routes*/

/*landing routes start */

$routes->get($lanControllerRoute, $landingController.'index');
$routes->get($lanControllerRoute.'shop', $landingController.'shop');
$routes->get($lanControllerRoute.'services', $landingController.'services');
$routes->get($lanControllerRoute.'team', $landingController.'team');
$routes->get($lanControllerRoute.'product/(:any)', $landingController.'productDetail/$1');
$routes->post($lanControllerRoute.'product/cart/add', $landingController.'addToCart');
$routes->post($lanControllerRoute.'cart/qty/change', $landingController.'changeCartQty');
$routes->post($lanControllerRoute.'product/color/image', $landingController.'changeProductColorImage');
$routes->get($lanControllerRoute.'cart', $landingController.'cartList');
$routes->get($lanControllerRoute.'checkout', $landingController.'checkout',['filter' => 'landingauthGuard']);
$routes->get($lanControllerRoute.'payment', $landingController.'payment',['filter' => 'landingauthGuard']);
$routes->post($lanControllerRoute.'paynow', $landingController.'paynow');
$routes->post($lanControllerRoute.'state/selection', $landingController.'getStatesByCountry');
$routes->get($lanControllerRoute.'register', $landingController.'register');
$routes->get($lanControllerRoute.'login', $landingController.'login');
$routes->get($lanControllerRoute.'logout', $landingController.'logout');
$routes->post($lanControllerRoute.'register', $landingController.'registerUser');
$routes->post($lanControllerRoute.'login', $landingController.'loginUser');

$routes->get($lanControllerRoute.'profile/(:any)', $homeController.'getUserProfileForWeb/$1');
$routes->get($lanControllerRoute.'device/(:any)', $homeController.'getUserDetailByDeviceNumberOnWeb/$1');
$routes->post($lanControllerRoute.'connect/send/mail', $homeController.'sendMailToConnectOnWeb');

$routes->get($lanControllerRoute.'help', $landingController.'getPages');
$routes->get($lanControllerRoute.'terms', $landingController.'getPages');
$routes->get($lanControllerRoute.'privacy', $landingController.'getPages');
$routes->get($lanControllerRoute.'shipping', $landingController.'getPages');
$routes->get($lanControllerRoute.'refund', $landingController.'getPages');
$routes->get($lanControllerRoute.'compatibility', $landingController.'getPages');

$routes->get($lanControllerRoute.'custom/card/(:any)', $landingController.'customCard/$1');

$routes->get($lanControllerRoute.'orders', $landingController.'orders',['filter' => 'landingauthGuard']);
$routes->get($lanControllerRoute.'order/(:any)', $landingController.'orderDetail/$1',['filter' => 'landingauthGuard']);
$routes->get($lanControllerRoute.'orders/success', $landingController.'orderSuccess',['filter' => 'landingauthGuard']);
$routes->get($lanControllerRoute.'orders/cancel', $landingController.'orderCancel',['filter' => 'landingauthGuard']);


/*landing routes start */


/*Admin panel routes start */

$routes->get($dashboardControllerRoute.'dashboard', $dashboardController.'index',['filter' => 'authGuard']);
$routes->get($dashboardControllerRoute.'users', $dashboardController.'userManagement',['filter' => 'authGuard']);
$routes->get($dashboardControllerRoute.'user/(:any)',$dashboardController.'userDetail/$1',['filter' => 'authGuard']);
$routes->post($dashboardControllerRoute.'user/change/status', $dashboardController.'userStatusChange',['filter' => 'authGuard']);

$routes->post($dashboardControllerRoute.'users/csv/import', $dashboardController.'usersCSVImport',['filter' => 'authGuard']);


$routes->get($dashboardControllerRoute.'report/list', $dashboardController.'reportManagement',['filter' => 'authGuard']);
$routes->post($dashboardControllerRoute.'report/send/mail', $dashboardController.'sendMailOnReport',['filter' => 'authGuard']);

$routes->get($dashboardControllerRoute.'devices', $dashboardController.'devicesManagement',['filter' => 'authGuard']);
$routes->post($dashboardControllerRoute.'device/add', $dashboardController.'addDevice',['filter' => 'authGuard']);
$routes->get($dashboardControllerRoute.'device/block/(:any)', $dashboardController.'changeStatusDevice/$1',['filter' => 'authGuard']);

$routes->get($dashboardControllerRoute.'devices/types', $dashboardController.'devicesTypesManagement/$1',['filter' => 'authGuard']);
$routes->post($dashboardControllerRoute.'device/type/add', $dashboardController.'addDeviceType',['filter' => 'authGuard']);
$routes->get($dashboardControllerRoute.'device/type/delete/(:any)', $dashboardController.'deleteDeviceType/$1',['filter' => 'authGuard']);


$routes->get($dashboardControllerRoute.'social', $dashboardController.'socialManagement',['filter' => 'authGuard']);
$routes->post($dashboardControllerRoute.'social/add', $dashboardController.'addSocial',['filter' => 'authGuard']);
$routes->post($dashboardControllerRoute.'social/update', $dashboardController.'updateSocial',['filter' => 'authGuard']);
$routes->get($dashboardControllerRoute.'social/delete/(:any)', $dashboardController.'deleteSocial/$1',['filter' => 'authGuard']);

$routes->get($dashboardControllerRoute.'colors', $dashboardController.'colorManagement',['filter' => 'authGuard']);
$routes->post($dashboardControllerRoute.'color/add', $dashboardController.'addColor',['filter' => 'authGuard']);
$routes->get($dashboardControllerRoute.'color/delete/(:any)', $dashboardController.'deleteColor/$1',['filter' => 'authGuard']);

$routes->get($dashboardControllerRoute.'products', $dashboardController.'productsManagement',['filter' => 'authGuard']);
$routes->get($dashboardControllerRoute.'product/add', $dashboardController.'addProduct',['filter' => 'authGuard']);
$routes->post($dashboardControllerRoute.'product/add', $dashboardController.'insertProduct',['filter' => 'authGuard']);
$routes->get($dashboardControllerRoute.'product/delete/(:any)', $dashboardController.'deleteProduct/$1',['filter' => 'authGuard']);
$routes->get($dashboardControllerRoute.'product/detail/(:any)', $dashboardController.'productsDetail/$1',['filter' => 'authGuard']);
$routes->get($dashboardControllerRoute.'product/update/(:any)', $dashboardController.'updateProduct/$1',['filter' => 'authGuard']);
$routes->post($dashboardControllerRoute.'product/update/(:any)', $dashboardController.'updateProductData/$1',['filter' => 'authGuard']);
$routes->get($dashboardControllerRoute.'product/image/delete/(:any)', $dashboardController.'deleteProductImage/$1',['filter' => 'authGuard']);
$routes->post($dashboardControllerRoute.'product/colors', $dashboardController.'getColorsByProduct',['filter' => 'authGuard']);

$routes->get($dashboardControllerRoute.'settings', $dashboardController.'settings',['filter' => 'authGuard']);
$routes->post($dashboardControllerRoute.'setting/change', $dashboardController.'settingchange',['filter' => 'authGuard']);
$routes->post($dashboardControllerRoute.'setting/profile/image/change', $dashboardController.'profileChange',['filter' => 'authGuard']);
$routes->get($dashboardControllerRoute.'setting/profile/image/delete', $dashboardController.'profileDelete',['filter' => 'authGuard']);

$routes->get($dashboardControllerRoute.'login', $loginController.'login',['filter' => 'unauthGuard']);
$routes->post($dashboardControllerRoute.'loginMe', $loginController.'loginMe',['filter' => 'unauthGuard']);
$routes->get($dashboardControllerRoute.'forgot/password', $loginController.'forgotPassword',['filter' => 'unauthGuard']);
$routes->post($dashboardControllerRoute.'forgot/password/mail', $loginController.'forgotPasswordMail',['filter' => 'unauthGuard']);
$routes->post($dashboardControllerRoute.'reset/password', $loginController.'resetNewPassword',['filter' => 'unauthGuard']);
$routes->get($dashboardControllerRoute.'reset/password/(:any)', $loginController.'resetPassword/$1',['filter' => 'unauthGuard']);

$routes->get($dashboardControllerRoute.'orders', $dashboardController.'orderManagement',['filter' => 'authGuard']);
$routes->get($dashboardControllerRoute.'order/(:any)', $dashboardController.'orderDetail/$1',['filter' => 'authGuard']);
$routes->post($dashboardControllerRoute.'order/status/change', $dashboardController.'changeOrderStatus',['filter' => 'authGuard']);
$routes->get($dashboardControllerRoute.'orders/create', $dashboardController.'createOrder',['filter' => 'authGuard']);
$routes->post($dashboardControllerRoute.'orders/create', $dashboardController.'addOrder',['filter' => 'authGuard']);

$routes->get($dashboardControllerRoute.'logout', $loginController.'logout');

$routes->get($dashboardControllerRoute.'test', $dashboardController.'test');

$routes->get($dashboardControllerRoute.'pages', $dashboardController.'pages',['filter' => 'authGuard']);
$routes->get($dashboardControllerRoute.'pages/(:any)', $dashboardController.'updatePage/$1',['filter' => 'authGuard']);
$routes->post($dashboardControllerRoute.'page/update', $dashboardController.'updatePageDetail',['filter' => 'authGuard']);

$routes->get($dashboardControllerRoute.'revenues', $dashboardController.'revenueManagement',['filter' => 'authGuard']);
/*Admin panel routes stop */

/*Landing  panel routes stop */


/*Landing panel routes stop */

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}