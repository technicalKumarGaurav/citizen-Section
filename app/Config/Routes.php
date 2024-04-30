<?php

use CodeIgniter\Router\RouteCollection;
// use App\Controllers\NewsController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/submit-data', 'Home::store');
// $routes->get('api/tehsils', 'TehsilController::index');
$routes->group('api', function ($routes) {
    $routes->get('tehsils', 'TehsilController::index');
    $routes->get('panchayats', 'PanchayatController::index');
});