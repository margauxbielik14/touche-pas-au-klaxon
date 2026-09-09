<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

/**
 * Handles database operations related to agencies.
 */
class AgencyRepository
{
    public function __construct(
        private PDO $connection
    ) {
    }

    /**
     * Returns all agencies ordered alphabetically by city.
     *
     * @return array<int, array<string, mixed>>
     */
    public function findAll(): array
    {
        $sql = '
            SELECT
                id_agence,
                ville
            FROM agence
            ORDER BY ville ASC
        ';

        $statement = $this->connection->query($sql);

        return $statement->fetchAll();
    }

    /**
 * Finds an agency by its identifier.
 *
 * @return array<string, mixed>|false
 */
public function findById(int $agencyId): array|false
{
    $sql = '
        SELECT id_agence, ville
        FROM agence
        WHERE id_agence = :id
        LIMIT 1
    ';

    $statement = $this->connection->prepare($sql);

    $statement->execute([
        'id' => $agencyId,
    ]);

    return $statement->fetch();
}

/**
 * Creates a new agency.
 */
public function create(string $city): bool
{
    $sql = '
        INSERT INTO agence (ville)
        VALUES (:ville)
    ';

    $statement = $this->connection->prepare($sql);

    return $statement->execute([
        'ville' => $city,
    ]);
}

/**
 * Finds an agency by its city.
 *
 * @return array<string, mixed>|false
 */
public function findByCity(string $city): array|false
{
    $sql = '
        SELECT id_agence, ville
        FROM agence
        WHERE ville = :ville
        LIMIT 1
    ';

    $statement = $this->connection->prepare($sql);

    $statement->execute([
        'ville' => $city,
    ]);

    return $statement->fetch();
}

/**
 * Updates an existing agency.
 */
public function update(int $agencyId, string $city): bool
{
    $sql = '
        UPDATE agence
        SET ville = :ville
        WHERE id_agence = :id
    ';

    $statement = $this->connection->prepare($sql);

    return $statement->execute([
        'ville' => $city,
        'id' => $agencyId,
    ]);
}

/**
 * Checks whether an agency is used by at least one trip.
 */
public function isUsedByTrip(int $agencyId): bool
{
    $sql = '
        SELECT COUNT(*)
        FROM trajet
        WHERE id_agence_depart = :departure_id
           OR id_agence_arrivee = :arrival_id
    ';

    $statement = $this->connection->prepare($sql);

    $statement->execute([
        'departure_id' => $agencyId,
        'arrival_id' => $agencyId,
    ]);

    return (int) $statement->fetchColumn() > 0;
}

/**
 * Deletes an agency.
 */
public function delete(int $agencyId): bool
{
    $sql = '
        DELETE FROM agence
        WHERE id_agence = :id
    ';

    $statement = $this->connection->prepare($sql);

    return $statement->execute([
        'id' => $agencyId,
    ]);
}
}