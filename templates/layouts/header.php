<?php

declare(strict_types=1);

use App\Core\Auth;

$user = Auth::user();
?>

<header>
    <nav>
        <a href="/">Touche pas au klaxon</a>

        <?php if ($user === null): ?>

            <a href="/login">Connexion</a>

        <?php elseif (Auth::isAdmin()): ?>

            <a href="/admin/users">Utilisateurs</a>
            <a href="/admin/agencies">Agences</a>
            <a href="/admin/trips">Trajets</a>

            <span>
                Bonjour
                <?= htmlspecialchars((string) $user['prenom']) ?>
                <?= htmlspecialchars((string) $user['nom']) ?>
            </span>

            <a href="/logout">Déconnexion</a>

        <?php else: ?>

            <a href="/trips/create">Créer un trajet</a>

            <span>
                Bonjour
                <?= htmlspecialchars((string) $user['prenom']) ?>
                <?= htmlspecialchars((string) $user['nom']) ?>
            </span>

            <a href="/logout">Déconnexion</a>

        <?php endif; ?>
    </nav>
</header>