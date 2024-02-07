<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('payment', 'Payment::index');
$routes->get('currency', 'Currency::index');
$routes->get('payment-type', 'PaymentType::index');

// Group routes by module
$routes->group('api', function($routes) {
    $routes->get('payment-type', 'PaymentType::get');
    $routes->post('payment-type', 'PaymentType::add');
    
    $routes->get('currency', 'Currency::get');
    $routes->post('currency', 'Currency::add');
    
    $routes->get('payment', 'Payment::get');
    $routes->post('payment', 'Payment::add');
    
    $routes->get('filter', 'Home::filter');
});
