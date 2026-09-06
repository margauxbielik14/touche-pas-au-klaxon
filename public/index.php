<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Core\Database;
use App\Repositories\TripRepository;
use Dotenv\Dotenv;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$database = new Database();

$tripRepository = new TripRepository(
    $database->getConnection()
);

$homeController = new HomeController(
    $tripRepository
);

$homeController->index();