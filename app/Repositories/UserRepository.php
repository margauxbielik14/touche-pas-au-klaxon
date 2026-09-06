<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

/**
 * Handles database operations related to users.
 */
class UserRepository
{
    public function __construct(
        private PDO $connection
    ) {
    }

    /**
     * Finds a user by email address.
     *
     * @return array<string, mixed>|false
     */
    public function findByEmail(string $email): array|false
    {
        $sql = '
            SELECT
                id_employe,
                nom,
                prenom,
                email,
                telephone,
                mot_de_passe,
                role
            FROM employe
            WHERE email = :email
            LIMIT 1
        ';

        $statement = $this->connection->prepare($sql);

        $statement->execute([
            'email' => $email,
        ]);

        return $statement->fetch();
    }

    /**
 * Returns all employees.
 *
 * @return array<int, array<string, mixed>>
 */
public function findAll(): array
{
    $sql = '
        SELECT
            id_employe,
            nom,
            prenom,
            email,
            telephone,
            role
        FROM employe
        ORDER BY nom ASC, prenom ASC
    ';

    $statement = $this->connection->query($sql);

    return $statement->fetchAll();
}
}