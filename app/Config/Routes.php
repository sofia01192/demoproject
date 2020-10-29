<?php namespace Config;

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
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('about-us', 'Home::about');
$routes->post('contact-us', 'Contact::submitTicket');
$routes->get('contact-us', 'Contact::index');
$routes->get('faqs', 'Home::faqs');
// routes for users
$routes->get('logout', 'Users::logout');
$routes->get('login', 'Users::login');
$routes->post('loginSubmit', 'Users::loginSubmit');
$routes->get('edit-userInfo(:any)','EditUser::edituserProfile/$1');
$routes->post('update-userInfo','EditUser::updateuserProfile');
$routes->get('parlour-dashboard','Users::parlouradminDasboard');

$routes->get('password-change(:any)','EditUser::changePassword/$1');
$routes->post('update-password','EditUser::updatePassword');
$routes->get('user-profile','Users::userProfile');
$routes->get('parlourdashboard', 'Users::parlouradminDasboard');

$routes->get('register', 'UserRegister::register');
$routes->post('register-submit', 'UserRegister::registerSubmit');

$routes->get('dashboard', 'Users::dashboard');
//routes for parlours
$routes->get('add-your-parlour', 'Parlours::ParlourSubmit');
$routes->post('submitparlour', 'Parlours::ParlourSubmit');
$routes->get('nearby-parlours','Parlours::showNearby');
$routes->get('list', 'Parlours::list');
$routes->get('shop', 'Shops::list');
$routes->get('blog', 'Blogs::list');

$routes->get('services/(.*)', 'Services::view/$1');

//routes for branch controller
$routes->get('parlours','Parlours::showParlours');
$routes->get('branches(:any)','Branch::parlourBranches/$1');
$routes->get('branch-edit(:any)','Branch::editBranch/$1');
$routes->post('branch-update','Branch::updateBranch');
$routes->post('branch-delete(:any)','Branch::deleteBranch/$1');
$routes->get('add-branch(:any)', 'Branch::addNewbranch/$1');
$routes->post('add-branch(:any)', 'Branch::addNewbranch/$1');


// $routes->get('multi','Test::jQ');
// $routes->post('multi','Test::jQ');
// $routes->get('jointable','Test::jointable');
// $routes->get('check-loc','Test::checkLoc');







//$routes->get('Branches','Users::parlourBranches');

//$routes->get('nearby-parlours','Parlours::nearbyParlours');




/**
 * --------------------------------------------------------------------
 * Admin Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->get('admin-home', 'Admin_Users::index');
// $routes->post('admin-login', 'Admin_Users::login');
// $routes->get('admin-logout', 'Admin_Users::logout');
// $routes->get('admin-dashboard', 'Admin_Users::dashboard');


// $routes->get('admin-showlist/(.*)', 'Admin::showlist/$1');
// $routes->get('admin-add/(.*)', 'Admin::add/$1');
// $routes->get('admin-update/(.*)', 'Admin::update/$1');

$routes->get('/admin-home', 'Users::adminIndex');
$routes->post('/admin-login', 'Users::adminLogin');
$routes->get('/admin-dashboard', 'Users::adminDashboard');
$routes->get('/admin-logout', 'Users::adminLogout');

$routes->get('admin-showlist/(.*)', 'BaseController::showListAdmin/$1');
$routes->get('admin-add/(.*)', 'BaseController::addRecordAdmin/$1');
$routes->get('admin-update/(.*)/(.*)', 'BaseController::updateRecordAdmin/$1/$2');
$routes->post('admin-add/(.*)', 'BaseController::addRecordAdminSave/$1');
$routes->post('admin-update/(.*)', 'BaseController::updateRecordAdminSave/$1');
$routes->get('admin-delete/(.*)/(.*)', 'BaseController::deleteRecordPermanent/$1/$2');


/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
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
