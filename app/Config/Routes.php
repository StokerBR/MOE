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
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//home
$routes->get('/', 'HomeController::index');

//não autenticado
$routes->group('', ['filter' => 'NoAuth'], function($routes) {
	
	//registrar
	$routes->get('registrar', 'UsuarioController::registrarForm');
	$routes->post('registrar', 'UsuarioController::registrar');
	
	//login
	$routes->get('login', 'UsuarioController::loginForm');
	$routes->post('login', 'UsuarioController::login');

});

//autenticado
$routes->group('', ['filter' => 'Auth'], function($routes) {

	//logout
	$routes->get('logout', 'UsuarioController::logout');

});

//estagiário
$routes->group('estagiario', ['filter' => 'AuthEstagiario'], function($routes) {

	$routes->get('/', 'EstagiarioController::index');

	$routes->get('empresas', 'EstagiarioController::empresas');
	$routes->post('empresas/cadastrar', 'EstagiarioController::cadastrarInteresse');
	$routes->get('interesse', 'EstagiarioController::empresasInteresse');
	$routes->post('interesse/descadastrar', 'EstagiarioController::descadastrarInteresse');

});

//empregador
$routes->group('empregador', ['filter' => 'AuthEmpregador'], function($routes) {

	$routes->get('/', 'EmpregadorController::index');

	$routes->get('vagas', 'VagasController::index');
	$routes->get('vagas/cadastrar', 'VagasController::cadastrar');
	$routes->post('vagas', 'VagasController::inserir');
	$routes->get('vagas/(:num)/editar', 'VagasController::editar');
	$routes->put('vagas', 'VagasController::atualizar');
	$routes->delete('vagas/(:num)', 'VagasController::atualizar');

});


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
