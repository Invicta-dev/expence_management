<?php

namespace Config;

use App\Controllers\Dashboard;
use App\Controllers\Login;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('/', 'Home::index');
$routes->get('/', 'Login::index');
$routes->post('dashboard', 'Login::check');

$routes->add('logout', 'Dashboard::logout');
$routes->add('forget-password', 'Login::forgotPassword');
$routes->add('reset_password/(:any)', 'Login::reset_password/$1');




//isLoggedIn and getACCESS filter is applied on this group of routes
$routes->group('', ['filter' => 'isLoggedIn', 'filter' => 'getAccess'], function ($routes) {
	$routes->get('user', 'Dashboard::user');
	$routes->get('process', 'Dashboard::getProcess');

	$routes->add('add-user', 'Dashboard::addUser');
	$routes->add('delete/(:any)', 'Dashboard::deleteUser/$1');
	$routes->add('edit', 'Dashboard::editUser');

	$routes->add('category', 'Dashboard::categories');
	$routes->add('deleteCategory/(:any)', 'Dashboard::deleteCategory/$1');

	$routes->add('deleteProcess/(:any)', 'Dashboard::deleteProcess/$1');
	$routes->post('add_process', 'Dashboard::add_process');
});
//isLoggedIn  filter is applied on this group of routes
$routes->group('', ['filter' => 'isLoggedIn'], function ($routes) {
	$routes->add('expense', 'Dashboard::addExpense');
	$routes->add('deleteExpense/(:any)', 'Dashboard::delete_expense/$1');
	$routes->add('dashboard/ajax-call', 'Dashboard::getAjax');
	$routes->add('filter', 'Dashboard::getExpenseByFilters');
	$routes->add('edit-expense', 'Dashboard::editExpense');
	$routes->add('vendor', 'Dashboard::get_add_vendor');
	$routes->add('delete-vendor/(:any)', 'Dashboard::deleteVendor/$1');
	$routes->add('listVendor', 'Dashboard::searchVendorList');
	$routes->add('item-details', 'Dashboard::item_breakdown');
});

$routes->post('set_password', 'Login::change_pwd');

/**
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
