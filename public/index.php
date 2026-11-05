<?php

// Start session if not started
if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
    session_start();
}

// Calculate base URL dynamically for root or subfolder installation (e.g. /magic-web/public)
if (!defined('BASE_URL')) {
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    $base = rtrim($scriptDir, '/');
    define('BASE_URL', $base);
}

// Autoload core, config, and models
require_once __DIR__ . '/../app/config/Database.php';
require_once __DIR__ . '/../app/core/Router.php';
require_once __DIR__ . '/../app/core/Controller.php';

$router = new Router();

// Public Routes
$router->get('/', 'HomeController@index');
$router->get('/index.html', 'HomeController@index');
$router->get('/about', 'HomeController@about');
$router->get('/about.html', 'HomeController@about');
$router->get('/services', 'HomeController@services');
$router->get('/services.html', 'HomeController@services');
$router->get('/gallery', 'GalleryController@index');
$router->get('/gallery.html', 'GalleryController@index');
$router->get('/contact', 'HomeController@contact');
$router->get('/contact.html', 'HomeController@contact');

// Enquiry Submission
$router->post('/enquiry/submit', 'EnquiryController@submit');

// Admin Routes
$router->get('/admin', 'AdminController@dashboard');
$router->get('/admin/dashboard', 'AdminController@dashboard');
$router->get('/admin/login', 'AdminController@login');
$router->post('/admin/login', 'AdminController@authenticate');
$router->get('/admin/logout', 'AdminController@logout');
$router->post('/admin/logout', 'AdminController@logout');

$router->get('/admin/enquiries', 'AdminController@enquiries');
$router->post('/admin/enquiries/delete', 'AdminController@deleteEnquiry');
$router->post('/admin/enquiries/status', 'AdminController@updateEnquiryStatus');

$router->get('/admin/media', 'AdminController@media');
$router->get('/admin/videos', 'AdminController@media');
$router->get('/admin/gallery', 'AdminController@media');
$router->post('/admin/images/upload', 'AdminController@uploadImage');
$router->post('/admin/images/add', 'AdminController@uploadImage');
$router->post('/admin/images/delete', 'AdminController@deleteImage');
$router->post('/admin/videos/add', 'AdminController@addVideo');
$router->post('/admin/videos/delete', 'AdminController@deleteVideo');

// Dispatch request
$router->dispatch();
