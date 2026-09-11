<?php

declare(strict_types=1);

require dirname(__DIR__) . '/layouts/header.php';

?>

<main class="container py-5 flex-grow-1">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h1 class="mb-1">
                Utilisateurs
            </h1>

            <p class="text-muted mb-0">
                Liste des employés enregistrés dans l'application.
            </p>
        </div>

    </div>

    <?php if (empty($users)): ?>

        <div class="alert alert-info" role="alert">
            Aucun utilisateur disponible.
        </div>

    <?php else: ?>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">

                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Rôle</th>
                    </tr>

                </thead>

                <tbody>

                    <?php foreach ($users as $employee): ?>

                        <tr>

                            <td>
                                <?= htmlspecialchars(
                                    (string) $employee['nom']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    (string) $employee['prenom']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    (string) $employee['email']
                                ) ?>
                            </td>

                            <td>
                                <?= htmlspecialchars(
                                    (string) $employee['telephone']
                                ) ?>
                            </td>

                            <td>
                                <span class="badge text-bg-secondary">
                                    <?= htmlspecialchars(
                                        (string) $employee['role']
                                    ) ?>
                                </span>
                            </td>

                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php endif; ?>

</main>

<?php require dirname(__DIR__) . '/layouts/footer.php'; ?>