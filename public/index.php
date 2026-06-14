<?php

// Start native PHP session for legacy code compatibility
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define base constants for legacy code compatibility
if (!defined('BASEURL')) {
    $isHttps = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') || 
               (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
    $protocol = ($isHttps ? "https" : "http") . "://";
    $host = $_SERVER['HTTP_HOST'];
    define('BASEURL', $protocol . $host);
}

// Bootstrap Composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel Application
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Get Laravel app instance
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Handle request
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Send response
$response->send();

// Terminate the request
$kernel->terminate($request, $response);