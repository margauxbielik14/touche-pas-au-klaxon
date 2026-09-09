<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/layouts/header.php';
?>

<main class="container py-5">

    <h1 class="mb-4">Modifier un trajet</h1>

    <?php if (!empty($errors)): ?>

    <div class="alert alert-danger">
        <ul class="mb-0">

            <?php foreach ($errors as $error): ?>
                <li>
                    <?= htmlspecialchars($error) ?>
                </li>
            <?php endforeach; ?>

        </ul>
    </div>

<?php endif; ?>

    <form
        method="POST"
        action="/admin/trips/<?= (int) $trip['id_trajet'] ?>/edit"
    >

        <div class="mb-3">
            <label for="departureAgency" class="form-label">
                Agence de départ
            </label>

            <select
                id="departureAgency"
                name="id_agence_depart"
                class="form-select"
                required
            >
                <?php foreach ($agencies as $agency): ?>
                    <option
                        value="<?= (int) $agency['id_agence'] ?>"
                        <?= (int) $agency['id_agence']
                            === (int) $trip['id_agence_depart']
                            ? 'selected'
                            : '' ?>
                    >
                        <?= htmlspecialchars((string) $agency['ville']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="arrivalAgency" class="form-label">
                Agence d'arrivée
            </label>

            <select
                id="arrivalAgency"
                name="id_agence_arrivee"
                class="form-select"
                required
            >
                <?php foreach ($agencies as $agency): ?>
                    <option
                        value="<?= (int) $agency['id_agence'] ?>"
                        <?= (int) $agency['id_agence']
                            === (int) $trip['id_agence_arrivee']
                            ? 'selected'
                            : '' ?>
                    >
                        <?= htmlspecialchars((string) $agency['ville']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="departureDate" class="form-label">
                Date et heure de départ
            </label>

            <input
                type="datetime-local"
                id="departureDate"
                name="date_heure_depart"
                class="form-control"
                value="<?= htmlspecialchars(
                    date(
                        'Y-m-d\TH:i',
                        strtotime((string) $trip['date_heure_depart'])
                    )
                ) ?>"
                required
            >
        </div>

        <div class="mb-3">
            <label for="arrivalDate" class="form-label">
                Date et heure d'arrivée
            </label>

            <input
                type="datetime-local"
                id="arrivalDate"
                name="date_heure_arrivee"
                class="form-control"
                value="<?= htmlspecialchars(
                    date(
                        'Y-m-d\TH:i',
                        strtotime((string) $trip['date_heure_arrivee'])
                    )
                ) ?>"
                required
            >
        </div>

        <div class="mb-3">
            <label for="seats" class="form-label">
                Nombre de places
            </label>

            <input
                type="number"
                id="seats"
                name="nombre_places_total"
                class="form-control"
                min="1"
                value="<?= (int) $trip['nombre_places_total'] ?>"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Enregistrer les modifications
        </button>

        <a href="/admin/trips" class="btn btn-secondary">
            Annuler
        </a>

    </form>

</main>

<?php require dirname(__DIR__, 2) . '/layouts/footer.php'; ?>