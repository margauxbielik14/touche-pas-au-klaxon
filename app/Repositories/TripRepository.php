<?php

declare(strict_types=1);

namespace App\Repositories;

use PDO;

/**
 * Handles database operations related to trips.
 */
class TripRepository
{
    public function __construct(
        private PDO $connection
    ) {
    }

    /**
     * Returns all upcoming trips with available seats.
     *
     * @return array<int, array<string, mixed>>
     */
    public function findAvailableTrips(): array
    {
        $sql = '
            SELECT
                t.id_trajet,
                t.date_heure_depart,
                t.date_heure_arrivee,
                t.nombre_places_disponibles,
                depart.ville AS agence_depart,
                arrivee.ville AS agence_arrivee
            FROM trajet AS t
            INNER JOIN agence AS depart
                ON t.id_agence_depart = depart.id_agence
            INNER JOIN agence AS arrivee
                ON t.id_agence_arrivee = arrivee.id_agence
            WHERE t.nombre_places_disponibles > 0
                AND t.date_heure_depart > NOW()
            ORDER BY t.date_heure_depart ASC
        ';

        $statement = $this->connection->query($sql);

        return $statement->fetchAll();
    }

    /**
 * Creates a new trip.
 */
public function create(
    int $userId,
    int $departureAgencyId,
    int $arrivalAgencyId,
    string $departureDateTime,
    string $arrivalDateTime,
    int $totalSeats
): bool {
    $sql = '
        INSERT INTO trajet (
            date_heure_depart,
            date_heure_arrivee,
            nombre_places_total,
            nombre_places_disponibles,
            id_employe,
            id_agence_depart,
            id_agence_arrivee
        )
        VALUES (
            :departure_datetime,
            :arrival_datetime,
            :total_seats,
            :available_seats,
            :user_id,
            :departure_agency_id,
            :arrival_agency_id
        )
    ';

    $statement = $this->connection->prepare($sql);

    return $statement->execute([
        'departure_datetime' => $departureDateTime,
        'arrival_datetime' => $arrivalDateTime,
        'total_seats' => $totalSeats,
        'available_seats' => $totalSeats,
        'user_id' => $userId,
        'departure_agency_id' => $departureAgencyId,
        'arrival_agency_id' => $arrivalAgencyId,
    ]);
}
}