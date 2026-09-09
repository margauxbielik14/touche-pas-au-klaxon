<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Core\Auth;
use App\Repositories\AgencyRepository;
use App\Core\Session;

/**
 * Handles agency administration.
 */
class AdminAgencyController
{
    public function __construct(
        private AgencyRepository $agencyRepository
    ) {
    }

    /**
     * Displays all agencies.
     */
    public function index(): void
    {
        Auth::requireAdmin();

        $agencies = $this->agencyRepository->findAll();

        $flashSuccess = Session::get('flash_success');
$flashError = Session::get('flash_error');

Session::remove('flash_success');
Session::remove('flash_error');

        require dirname(__DIR__, 2)
            . '/templates/admin/agencies/index.php';
    }

    /**
 * Displays the agency creation form.
 */
public function create(): void
{
    Auth::requireAdmin();

    require dirname(__DIR__, 2)
        . '/templates/admin/agencies/create.php';
}

/**
 * Validates and creates a new agency.
 */
public function store(): void
{
    Auth::requireAdmin();

    $city = trim($_POST['ville'] ?? '');

    $errors = [];

    if ($city === '') {
        $errors[] = 'La ville est obligatoire.';
    }

    if (mb_strlen($city) > 100) {
        $errors[] = 'Le nom de la ville ne peut pas dépasser 100 caractères.';
    }

    if (
    $city !== ''
    && $this->agencyRepository->findByCity($city) !== false
) {
    $errors[] = 'Une agence existe déjà dans cette ville.';
}

    if ($errors !== []) {
        require dirname(__DIR__, 2)
            . '/templates/admin/agencies/create.php';

        return;
    }

    $this->agencyRepository->create($city);

Session::set(
    'flash_success',
    'L’agence a bien été ajoutée.'
);

header('Location: /admin/agencies');
exit;
}

/**
 * Displays the agency editing form.
 */
public function edit(string $id): void
{
    Auth::requireAdmin();

    $agency = $this->agencyRepository->findById((int) $id);

    if ($agency === false) {
        http_response_code(404);
        echo 'Agence introuvable';

        return;
    }

    require dirname(__DIR__, 2)
        . '/templates/admin/agencies/edit.php';
}

/**
 * Validates and updates an agency.
 */
public function update(string $id): void
{
    Auth::requireAdmin();

    $agencyId = (int) $id;
    $agency = $this->agencyRepository->findById($agencyId);

    if ($agency === false) {
        http_response_code(404);
        echo 'Agence introuvable';

        return;
    }

    $city = trim($_POST['ville'] ?? '');
    $errors = [];

    if ($city === '') {
        $errors[] = 'La ville est obligatoire.';
    }

    if (mb_strlen($city) > 100) {
        $errors[] = 'Le nom de la ville ne peut pas dépasser 100 caractères.';
    }

    $existingAgency = $city !== ''
        ? $this->agencyRepository->findByCity($city)
        : false;

    if (
        $existingAgency !== false
        && (int) $existingAgency['id_agence'] !== $agencyId
    ) {
        $errors[] = 'Une agence existe déjà dans cette ville.';
    }

    if ($errors !== []) {
        $agency['ville'] = $city;

        require dirname(__DIR__, 2)
            . '/templates/admin/agencies/edit.php';

        return;
    }

    $this->agencyRepository->update(
        $agencyId,
        $city
    );

    Session::set(
    'flash_success',
    'L’agence a bien été modifiée.'
);

    header('Location: /admin/agencies');
    exit;
}

/**
 * Deletes an agency when it is not associated with a trip.
 */
public function delete(string $id): void
{
    Auth::requireAdmin();

    $agencyId = (int) $id;
    $agency = $this->agencyRepository->findById($agencyId);

    if ($agency === false) {
        http_response_code(404);
        echo 'Agence introuvable';

        return;
    }

    if ($this->agencyRepository->isUsedByTrip($agencyId)) {
        Session::set(
            'flash_error',
            'Cette agence ne peut pas être supprimée car elle est utilisée par un trajet.'
        );

        header('Location: /admin/agencies');
        exit;
    }

    $this->agencyRepository->delete($agencyId);

    Session::set(
        'flash_success',
        'L’agence a bien été supprimée.'
    );

    header('Location: /admin/agencies');
    exit;
}
}