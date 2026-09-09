<?php

declare(strict_types=1);

require dirname(__DIR__, 2) . '/layouts/header.php';
?>

<main class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Agences</h1>

        <a
            href="/admin/agencies/create"
            class="btn btn-primary"
        >
            Ajouter une agence
        </a>
    </div>

    <?php if (!empty($flashSuccess)): ?>
    <div class="alert alert-success">
        <?= htmlspecialchars((string) $flashSuccess) ?>
    </div>
<?php endif; ?>

<?php if (!empty($flashError)): ?>
    <div class="alert alert-danger">
        <?= htmlspecialchars((string) $flashError) ?>
    </div>
<?php endif; ?>

    <?php if (empty($agencies)): ?>

        <p>Aucune agence disponible.</p>

    <?php else: ?>

        <div class="table-responsive">

            <table class="table table-striped align-middle">

                <thead>
                    <tr>
                        <th>Ville</th>
                        <th>Actions</th>
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

                            <td>
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
                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php endif; ?>

</main>

<?php require dirname(__DIR__, 2) . '/layouts/footer.php'; ?>