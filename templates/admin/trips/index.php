<?php

declare(strict_types=1);

use App\Core\Csrf;

require dirname(__DIR__, 2) . '/layouts/header.php';

?>

<main class="container py-5 flex-grow-1">

    <div class="mb-4">

        <h1 class="mb-1">
            Trajets
        </h1>

        <p class="text-muted mb-0">
            Gérer l'ensemble des trajets proposés dans l'application.
        </p>

    </div>

    <?php if (!empty($flashSuccess)): ?>

        <div class="alert alert-success" role="alert">
            <?= htmlspecialchars((string) $flashSuccess) ?>
        </div>

    <?php endif; ?>

    <?php if (empty($trips)): ?>

        <div class="alert alert-info" role="alert">
            Aucun trajet disponible.
        </div>

    <?php else: ?>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>
                        <th>Conducteur</th>
                        <th>Départ</th>
                        <th>Arrivée</th>
                        <th>Date de départ</th>
                        <th>Date d'arrivée</th>
                        <th>Places</th>
                        <th>Disponibles</th>
                        <th class="text-end">Actions</th>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($trips as $trip): ?>

                        <?php

                        $departure = new DateTime(
                            (string) $trip['date_heure_depart']
                        );

                        $arrival = new DateTime(
                            (string) $trip['date_heure_arrivee']
                        );

                        ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars(
                                    (string) $trip['conducteur_prenom']
                                    . ' '
                                    . (string) $trip['conducteur_nom']
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
                                <?= $departure->format('d/m/Y H:i') ?>
                            </td>

                            <td>
                                <?= $arrival->format('d/m/Y H:i') ?>
                            </td>

                            <td>
                                <?= (int) $trip['nombre_places_total'] ?>
                            </td>

                            <td>
                                <?= (int) $trip['nombre_places_disponibles'] ?>
                            </td>

                            <td class="text-end">

                                <div class="d-flex justify-content-end gap-2">

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

                                    <input
                                    type="hidden"
                                    name="csrf_token"
                                    value="<?= htmlspecialchars(Csrf::token()) ?>"
                                    >

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                        >
                                            Supprimer
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php endif; ?>

</main>

<?php require dirname(__DIR__, 2) . '/layouts/footer.php'; ?>