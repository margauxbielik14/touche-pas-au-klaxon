<?php

declare(strict_types=1);

require dirname(__DIR__) . '/layouts/header.php';

?>

<main class="container py-5 flex-grow-1">

    <div class="row justify-content-center">

        <div class="col-12 col-sm-10 col-md-7 col-lg-5">

            <h1 class="text-center mb-4">
                Connexion
            </h1>

            <?php if (isset($error)): ?>

                <div class="alert alert-danger" role="alert">
                    <?= htmlspecialchars($error) ?>
                </div>

            <?php endif; ?>

            <form method="POST" action="/login">

                <div class="mb-3">

                    <label
                        for="email"
                        class="form-label"
                    >
                        Adresse email
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        required
                    >

                </div>

                <div class="mb-4">

                    <label
                        for="password"
                        class="form-label"
                    >
                        Mot de passe
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        required
                    >

                </div>

                <div class="d-grid">

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Se connecter
                    </button>

                </div>

            </form>

        </div>

    </div>

</main>

<?php require dirname(__DIR__) . '/layouts/footer.php'; ?>