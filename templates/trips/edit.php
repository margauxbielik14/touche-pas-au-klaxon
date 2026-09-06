<?php

declare(strict_types=1);

require dirname(__DIR__) . '/layouts/header.php';
?>

<main>
    <h1>Modifier le trajet</h1>

    <?php if (!empty($errors)): ?>
    <div>
        <strong>Le trajet n'a pas pu être modifié :</strong>

        <ul>
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

        <div>
            <label for="agence_depart">Agence de départ</label>

            <select
                id="agence_depart"
                name="agence_depart"
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

        <div>
            <label for="date_heure_depart">
                Date et heure de départ
            </label>

            <input
                type="datetime-local"
                id="date_heure_depart"
                name="date_heure_depart"
                value="<?= htmlspecialchars(
                    date(
                        'Y-m-d\TH:i',
                        strtotime((string) $trip['date_heure_depart'])
                    )
                ) ?>"
                required
            >
        </div>

        <div>
            <label for="agence_arrivee">
                Agence d'arrivée
            </label>

            <select
                id="agence_arrivee"
                name="agence_arrivee"
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

        <div>
            <label for="date_heure_arrivee">
                Date et heure d'arrivée
            </label>

            <input
                type="datetime-local"
                id="date_heure_arrivee"
                name="date_heure_arrivee"
                value="<?= htmlspecialchars(
                    date(
                        'Y-m-d\TH:i',
                        strtotime((string) $trip['date_heure_arrivee'])
                    )
                ) ?>"
                required
            >
        </div>

        <div>
            <label for="nombre_places">
                Nombre de places
            </label>

            <input
                type="number"
                id="nombre_places"
                name="nombre_places"
                min="1"
                value="<?= (int) $trip['nombre_places_total'] ?>"
                required
            >
        </div>

        <button type="submit">
            Enregistrer les modifications
        </button>

    </form>
</main>

<?php require dirname(__DIR__) . '/layouts/footer.php'; ?>