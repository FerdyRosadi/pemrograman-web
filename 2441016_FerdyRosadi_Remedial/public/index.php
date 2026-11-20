<?php

require_once __DIR__ . '/../app/config/config.php';
require_once __DIR__ . '/../app/core/helpers.php';

spl_autoload_register(function ($class) {
    foreach (['core', 'controllers', 'models'] as $dir) {
        $file = ROOT_PATH . '/app/' . $dir . '/' . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

if (!isset($_GET['url'])) {
    $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
    $basePath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
    if ($basePath !== '/' && $basePath !== '' && str_starts_with($uri, $basePath)) {
        $uri = substr($uri, strlen($basePath));
    }
    $_GET['url'] = trim((string) $uri, '/');
}
if ($_GET['url'] === '') $_GET['url'] = 'employees';

session_start();

$router = new Router();
$employees = new EmployeeController();

$router->add('GET', '/', function () use ($employees) { $employees->index(); });
$router->add('GET', '/employees', function () use ($employees) { $employees->index(); });
$router->add('GET', '/employees/create', function () use ($employees) { $employees->create(); });
$router->add('POST', '/employees/store', function () use ($employees) { $employees->store(); });
$router->add('GET', '/employees/edit', function () use ($employees) { $employees->edit(); });
$router->add('POST', '/employees/update', function () use ($employees) { $employees->update(); });
$router->add('POST', '/employees/delete', function () use ($employees) { $employees->destroy(); });

$router->dispatch($_SERVER['REQUEST_METHOD'] ?? 'GET', $_SERVER['REQUEST_URI'] ?? '/');