<?php

declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Controllers\TripController;
use App\Controllers\AdminController;
use App\Core\Database;
use App\Core\Router;
use App\Core\Session;
use App\Repositories\TripRepository;
use App\Repositories\UserRepository;
use App\Repositories\AgencyRepository;
use Dotenv\Dotenv;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

Session::start();

$database = new Database();
$connection = $database->getConnection();

$tripRepository = new TripRepository($connection);
$userRepository = new UserRepository($connection);
$agencyRepository = new AgencyRepository($connection);

$homeController = new HomeController($tripRepository);
$authController = new AuthController($userRepository);
$tripController = new TripController(
    $tripRepository,
    $agencyRepository
);

$adminController = new AdminController($userRepository);

$router = new Router();

$router->get('/', [$homeController, 'index']);

$router->get('/login', [$authController, 'showLoginForm']);
$router->post('/login', [$authController, 'login']);

$router->get('/logout', [$authController, 'logout']);

$router->get('/trips/create', [$tripController, 'create']);
$router->post('/trips/create', [$tripController, 'store']);

$router->get('/trips/{id}/edit', [$tripController, 'edit']);
$router->post('/trips/{id}/edit', [$tripController, 'update']);

$router->post('/trips/{id}/delete', [$tripController, 'delete']);

$router->get('/admin', [$adminController, 'dashboard']);
$router->get('/admin/users', [$adminController, 'users']);

$router->dispatch();