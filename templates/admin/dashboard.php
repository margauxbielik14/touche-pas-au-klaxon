<?php

declare(strict_types=1);

require dirname(__DIR__) . '/layouts/header.php';

?>

<main class="container py-5 flex-grow-1">

    <div class="text-center mb-5">

        <h1 class="mb-3">
            Tableau de bord administrateur
        </h1>

        <p class="text-muted mb-0">
            Bienvenue dans l'espace d'administration de Touche pas au klaxon.
        </p>

    </div>

    <div class="row g-4 justify-content-center">

        <div class="col-12 col-md-6 col-lg-4">

            <div class="card h-100 shadow-sm">

                <div class="card-body d-flex flex-column">

                    <h2 class="card-title h5">
                        Utilisateurs
                    </h2>

                    <p class="card-text text-muted">
                        Consulter la liste des employés enregistrés
                        dans l'application.
                    </p>

                    <a
                        href="/admin/users"
                        class="btn btn-primary mt-auto"
                    >
                        Voir les utilisateurs
                    </a>

                </div>

            </div>

        </div>

        <div class="col-12 col-md-6 col-lg-4">

            <div class="card h-100 shadow-sm">

                <div class="card-body d-flex flex-column">

                    <h2 class="card-title h5">
                        Agences
                    </h2>

                    <p class="card-text text-muted">
                        Ajouter, modifier ou supprimer les agences
                        de l'entreprise.
                    </p>

                    <a
                        href="/admin/agencies"
                        class="btn btn-primary mt-auto"
                    >
                        Gérer les agences
                    </a>

                </div>

            </div>

        </div>

        <div class="col-12 col-md-6 col-lg-4">

            <div class="card h-100 shadow-sm">

                <div class="card-body d-flex flex-column">

                    <h2 class="card-title h5">
                        Trajets
                    </h2>

                    <p class="card-text text-muted">
                        Consulter, modifier et supprimer les trajets
                        proposés.
                    </p>

                    <a
                        href="/admin/trips"
                        class="btn btn-primary mt-auto"
                    >
                        Gérer les trajets
                    </a>

                </div>

            </div>

        </div>

    </div>

</main>

<?php require dirname(__DIR__) . '/layouts/footer.php'; ?>