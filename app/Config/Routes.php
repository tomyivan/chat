<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('api', static function ($routes) {
    $routes->post('chat', 'ChatController::storeMessage');
    
});
