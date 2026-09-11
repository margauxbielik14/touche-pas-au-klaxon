<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/layouts/header.php';

?>

<main class="container py-5 flex-grow-1">

    <div class="row justify-content-center">

        <div class="col-12 col-md-8 col-lg-6">

            <h1 class="text-center mb-4">
                Modifier une agence
            </h1>

            <?php if (!empty($errors)): ?>

                <div class="alert alert-danger" role="alert">

                    <strong>
                        L'agence n'a pas pu être modifiée :
                    </strong>

                    <ul class="mb-0 mt-2">

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
                action="/admin/agencies/<?= (int) $agency['id_agence'] ?>/edit"
            >

                <div class="mb-4">

                    <label
                        for="ville"
                        class="form-label"
                    >
                        Ville
                    </label>

                    <input
                        type="text"
                        id="ville"
                        name="ville"
                        class="form-control"
                        maxlength="100"
                        value="<?= htmlspecialchars((string) $agency['ville']) ?>"
                        required
                    >

                </div>

                <div class="d-flex justify-content-center gap-2">

                    <a
                        href="/admin/agencies"
                        class="btn btn-outline-secondary"
                    >
                        Annuler
                    </a>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Enregistrer les modifications
                    </button>

                </div>

            </form>

        </div>

    </div>

</main>

<?php require dirname(__DIR__, 2) . '/layouts/footer.php'; ?>