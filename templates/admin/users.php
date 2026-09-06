<?php

declare(strict_types=1);

require dirname(__DIR__) . '/layouts/header.php';
?>

<main class="container py-5">

    <h1 class="mb-4">Utilisateurs</h1>

    <?php if (empty($users)): ?>

        <p>Aucun utilisateur disponible.</p>

    <?php else: ?>

        <div class="table-responsive">

            <table class="table table-striped align-middle">

                <thead>
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
                                <?= htmlspecialchars(
                                    (string) $employee['role']
                                ) ?>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    <?php endif; ?>

</main>

<?php require dirname(__DIR__) . '/layouts/footer.php'; ?>