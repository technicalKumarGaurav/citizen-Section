<?php

use CodeIgniter\Router\RouteCollection;
// use App\Controllers\NewsController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/submit-data', 'Home::store');
$routes->get('/request-status', 'Home::status');
$routes->get('user_details/(:num)', 'Home::userDetails/$1');
$routes->group('api', function ($routes) {
    $routes->get('tehsils', 'TehsilController::index');
    $routes->get('panchayats', 'PanchayatController::index');
    $routes->get('villages', 'VillageController::index');
});

$routes->get('/thankyou', 'Home::thankyou');
$routes->get('/generatePdf', 'Home::generatePdf');
