<?php

use CodeIgniter\Router\RouteCollection;
// use App\Controllers\NewsController;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/submit-data', 'Home::store');
$routes->get('api/tehsils', 'TehsilController::index');
