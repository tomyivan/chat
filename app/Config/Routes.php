<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->group('api', static function ($routes) {
    $routes->get('chat', 'ChatController::storeMessage');
    
});
