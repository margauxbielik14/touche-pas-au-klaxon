<?php

declare(strict_types=1);

use App\Core\Auth;

$user = Auth::user();

$homeUrl = Auth::isAdmin() ? '/admin' : '/';

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Touche pas au klaxon</title>

    <link rel="stylesheet" href="/assets/css/main.css">
</head>

<body class="d-flex flex-column min-vh-100">

<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">

            <a class="navbar-brand fw-bold" href="<?= $homeUrl ?>">
                Touche pas au klaxon
            </a>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#mainNavbar"
                aria-controls="mainNavbar"
                aria-expanded="false"
                aria-label="Afficher le menu"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div
                class="collapse navbar-collapse"
                id="mainNavbar"
            >
                <div class="navbar-nav ms-auto align-items-lg-center gap-lg-2">

                    <?php if ($user === null): ?>

                        <a
                            class="nav-link"
                            href="/login"
                        >
                            Connexion
                        </a>

                    <?php elseif (Auth::isAdmin()): ?>

                        <a
                        class="nav-link"
                        href="/admin"
                        >
                        Tableau de bord
                        </a>

                        <a
                            class="nav-link"
                            href="/admin/users"
                        >
                            Utilisateurs
                        </a>

                        <a
                            class="nav-link"
                            href="/admin/agencies"
                        >
                            Agences
                        </a>

                        <a
                            class="nav-link"
                            href="/admin/trips"
                        >
                            Trajets
                        </a>

                        <span class="navbar-text text-white">
                            Bonjour
                            <?= htmlspecialchars((string) $user['prenom']) ?>
                            <?= htmlspecialchars((string) $user['nom']) ?>
                        </span>

                        <a
                            class="nav-link"
                            href="/logout"
                        >
                            Déconnexion
                        </a>

                    <?php else: ?>

                        <a
                            class="nav-link"
                            href="/trips/create"
                        >
                            Créer un trajet
                        </a>

                        <span class="navbar-text text-white">
                            Bonjour
                            <?= htmlspecialchars((string) $user['prenom']) ?>
                            <?= htmlspecialchars((string) $user['nom']) ?>
                        </span>

                        <a
                            class="nav-link"
                            href="/logout"
                        >
                            Déconnexion
                        </a>

                    <?php endif; ?>

                </div>
            </div>

        </div>
    </nav>
</header>