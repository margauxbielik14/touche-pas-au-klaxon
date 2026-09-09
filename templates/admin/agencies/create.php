<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/layouts/header.php';
?>

<main class="container py-5">

    <h1 class="mb-4">Ajouter une agence</h1>

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

    <form method="POST" action="/admin/agencies/create">

        <div class="mb-3">
            <label for="ville" class="form-label">
                Ville
            </label>

            <input
                type="text"
                id="ville"
                name="ville"
                class="form-control"
                maxlength="100"
                value="<?= htmlspecialchars($city ?? '') ?>"
                required
            >
        </div>

        <button type="submit" class="btn btn-primary">
            Ajouter l'agence
        </button>

        <a
            href="/admin/agencies"
            class="btn btn-secondary"
        >
            Annuler
        </a>

    </form>

</main>

<?php require dirname(__DIR__, 2) . '/layouts/footer.php'; ?>