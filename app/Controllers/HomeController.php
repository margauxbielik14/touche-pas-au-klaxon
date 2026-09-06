<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Repositories\TripRepository;

/**
 * Handles the application's home page.
 */
class HomeController
{
    public function __construct(
        private TripRepository $tripRepository
    ) {
    }

    /**
     * Displays the home page with available trips.
     */
    public function index(): void
    {
        $trips = $this->tripRepository->findAvailableTrips();
        $user = Auth::user();

        require dirname(__DIR__, 2) . '/templates/home/index.php';
    }
}