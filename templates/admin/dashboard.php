<?php

declare(strict_types=1);

require dirname(__DIR__) . '/layouts/header.php';
?>

<main class="container py-5">

    <h1 class="mb-4">Tableau de bord administrateur</h1>

    <p>
        Bienvenue dans l'espace d'administration de Touche pas au klaxon.
    </p>

    <div class="d-flex gap-3 flex-wrap mt-4">

        <a
            href="/admin/users"
            class="btn btn-primary"
        >
            Utilisateurs
        </a>

        <a
            href="/admin/agencies"
            class="btn btn-primary"
        >
            Agences
        </a>

        <a
            href="/admin/trips"
            class="btn btn-primary"
        >
            Trajets
        </a>

    </div>

</main>

<?php require dirname(__DIR__) . '/layouts/footer.php'; ?>