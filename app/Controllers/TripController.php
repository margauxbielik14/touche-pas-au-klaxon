<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Session;
use App\Repositories\AgencyRepository;
use App\Repositories\TripRepository;

/**
 * Handles trip-related actions.
 */
class TripController
{
    public function __construct(
        private TripRepository $tripRepository,
        private AgencyRepository $agencyRepository
    ) {
    }

    /**
     * Displays the trip creation form.
     */
    public function create(): void
    {
        Auth::requireLogin();

        $user = Auth::user();
        $agencies = $this->agencyRepository->findAll();

        require dirname(__DIR__, 2) . '/templates/trips/create.php';
    }
    /**
 * Validates and stores a new trip.
 */
public function store(): void
{
    Auth::requireLogin();

    $user = Auth::user();

    if ($user === null) {
        return;
    }

    $departureAgencyId = (int) ($_POST['agence_depart'] ?? 0);
    $arrivalAgencyId = (int) ($_POST['agence_arrivee'] ?? 0);
    $departureDateTime = trim($_POST['date_heure_depart'] ?? '');
    $arrivalDateTime = trim($_POST['date_heure_arrivee'] ?? '');
    $totalSeats = (int) ($_POST['nombre_places'] ?? 0);

    $errors = [];

    if (
        $departureAgencyId <= 0
        || $arrivalAgencyId <= 0
    ) {
        $errors[] = 'Veuillez sélectionner les agences.';
    }

    if ($departureAgencyId === $arrivalAgencyId) {
        $errors[] = 'Les agences de départ et d’arrivée doivent être différentes.';
    }

    $departureTimestamp = strtotime($departureDateTime);
    $arrivalTimestamp = strtotime($arrivalDateTime);

    if (
        $departureTimestamp === false
        || $arrivalTimestamp === false
    ) {
        $errors[] = 'Les dates renseignées sont invalides.';
    } else {
        if ($departureTimestamp <= time()) {
            $errors[] = 'La date de départ doit être future.';
        }

        if ($arrivalTimestamp <= $departureTimestamp) {
            $errors[] = 'La date d’arrivée doit être postérieure au départ.';
        }
    }

    if ($totalSeats <= 0) {
        $errors[] = 'Le nombre de places doit être supérieur à zéro.';
    }

    if ($errors !== []) {
        $agencies = $this->agencyRepository->findAll();

        require dirname(__DIR__, 2) . '/templates/trips/create.php';

        return;
    }

    $this->tripRepository->create(
        (int) $user['id'],
        $departureAgencyId,
        $arrivalAgencyId,
        $departureDateTime,
        $arrivalDateTime,
        $totalSeats
    );

    Session::set(
        'flash_success',
        'Le trajet a été créé avec succès.'
    );

    header('Location: /');
    exit;
}
}