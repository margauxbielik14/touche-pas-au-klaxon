<?php

declare(strict_types=1);

use App\Controllers\AuthController;
use App\Controllers\HomeController;
use App\Core\Database;
use App\Core\Router;
use App\Core\Session;
use App\Repositories\TripRepository;
use App\Repositories\UserRepository;
use Dotenv\Dotenv;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

Session::start();

$database = new Database();
$connection = $database->getConnection();

$tripRepository = new TripRepository($connection);
$userRepository = new UserRepository($connection);

$homeController = new HomeController($tripRepository);
$authController = new AuthController($userRepository);

$router = new Router();

$router->get('/', [$homeController, 'index']);

$router->get('/login', [$authController, 'showLoginForm']);
$router->post('/login', [$authController, 'login']);

$router->get('/logout', [$authController, 'logout']);

$router->dispatch();