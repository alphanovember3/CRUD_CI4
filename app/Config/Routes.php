<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/saveUser','Home::saveUser');
$routes->get('/getSingleUser/(:num)','Home::getSingleUser/$1');
$routes->post('/updateUser','Home::updateUser');
$routes->post('/deleteUser','Home::deleteUser');
$routes->post('/deleteMultiUser','Home::deleteMultiUser');
$routes->get('/downloadfile','Home::downloadfile');
$routes->match(['get','post'],'/uploadfile','Home::uploadfile');   

// Authentication routes

$routes->match(['get','post'],'/login','Auth::login');
// $routes->get('/register','Home::register');
$routes->match(['get','post'],'/register','Auth::register');

$routes->get('/logout','Auth::logout');
 