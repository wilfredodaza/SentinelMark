<?php namespace Config;
      use App\Controllers\RestResume;

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
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('home');
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
$routes->get('/', 'AuthController::login');
// $routes->get('/', 'HomeController::home');

$routes->get('/chat', 'PruebaController::chat');
$routes->get('/datatable/(:segment)', 'PruebaController::datatable/$1');

$routes->post('/table', 'PruebaController::table');
$routes->get('/table', 'PruebaController::table');

$routes->post('prueba', 'PruebaController::index');

$routes->get('password', 'PasswordController::index');
$routes->post('password/updated', 'PasswordController::updated');

$routes->group('dashboard', function ($routes){
	$routes->get('audit', 'AuditController::createTriggers');
	$routes->get('', 'DashboardController::index');
	$routes->group('perfile', function ($routes){
		$routes->get('', 'UserController::perfile');
		$routes->put('', 'UserController::updateUser');
		$routes->post('', 'UserController::updatePhoto');
		$routes->delete('(:num)', 'UserController::deleteUser/$1');
	});

	// Portafolio de marcas
	$routes->group('brand_portfolio', function($routes){
		$routes->get('', 'BrandPortfolioController::index');
		$routes->get('data', 'BrandPortfolioController::getData');
		$routes->get('(:num)', 'BrandPortfolioController::detail/$1');
	});

	$routes->group('trademark_protection', function($routes){
		$routes->get('', 'TrademarkProtectionController::index');
		$routes->get('data', 'TrademarkProtectionController::getData');
		$routes->get('(:num)', 'TrademarkProtectionController::detail/$1');
	});

	$routes->group('brand_defense', function($routes){
		$routes->get('', 'BrandDefenseController::index');
		$routes->get('data', 'BrandDefenseController::getData');
		$routes->get('(:num)', 'BrandDefenseController::detail/$1');
	});

	$routes->group('doculaw', function($routes){
		$routes->group('template_library', function($routes){
			$routes->get('', 'DocuLawController::index_template_library');
			$routes->get('versions/(:num)', 'DocuLawController::view_versions/$1');
		});

		$routes->group('generate', function($routes){
			$routes->get('', 'DocuLawController::index_generate');
			$routes->get('data', 'DocuLawController::generate_data');
		});
	});

	$routes->group('alertboard', function($routes){
		$routes->get('', 'AlertBoardController::index');
		$routes->get('data', 'AlertBoardController::getAlerts');
		$routes->get('alerts', 'AlertBoardController::alerts');
	});

	$routes->group('regulamark', function($routes){
		$routes->get('', 'RegulaMarkController::index');
		$routes->get('data', 'RegulaMarkController::getData');
		$routes->get('history', 'RegulaMarkController::history');
		$routes->get('history/data', 'RegulaMarkController::historyData');
	});

	$routes->group('vigiamarca', function($routes){
		$routes->get('', 'VigiaMarcaController::index');
		$routes->get('data', 'VigiaMarcaController::data');
	});
});

$routes->get('/login', 'AuthController::login');
$routes->get('/register', 'AuthController::register');
$routes->post('/create', 'AuthController::create');
$routes->get('/reset_password', 'AuthController::resetPassword');
$routes->post('/forgot_password', 'AuthController::forgotPassword');
$routes->post('/validation', 'AuthController::validation');
$routes->get('/logout', 'AuthController::logout');
$routes->get('/about', 'DashboardController::about');
$routes->post('/config/(:segment)', 'ConfigController::index/$1');
$routes->get('/config/(:segment)', 'ConfigController::index/$1');
$routes->post('/table/(:segment)', 'TableController::index/$1');
$routes->get('/table/(:segment)', 'TableController::index/$1');

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
