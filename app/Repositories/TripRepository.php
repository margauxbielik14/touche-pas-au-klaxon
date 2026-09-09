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
        t.id_employe,
        t.date_heure_depart,
        t.date_heure_arrivee,
        t.nombre_places_total,
        t.nombre_places_disponibles,
        depart.ville AS agence_depart,
        arrivee.ville AS agence_arrivee,
        e.nom AS conducteur_nom,
        e.prenom AS conducteur_prenom,
        e.email AS conducteur_email,
        e.telephone AS conducteur_telephone
    FROM trajet t
    INNER JOIN agence depart
        ON depart.id_agence = t.id_agence_depart
    INNER JOIN agence arrivee
        ON arrivee.id_agence = t.id_agence_arrivee
    INNER JOIN employe e
        ON e.id_employe = t.id_employe
    WHERE
        t.nombre_places_disponibles > 0
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

/**
 * Finds a trip by its identifier.
 *
 * @return array<string, mixed>|false
 */
public function findById(int $tripId): array|false
{
    $sql = '
        SELECT
            id_trajet,
            date_heure_depart,
            date_heure_arrivee,
            nombre_places_total,
            nombre_places_disponibles,
            id_employe,
            id_agence_depart,
            id_agence_arrivee
        FROM trajet
        WHERE id_trajet = :id
        LIMIT 1
    ';

    $statement = $this->connection->prepare($sql);

    $statement->execute([
        'id' => $tripId,
    ]);

    return $statement->fetch();
}

/**
 * Updates an existing trip.
 */
public function update(
    int $tripId,
    int $departureAgencyId,
    int $arrivalAgencyId,
    string $departureDateTime,
    string $arrivalDateTime,
    int $totalSeats
): bool {
    $sql = '
        UPDATE trajet
        SET
            id_agence_depart = :departure_agency_id,
            id_agence_arrivee = :arrival_agency_id,
            date_heure_depart = :departure_datetime,
            date_heure_arrivee = :arrival_datetime,
            nombre_places_total = :total_seats,
            nombre_places_disponibles = :available_seats
        WHERE id_trajet = :trip_id
    ';

    $statement = $this->connection->prepare($sql);

    return $statement->execute([
        'departure_agency_id' => $departureAgencyId,
        'arrival_agency_id' => $arrivalAgencyId,
        'departure_datetime' => $departureDateTime,
        'arrival_datetime' => $arrivalDateTime,
        'total_seats' => $totalSeats,
        'available_seats' => $totalSeats,
        'trip_id' => $tripId,
    ]);
}

/**
 * Deletes a trip by its identifier.
 */
public function delete(int $tripId): bool
{
    $sql = '
        DELETE FROM trajet
        WHERE id_trajet = :trip_id
    ';

    $statement = $this->connection->prepare($sql);

    return $statement->execute([
        'trip_id' => $tripId,
    ]);
}

/**
 * Returns all trips for administration.
 *
 * @return array<int, array<string, mixed>>
 */
public function findAll(): array
{
    $sql = '
        SELECT
            t.id_trajet,
            t.date_heure_depart,
            t.date_heure_arrivee,
            t.nombre_places_total,
            t.nombre_places_disponibles,
            e.nom AS conducteur_nom,
            e.prenom AS conducteur_prenom,
            depart.ville AS agence_depart,
            arrivee.ville AS agence_arrivee
        FROM trajet t
        INNER JOIN employe e
            ON e.id_employe = t.id_employe
        INNER JOIN agence depart
            ON depart.id_agence = t.id_agence_depart
        INNER JOIN agence arrivee
            ON arrivee.id_agence = t.id_agence_arrivee
        ORDER BY t.date_heure_depart ASC
    ';

    $statement = $this->connection->query($sql);

    return $statement->fetchAll();
}
}