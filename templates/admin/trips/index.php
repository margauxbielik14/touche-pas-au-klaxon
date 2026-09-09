<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/layouts/header.php';
?>

<main class="container py-5">

    <h1 class="mb-4">Trajets</h1>

    <?php if (!empty($flashSuccess)): ?>

    <div class="alert alert-success">
        <?= htmlspecialchars((string) $flashSuccess) ?>
    </div>

<?php endif; ?>

    <?php if (empty($trips)): ?>

        <p>Aucun trajet disponible.</p>

    <?php else: ?>

        <div class="table-responsive">

            <table class="table table-striped align-middle">

                <thead>
                    <tr>
                        <th>Conducteur</th>
                        <th>Départ</th>
                        <th>Arrivée</th>
                        <th>Date de départ</th>
                        <th>Date d'arrivée</th>
                        <th>Places</th>
                        <th>Disponibles</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                    <?php foreach ($trips as $trip): ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars(
                                    $trip['conducteur_prenom']
                                    . ' '
                                    . $trip['conducteur_nom']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    (string) $trip['agence_depart']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    (string) $trip['agence_arrivee']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    (string) $trip['date_heure_depart']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    (string) $trip['date_heure_arrivee']
                                ) ?>
                            </td>

                            <td>
                                <?= (int) $trip['nombre_places_total'] ?>
                            </td>

                            <td>
                                <?= (int) $trip['nombre_places_disponibles'] ?>
                            </td>

                            <td>
                                <a
                                    href="/admin/trips/<?= (int) $trip['id_trajet'] ?>/edit"
                                    class="btn btn-sm btn-outline-primary"
                                >
                                    Modifier
                                </a>

                                <form
                                    method="POST"
                                    action="/admin/trips/<?= (int) $trip['id_trajet'] ?>/delete"
                                    class="d-inline"
                                >
                                    <button
                                        type="submit"
                                        class="btn btn-sm btn-outline-danger"
                                    >
                                        Supprimer
                                    </button>
                                </form>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php endif; ?>

</main>

<?php require dirname(__DIR__, 2) . '/layouts/footer.php'; ?>