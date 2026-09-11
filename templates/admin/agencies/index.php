<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/layouts/header.php';

?>

<main class="container py-5 flex-grow-1">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="mb-1">
                Agences
            </h1>

            <p class="text-muted mb-0">
                Gérer les agences disponibles pour les trajets.
            </p>
        </div>

        <a
            href="/admin/agencies/create"
            class="btn btn-primary"
        >
            Ajouter une agence
        </a>

    </div>

    <?php if (!empty($flashSuccess)): ?>

        <div class="alert alert-success" role="alert">
            <?= htmlspecialchars((string) $flashSuccess) ?>
        </div>

    <?php endif; ?>

    <?php if (!empty($flashError)): ?>

        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars((string) $flashError) ?>
        </div>

    <?php endif; ?>

    <?php if (empty($agencies)): ?>

        <div class="alert alert-info" role="alert">
            Aucune agence disponible.
        </div>

    <?php else: ?>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>
                        <th>Ville</th>
                        <th class="text-end">Actions</th>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($agencies as $agency): ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars(
                                    (string) $agency['ville']
                                ) ?>
                            </td>

                            <td class="text-end">

                                <div class="d-flex justify-content-end gap-2">

                                    <a
                                        href="/admin/agencies/<?= (int) $agency['id_agence'] ?>/edit"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        Modifier
                                    </a>

                                    <form
                                        method="POST"
                                        action="/admin/agencies/<?= (int) $agency['id_agence'] ?>/delete"
                                        class="d-inline"
                                    >

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                        >
                                            Supprimer
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php endif; ?>

</main>

<?php require dirname(__DIR__, 2) . '/layouts/footer.php'; ?>