<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/home', 'Home::index');

$routes->get('/user/login', 'UserLoginController::index');
$routes->post('/user/login', 'UserLoginController::loginAction');
$routes->get('logout', 'UserLoginController::logout');
$routes->get('/user/register', 'UserLoginController::register');
$routes->post('/user/register', 'UserLoginController::prosesRegister');
$routes->get('user/forgot-password', 'PasswordResetController::forgotForm');
$routes->post('user/forgot-password', 'PasswordResetController::sendLink');
$routes->get('/user/profile', 'UserProfileController::index');


$routes->get('user/reset-password/(:segment)', 'PasswordResetController::resetForm/$1');
$routes->post('user/reset-password', 'PasswordResetController::reset');
$routes->get('reset-password/(:segment)', 'PasswordResetController::resetForm/$1');


$routes->get('/admin/login', 'Admin\AdminLoginController::login');
$routes->post('/admin/login', 'Admin\AdminLoginController::loginAction');
$routes->get('/admin/logout', 'Admin\AdminLoginController::logout');

$routes->get('/admin/home', 'Admin\Home::index');

$routes->get('/admin/test', 'Admin\Menu::testRoute');
$routes->get('/admin', 'Admin\Menu::index');
$routes->get('/admin/menu', 'Admin\Menu::index');

$routes->get('/admin/pesanan_baru', 'Admin\Pesanan::index');
$routes->post('/admin/pesanan/update_status/(:num)', 'Admin\Pesanan::updateStatus/$1');
$routes->post('admin/pesanan/update_status/(:num)', 'Admin\Pesanan::updateStatus/$1');


$routes->get('/admin/tambah', 'Admin\Menu::tambah');
$routes->post('/admin/simpan', 'Admin\Menu::simpan');

$routes->get('/admin/ubah/(:num)', 'Admin\Menu::ubah/$1');
$routes->post('/admin/update/(:num)', 'Admin\Menu::update/$1');

$routes->get('admin/detail/(:num)', 'Admin\Menu::detail/$1');
$routes->delete('/admin/hapus/(:num)', 'Admin\Menu::hapus/$1');

$routes->get('user/home', 'UserLoginController::userHome');
$routes->get('user/menu', 'User\Menu::index');
$routes->get('user/profile', 'User\User::profile');
$routes->get('user/profile', 'UserProfileController::index');
$routes->get('user/profile/edit', 'UserProfileController::edit');
$routes->post('user/profile/update', 'UserProfileController::update');


$routes->get('user/menu/detail/(:num)', 'User\Menu::detail/$1');

$routes->get('user/order/form/(:segment)', 'User\Order::form/$1');
$routes->post('user/order/create', 'User\Order::create');
$routes->get('user/order/payment/(:num)', 'User\Order::payment/$1');
$routes->get('user/order/confirmPayment/(:num)', 'User\Order::confirmPayment/$1');
$routes->get('user/order/status/(:num)', 'User\Order::status/$1');
$routes->get('user/order/delivery/(:num)', 'User\Order::deliveryStatus/$1');
$routes->get('user/order/rating/(:num)', 'User\Order::ratingForm/$1');
$routes->post('user/order/rating/submit/(:num)', 'User\Order::submitRating/$1');
$routes->get('user/order/cod_confirmation/(:num)', 'User\Order::cod_confirmation/$1');
$routes->get('user/order/mark-delivered/(:num)', 'User\Order::markDelivered/$1');

//API
$routes->options('api/user/(:any)', static function () {
    return service('response')->setStatusCode(204);
});

$routes->options('user/(:any)', static function () {
    return service('response')->setStatusCode(204);
});

//ADMIN
$routes->post('admin/login', 'API\Admin\AdminLoginController::login');
$routes->group('admin', function($routes){
    // Home
    $routes->get('home', 'API\Admin\HomeController::index');

    // Menu
    $routes->get('menu', 'API\Admin\MenuController::index');
    $routes->get('menu/(:num)','API\Admin\MenuController::detail/$1');
    $routes->post('menu', 'API\Admin\MenuController::simpan');
    $routes->put('menu/(:num)', 'API\Admin\MenuController::update/$1');
    $routes->delete('menu/(:num)', 'API\Admin\MenuController::hapus/$1');

    // Pesanan
    $routes->get('pesanan','API\Admin\PesananController::index');
    $routes->get('pesanan/(:num)','API\Admin\PesananController::detail/$1');
    $routes->put('pesanan/status/(:num)','API\Admin\PesananController::updateStatus/$1');
});

//USER
$routes->group('user', function($routes){
    // Auth
    $routes->post('register','API\User\RegisterController::register');
    $routes->post('login','API\User\UserLoginController::login');
    $routes->get('home','API\User\UserLoginController::home');
    // $routes->post('forgot-password','API\User\UserLoginController::forgotPassword'); katanya suruh di hapus
    $routes->post('forgot-password', 'API\User\PasswordResetController::sendLink');
    $routes->get('reset-password/validate/(:segment)', 'API\User\PasswordResetController::validateToken/$1');
    $routes->post('reset-password', 'API\User\PasswordResetController::resetPassword');
    $routes->post('logout','API\User\UserLoginController::logout');

    // Menu
    $routes->get('menu','API\User\MenuController::index');
    $routes->get('menu/(:num)','API\User\MenuController::detail/$1');
    $routes->get('menu/pesan/(:num)','API\User\MenuController::pesan/$1');

    // Order
    $routes->get('orders','API\User\OrderController::index');
    $routes->post('order','API\User\OrderController::create');
    $routes->get('order/(:num)','API\User\OrderController::detail/$1');
    $routes->get('order/status/(:num)','API\User\OrderController::status/$1');
    $routes->put('order/status/(:num)','API\User\OrderController::updateStatus/$1');
    $routes->put('order/selesai/(:num)','API\User\OrderController::markDelivered/$1');
    $routes->post('order/rating/(:num)','API\User\OrderController::submitRating/$1');

    // Profile
    $routes->get('profile/(:num)','API\User\UserProfileController::index/$1');
    $routes->post('profile/update/(:num)','API\User\UserProfileController::update/$1');
});

// MOBILE API ALIASES
// Prefix API mobile supaya tidak bentrok dengan route web user/* di atas.
$routes->group('api/user', function($routes){
    // Auth
    $routes->post('register','API\User\RegisterController::register');
    $routes->post('login','API\User\UserLoginController::login');
    $routes->get('home','API\User\UserLoginController::home');
    $routes->post('forgot-password','API\User\PasswordResetController::sendLink');
    $routes->get('reset-password/validate/(:segment)', 'API\User\PasswordResetController::validateToken/$1');
    $routes->post('reset-password', 'API\User\PasswordResetController::resetPassword');
    $routes->post('logout','API\User\UserLoginController::logout');

    // Menu
    $routes->get('menu','API\User\MenuController::index');
    $routes->get('menu/(:num)','API\User\MenuController::detail/$1');
    $routes->get('menu/pesan/(:num)','API\User\MenuController::pesan/$1');

    // Order
    $routes->get('orders','API\User\OrderController::index');
    $routes->post('order','API\User\OrderController::create');
    $routes->get('order/(:num)','API\User\OrderController::detail/$1');
    $routes->get('order/status/(:num)','API\User\OrderController::status/$1');
    $routes->put('order/status/(:num)','API\User\OrderController::updateStatus/$1');
    $routes->put('order/selesai/(:num)','API\User\OrderController::markDelivered/$1');
    $routes->post('order/rating/(:num)','API\User\OrderController::submitRating/$1');

    // Profile
    $routes->get('profile/(:num)','API\User\UserProfileController::index/$1');
    $routes->post('profile/update/(:num)','API\User\UserProfileController::update/$1');
});
