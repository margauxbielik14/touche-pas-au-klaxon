<?php

declare(strict_types=1);

require dirname(__DIR__) . '/layouts/header.php';

?>

<main class="container py-5 flex-grow-1">

    <div class="row justify-content-center">

        <div class="col-12 col-lg-8">

            <h1 class="text-center mb-4">
                Créer un trajet
            </h1>

            <?php if (!empty($errors)): ?>

                <div class="alert alert-danger" role="alert">

                    <strong>
                        Le trajet n'a pas pu être créé :
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

            <form method="POST" action="/trips/create">

                <fieldset class="border rounded p-4 mb-4">

                    <legend class="float-none w-auto px-2 fs-5">
                        Conducteur
                    </legend>

                    <div class="row g-3">

                        <div class="col-md-6">

                            <label
                                for="prenom"
                                class="form-label"
                            >
                                Prénom
                            </label>

                            <input
                                type="text"
                                id="prenom"
                                class="form-control"
                                value="<?= htmlspecialchars((string) $user['prenom']) ?>"
                                readonly
                            >

                        </div>

                        <div class="col-md-6">

                            <label
                                for="nom"
                                class="form-label"
                            >
                                Nom
                            </label>

                            <input
                                type="text"
                                id="nom"
                                class="form-control"
                                value="<?= htmlspecialchars((string) $user['nom']) ?>"
                                readonly
                            >

                        </div>

                        <div class="col-12">

                            <label
                                for="telephone"
                                class="form-label"
                            >
                                Téléphone
                            </label>

                            <input
                                type="text"
                                id="telephone"
                                class="form-control"
                                value="<?= htmlspecialchars((string) $user['telephone']) ?>"
                                readonly
                            >

                        </div>

                    </div>

                </fieldset>

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

                                <option value="">
                                    Choisir une agence
                                </option>

                                <?php foreach ($agencies as $agency): ?>

                                    <option value="<?= (int) $agency['id_agence'] ?>">
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

                                <option value="">
                                    Choisir une agence
                                </option>

                                <?php foreach ($agencies as $agency): ?>

                                    <option value="<?= (int) $agency['id_agence'] ?>">
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
                                required
                            >

                        </div>

                    </div>

                </fieldset>

                <div class="d-flex justify-content-center">

                    <button
                        type="submit"
                        class="btn btn-primary px-4"
                    >
                        Créer le trajet
                    </button>

                </div>

            </form>

        </div>

    </div>

</main>

<?php require dirname(__DIR__) . '/layouts/footer.php'; ?>