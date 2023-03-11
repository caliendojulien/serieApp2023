<?php

namespace App\Tests\Repository;

use App\Entity\Serie;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SerieTest extends KernelTestCase
{
    private ObjectManager $entityManager;

    public function testAjoutSuppSerie(): void
    {
        $nbSerie = count($this->entityManager->getRepository(Serie::class)->findAll());
        $nouvelleSerie = (new Serie());
        $this->entityManager->getRepository(Serie::class)->save($nouvelleSerie, true);
        $this->assertSame($nbSerie + 1, count($this->entityManager->getRepository(Serie::class)->findAll()));
        $this->entityManager->getRepository(Serie::class)->remove($nouvelleSerie, true);
        $this->assertSame($nbSerie, count($this->entityManager->getRepository(Serie::class)->findAll()));
    }

    public function testAllWithSeasons(): void
    {
        $nbSaisons = count($this->entityManager->getRepository(Serie::class)->findAllWithSeasons());
        $this->assertSame(10, $nbSaisons);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }
}
