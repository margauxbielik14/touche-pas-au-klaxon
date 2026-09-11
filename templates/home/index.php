<?php

declare(strict_types=1);

require dirname(__DIR__) . '/layouts/header.php';
?>

<main class="container py-5 flex-grow-1">

    <?php if (!empty($flashSuccess)): ?>
        <div>
            <?= htmlspecialchars((string) $flashSuccess) ?>
        </div>
    <?php endif; ?>

    <?php if ($user === null): ?>

    <div class="text-center mb-4">
    <h1 class="mb-3">Trajets proposés</h1>

    <p class="text-muted">
        Pour obtenir plus d'informations sur un trajet,
        veuillez vous connecter.
    </p>
</div>

<?php else: ?>

    <h1 class="text-center mb-4">Trajets proposés</h1>

<?php endif; ?>

<?php if (empty($trips)): ?>

    <p>Aucun trajet disponible.</p>

<?php else: ?>

        <div class="table-responsive">
    <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>Départ</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Destination</th>
                    <th>Date</th>
                    <th>Heure</th>
                    <th>Places</th>

                    <?php if ($user !== null): ?>
                        <th>Actions</th>
                    <?php endif; ?>
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
                            <?= htmlspecialchars((string) $trip['agence_depart']) ?>
                        </td>

                        <td><?= $departure->format('d/m/y') ?></td>
                        <td><?= $departure->format('H:i') ?></td>

                        <td>
                            <?= htmlspecialchars((string) $trip['agence_arrivee']) ?>
                        </td>

                        <td><?= $arrival->format('d/m/y') ?></td>
                        <td><?= $arrival->format('H:i') ?></td>

                        <td>
                            <?= (int) $trip['nombre_places_disponibles'] ?>
                        </td>

                        <?php if ($user !== null): ?>

    <td>
        <div class="d-flex align-items-center gap-2">

            <button
                type="button"
                class="btn btn-sm btn-outline-primary"
                data-bs-toggle="modal"
                data-bs-target="#tripModal<?= (int) $trip['id_trajet'] ?>"
                title="Voir les détails"
                aria-label="Voir les détails"
            >
                👁
            </button>

            <?php if ((int) $trip['id_employe'] === (int) $user['id']): ?>

                <a
                    href="/trips/<?= (int) $trip['id_trajet'] ?>/edit"
                    class="btn btn-sm btn-outline-primary"
                    title="Modifier"
                    aria-label="Modifier"
                >
                    ✏️
                </a>

                <form
                    method="POST"
                    action="/trips/<?= (int) $trip['id_trajet'] ?>/delete"
                    class="d-inline"
                >
                    <button
                        type="submit"
                        class="btn btn-sm btn-outline-danger"
                        title="Supprimer"
                        aria-label="Supprimer"
                    >
                        🗑️
                    </button>
                </form>

            <?php endif; ?>

        </div>
    </td>

<?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        </div>

        <?php if ($user !== null): ?>

    <?php foreach ($trips as $trip): ?>

        <div
            class="modal fade"
            id="tripModal<?= (int) $trip['id_trajet'] ?>"
            tabindex="-1"
            aria-labelledby="tripModalLabel<?= (int) $trip['id_trajet'] ?>"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">

                        <h2
                            class="modal-title fs-5"
                            id="tripModalLabel<?= (int) $trip['id_trajet'] ?>"
                        >
                            Détails de l'utilisateur
                        </h2>

                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Fermer"
                        ></button>

                    </div>

                    <div class="modal-body">

                        <p>
                            <strong>Nom Prénom :</strong>
                            <?= htmlspecialchars(
                                (string) $trip['conducteur_nom']
                                . ' '
                                . (string) $trip['conducteur_prenom']
                            ) ?>
                        </p>

                        <p>
                            <strong>Téléphone :</strong>
                            <?= htmlspecialchars(
                                (string) $trip['conducteur_telephone']
                            ) ?>
                        </p>

                        <p>
                            <strong>Email :</strong>
                            <?= htmlspecialchars(
                                (string) $trip['conducteur_email']
                            ) ?>
                        </p>

                        <p>
                            <strong>Nombre de places :</strong>
                            <?= (int) $trip['nombre_places_total'] ?>
                        </p>

                    </div>

                </div>
            </div>
        </div>

    <?php endforeach; ?>

<?php endif; ?>

    <?php endif; ?>

</main>

<?php require dirname(__DIR__) . '/layouts/footer.php'; ?>