<?php

declare(strict_types=1);

use App\Core\Csrf;

require dirname(__DIR__) . '/layouts/header.php';

?>

<main class="container py-5 flex-grow-1">

    <div class="row justify-content-center">

        <div class="col-12 col-lg-8">

            <h1 class="text-center mb-4">
                Modifier le trajet
            </h1>

            <?php if (!empty($errors)): ?>

                <div class="alert alert-danger" role="alert">

                    <strong>
                        Le trajet n'a pas pu être modifié :
                    </strong>

                    <ul class="mb-0 mt-2">

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
                action="/trips/<?= (int) $trip['id_trajet'] ?>/edit"
            >

            <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars(Csrf::token()) ?>"
            >

                <fieldset class="border rounded p-4 mb-4">

                    <legend class="float-none w-auto px-2 fs-5">
                        Trajet
                    </legend>

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label
                                for="agence_depart"
                                class="form-label"
                            >
                                Agence de départ
                            </label>

                            <select
                                id="agence_depart"
                                name="agence_depart"
                                class="form-select"
                                required
                            >

                                <?php foreach ($agencies as $agency): ?>

                                    <option
                                        value="<?= (int) $agency['id_agence'] ?>"
                                        <?php if (
                                            (int) $agency['id_agence']
                                            === (int) $trip['id_agence_depart']
                                        ): ?>
                                            selected
                                        <?php endif; ?>
                                    >
                                        <?= htmlspecialchars((string) $agency['ville']) ?>
                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <div class="col-md-6">

                            <label
                                for="date_heure_depart"
                                class="form-label"
                            >
                                Date et heure de départ
                            </label>

                            <input
                                type="datetime-local"
                                id="date_heure_depart"
                                name="date_heure_depart"
                                class="form-control"
                                value="<?= htmlspecialchars(
                                    date(
                                        'Y-m-d\TH:i',
                                        strtotime(
                                            (string) $trip['date_heure_depart']
                                        )
                                    )
                                ) ?>"
                                required
                            >

                        </div>

                        <div class="col-md-6">

                            <label
                                for="agence_arrivee"
                                class="form-label"
                            >
                                Agence d'arrivée
                            </label>

                            <select
                                id="agence_arrivee"
                                name="agence_arrivee"
                                class="form-select"
                                required
                            >

                                <?php foreach ($agencies as $agency): ?>

                                    <option
                                        value="<?= (int) $agency['id_agence'] ?>"
                                        <?php if (
                                            (int) $agency['id_agence']
                                            === (int) $trip['id_agence_arrivee']
                                        ): ?>
                                            selected
                                        <?php endif; ?>
                                    >
                                        <?= htmlspecialchars((string) $agency['ville']) ?>
                                    </option>

                                <?php endforeach; ?>

                            </select>

                        </div>

                        <div class="col-md-6">

                            <label
                                for="date_heure_arrivee"
                                class="form-label"
                            >
                                Date et heure d'arrivée
                            </label>

                            <input
                                type="datetime-local"
                                id="date_heure_arrivee"
                                name="date_heure_arrivee"
                                class="form-control"
                                value="<?= htmlspecialchars(
                                    date(
                                        'Y-m-d\TH:i',
                                        strtotime(
                                            (string) $trip['date_heure_arrivee']
                                        )
                                    )
                                ) ?>"
                                required
                            >

                        </div>

                        <div class="col-md-6">

                            <label
                                for="nombre_places"
                                class="form-label"
                            >
                                Nombre de places
                            </label>

                            <input
                                type="number"
                                id="nombre_places"
                                name="nombre_places"
                                class="form-control"
                                min="1"
                                value="<?= (int) $trip['nombre_places_total'] ?>"
                                required
                            >

                        </div>

                    </div>

                </fieldset>

                <div class="d-flex justify-content-center gap-2">

                    <a
                        href="/"
                        class="btn btn-outline-secondary"
                    >
                        Annuler
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Enregistrer les modifications
                    </button>

                </div>

            </form>

        </div>

    </div>

</main>

<?php require dirname(__DIR__) . '/layouts/footer.php'; ?>