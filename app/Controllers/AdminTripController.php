<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Core\Session;
use App\Repositories\TripRepository;
use App\Repositories\AgencyRepository;

/**
 * Handles trip administration.
 */
class AdminTripController
{
    public function __construct(
        private TripRepository $tripRepository,
        private AgencyRepository $agencyRepository
    ) {
    }

    /**
     * Displays all trips.
     */
    public function index(): void
    {
        Auth::requireAdmin();

        $trips = $this->tripRepository->findAll();

        $flashSuccess = Session::get('flash_success');
        Session::remove('flash_success');

        require dirname(__DIR__, 2)
            . '/templates/admin/trips/index.php';
    }

    /**
 * Displays the trip editing form.
 */
public function edit(string $id): void
{
    Auth::requireAdmin();

    $trip = $this->tripRepository->findById((int) $id);

    if ($trip === false) {
        http_response_code(404);
        echo 'Trajet introuvable';

        return;
    }

    $agencies = $this->agencyRepository->findAll();

    require dirname(__DIR__, 2)
        . '/templates/admin/trips/edit.php';
}

/**
 * Validates and updates a trip.
 */
public function update(string $id): void
{
    Auth::requireAdmin();

    $tripId = (int) $id;
    $trip = $this->tripRepository->findById($tripId);

    if ($trip === false) {
        http_response_code(404);
        echo 'Trajet introuvable';

        return;
    }

    $departureAgencyId = (int) ($_POST['id_agence_depart'] ?? 0);
    $arrivalAgencyId = (int) ($_POST['id_agence_arrivee'] ?? 0);
    $departureDate = trim($_POST['date_heure_depart'] ?? '');
    $arrivalDate = trim($_POST['date_heure_arrivee'] ?? '');
    $totalSeats = (int) ($_POST['nombre_places_total'] ?? 0);

    $errors = [];

    if ($departureAgencyId <= 0 || $arrivalAgencyId <= 0) {
        $errors[] = 'Les agences de départ et d’arrivée sont obligatoires.';
    }

    if ($departureAgencyId === $arrivalAgencyId) {
        $errors[] = 'Les agences de départ et d’arrivée doivent être différentes.';
    }

    if ($departureDate === '' || $arrivalDate === '') {
        $errors[] = 'Les dates de départ et d’arrivée sont obligatoires.';
    }

    if (
        $departureDate !== ''
        && $arrivalDate !== ''
        && strtotime($arrivalDate) <= strtotime($departureDate)
    ) {
        $errors[] = 'La date d’arrivée doit être postérieure à la date de départ.';
    }

    if ($totalSeats <= 0) {
        $errors[] = 'Le nombre de places doit être supérieur à 0.';
    }

    if ($errors !== []) {
        $trip['id_agence_depart'] = $departureAgencyId;
        $trip['id_agence_arrivee'] = $arrivalAgencyId;
        $trip['date_heure_depart'] = $departureDate;
        $trip['date_heure_arrivee'] = $arrivalDate;
        $trip['nombre_places_total'] = $totalSeats;

        $agencies = $this->agencyRepository->findAll();

        require dirname(__DIR__, 2)
            . '/templates/admin/trips/edit.php';

        return;
    }

    $this->tripRepository->update(
        $tripId,
        $departureAgencyId,
        $arrivalAgencyId,
        $departureDate,
        $arrivalDate,
        $totalSeats
    );

    Session::set(
    'flash_success',
    'Le trajet a bien été modifié.'
);

    header('Location: /admin/trips');
    exit;
}

/**
 * Deletes a trip.
 */
public function delete(string $id): void
{
    Auth::requireAdmin();

    $tripId = (int) $id;
    $trip = $this->tripRepository->findById($tripId);

    if ($trip === false) {
        http_response_code(404);
        echo 'Trajet introuvable';

        return;
    }

    $this->tripRepository->delete($tripId);

    Session::set(
        'flash_success',
        'Le trajet a bien été supprimé.'
    );

    header('Location: /admin/trips');
    exit;
}
}