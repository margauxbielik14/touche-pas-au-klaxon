<?php

declare(strict_types=1);

use App\Core\Database;
use App\Repositories\AgencyRepository;
use PHPUnit\Framework\TestCase;

class AgencyRepositoryTest extends TestCase
{
    private PDO $connection;
    private AgencyRepository $agencyRepository;

    protected function setUp(): void
    {
        $database = new Database();
        $this->connection = $database->getConnection();

        $this->agencyRepository = new AgencyRepository(
            $this->connection
        );

        // L'ordre est important à cause des clés étrangères.
$this->connection->exec('DELETE FROM trajet');
$this->connection->exec('DELETE FROM agence');
$this->connection->exec('DELETE FROM employe');
    }

    public function testCreateAgency(): void
    {
        $result = $this->agencyRepository->create('Mulhouse');

        $agency = $this->agencyRepository->findByCity('Mulhouse');

        $this->assertTrue($result);
        $this->assertIsArray($agency);
        $this->assertSame('Mulhouse', $agency['ville']);
    }

    public function testUpdateAgency(): void
{
    $this->agencyRepository->create('Mulhouse');

    $agency = $this->agencyRepository->findByCity('Mulhouse');

    $this->assertIsArray($agency);

    $agencyId = (int) $agency['id_agence'];

    $result = $this->agencyRepository->update(
        $agencyId,
        'Colmar'
    );

    $updatedAgency = $this->agencyRepository->findById(
        $agencyId
    );

    $this->assertTrue($result);
    $this->assertIsArray($updatedAgency);
    $this->assertSame(
        'Colmar',
        $updatedAgency['ville']
    );
}

public function testDeleteAgency(): void
{
    $this->agencyRepository->create('Mulhouse');

    $agency = $this->agencyRepository->findByCity('Mulhouse');

    $this->assertIsArray($agency);

    $agencyId = (int) $agency['id_agence'];

    $result = $this->agencyRepository->delete(
        $agencyId
    );

    $deletedAgency = $this->agencyRepository->findById(
        $agencyId
    );

    $this->assertTrue($result);
    $this->assertFalse($deletedAgency);
}
}