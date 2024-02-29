<?php

use App\Controllers\PublicationController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->group('api', static function ($routes) {
    $routes->post('chat', 'ChatController::storeMessage');
    $routes->match(['post', 'options'],'verifyToken', 'AuthController::validationToken');    
    $routes->match(['post', 'options'],'storePublication', 'PublicationController::storePublication');    
    $routes->match(['get','options'],'getPublication','PublicationController::getPublication');
    $routes->match(['get','options'],'getCategory','PublicationController::getCategory');
});
