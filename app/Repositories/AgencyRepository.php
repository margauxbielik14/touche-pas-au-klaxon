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
}