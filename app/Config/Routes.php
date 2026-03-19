<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Todo::index');
$routes->post('todo/create', 'Todo::create');
$routes->get('todo/updateStatus/(:num)/(:any)', 'Todo::updateStatus/$1/$2');
$routes->get('todo/delete/(:num)', 'Todo::delete/$1');
