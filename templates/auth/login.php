<?php

declare(strict_types=1);
?>

<h1>Connexion</h1>

<?php if (isset($error)): ?>
    <p><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="POST" action="/login">

    <div>
        <label for="email">Adresse email</label>

        <input
            type="email"
            id="email"
            name="email"
            required
        >
    </div>

    <div>
        <label for="password">Mot de passe</label>

        <input
            type="password"
            id="password"
            name="password"
            required
        >
    </div>

    <button type="submit">
        Se connecter
    </button>

</form>