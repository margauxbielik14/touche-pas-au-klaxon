<?php

declare(strict_types=1);

require dirname(__DIR__) . '/layouts/header.php';
?>

<main>
    <h1>Créer un trajet</h1>

    <?php if (!empty($errors)): ?>
    <div>
        <strong>Le trajet n'a pas pu être créé :</strong>

        <ul>
            <?php foreach ($errors as $error): ?>
                <li>
                    <?= htmlspecialchars($error) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

    <form method="POST" action="/trips/create">

        <fieldset>
            <legend>Conducteur</legend>

            <div>
                <label for="prenom">Prénom</label>
                <input
                    type="text"
                    id="prenom"
                    value="<?= htmlspecialchars((string) $user['prenom']) ?>"
                    readonly
                >
            </div>

            <div>
                <label for="nom">Nom</label>
                <input
                    type="text"
                    id="nom"
                    value="<?= htmlspecialchars((string) $user['nom']) ?>"
                    readonly
                >
            </div>

            <div>
                <label for="telephone">Téléphone</label>
                <input
                    type="text"
                    id="telephone"
                    value="<?= htmlspecialchars((string) $user['telephone']) ?>"
                    readonly
                >
            </div>
        </fieldset>

        <fieldset>
            <legend>Trajet</legend>

            <div>
                <label for="agence_depart">Agence de départ</label>

                <select
                    id="agence_depart"
                    name="agence_depart"
                    required
                >
                    <option value="">Choisir une agence</option>

                    <?php foreach ($agencies as $agency): ?>
                        <option value="<?= (int) $agency['id_agence'] ?>">
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
                    <option value="">Choisir une agence</option>

                    <?php foreach ($agencies as $agency): ?>
                        <option value="<?= (int) $agency['id_agence'] ?>">
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
                    required
                >
            </div>
        </fieldset>

        <button type="submit">
            Créer le trajet
        </button>

    </form>
</main>

<?php require dirname(__DIR__) . '/layouts/footer.php'; ?>