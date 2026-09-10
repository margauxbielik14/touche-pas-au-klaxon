<?php

declare(strict_types=1);

use App\Core\Database;
use App\Repositories\TripRepository;
use PHPUnit\Framework\TestCase;

class TripRepositoryTest extends TestCase
{
    private \PDO $connection;
    private TripRepository $tripRepository;
    private int $employeeId;
    private int $departureAgencyId;
    private int $arrivalAgencyId;

    protected function setUp(): void
    {
        $database = new Database();
        $this->connection = $database->getConnection();

        $this->tripRepository = new TripRepository(
            $this->connection
        );

        // L'ordre est important à cause des clés étrangères.
        $this->connection->exec('DELETE FROM trajet');
        $this->connection->exec('DELETE FROM agence');
        $this->connection->exec('DELETE FROM employe');

        $statement = $this->connection->prepare(
            'INSERT INTO employe
                (nom, prenom, email, telephone, mot_de_passe, role)
             VALUES
                (:nom, :prenom, :email, :telephone, :mot_de_passe, :role)'
        );

        $statement->execute([
            'nom' => 'Test',
            'prenom' => 'Utilisateur',
            'email' => 'test@example.com',
            'telephone' => '0600000000',
            'mot_de_passe' => password_hash('Test123!', PASSWORD_DEFAULT),
            'role' => 'USER',
        ]);

        $this->employeeId = (int) $this->connection->lastInsertId();

        $this->connection->exec(
            "INSERT INTO agence (ville)
             VALUES ('Paris'), ('Lyon')"
        );

        $agencies = $this->connection
            ->query('SELECT id_agence, ville FROM agence')
            ->fetchAll();

        foreach ($agencies as $agency) {
            if ($agency['ville'] === 'Paris') {
                $this->departureAgencyId = (int) $agency['id_agence'];
            }

            if ($agency['ville'] === 'Lyon') {
                $this->arrivalAgencyId = (int) $agency['id_agence'];
            }
        }
    }

    public function testCreateTrip(): void
    {
        $result = $this->tripRepository->create(
            $this->employeeId,
            $this->departureAgencyId,
            $this->arrivalAgencyId,
            '2027-01-10 08:00:00',
            '2027-01-10 12:00:00',
            4
        );

        $trips = $this->tripRepository->findAll();

        $this->assertTrue($result);
        $this->assertCount(1, $trips);
        $this->assertSame(
            4,
            (int) $trips[0]['nombre_places_total']
        );
        $this->assertSame(
            4,
            (int) $trips[0]['nombre_places_disponibles']
        );
    }

    public function testUpdateTrip(): void
{
    $this->tripRepository->create(
        $this->employeeId,
        $this->departureAgencyId,
        $this->arrivalAgencyId,
        '2027-01-10 08:00:00',
        '2027-01-10 12:00:00',
        4
    );

    $trips = $this->tripRepository->findAll();

    $this->assertCount(1, $trips);

    $tripId = (int) $trips[0]['id_trajet'];

    $result = $this->tripRepository->update(
        $tripId,
        $this->arrivalAgencyId,
        $this->departureAgencyId,
        '2027-01-11 09:00:00',
        '2027-01-11 13:00:00',
        5
    );

    $updatedTrip = $this->tripRepository->findById($tripId);

    $this->assertTrue($result);
    $this->assertIsArray($updatedTrip);

    $this->assertSame(
        $this->arrivalAgencyId,
        (int) $updatedTrip['id_agence_depart']
    );

    $this->assertSame(
        $this->departureAgencyId,
        (int) $updatedTrip['id_agence_arrivee']
    );

    $this->assertSame(
        5,
        (int) $updatedTrip['nombre_places_total']
    );

    $this->assertSame(
        5,
        (int) $updatedTrip['nombre_places_disponibles']
    );
}

public function testDeleteTrip(): void
{
    $this->tripRepository->create(
        $this->employeeId,
        $this->departureAgencyId,
        $this->arrivalAgencyId,
        '2027-01-10 08:00:00',
        '2027-01-10 12:00:00',
        4
    );

    $trips = $this->tripRepository->findAll();

    $this->assertCount(1, $trips);

    $tripId = (int) $trips[0]['id_trajet'];

    $result = $this->tripRepository->delete($tripId);

    $deletedTrip = $this->tripRepository->findById($tripId);

    $this->assertTrue($result);
    $this->assertFalse($deletedTrip);
}
}