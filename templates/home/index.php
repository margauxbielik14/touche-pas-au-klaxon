<?php

declare(strict_types=1);
?>

<h1>Touche pas au klaxon</h1>

<h2>Trajets disponibles</h2>

<?php if (empty($trips)): ?>

    <p>Aucun trajet disponible.</p>

<?php else: ?>

    <?php foreach ($trips as $trip): ?>

        <div>
            <strong>
                <?= htmlspecialchars((string) $trip['agence_depart']) ?>
                →
                <?= htmlspecialchars((string) $trip['agence_arrivee']) ?>
            </strong>

            <p>
                Départ :
                <?= htmlspecialchars((string) $trip['date_heure_depart']) ?>
            </p>

            <p>
                Arrivée :
                <?= htmlspecialchars((string) $trip['date_heure_arrivee']) ?>
            </p>

            <p>
                Places disponibles :
                <?= (int) $trip['nombre_places_disponibles'] ?>
            </p>
        </div>

        <hr>

    <?php endforeach; ?>

<?php endif; ?>