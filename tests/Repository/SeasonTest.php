<?php

namespace App\Tests\Repository;

use App\Entity\Season;
use App\Entity\Serie;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class SeasonTest extends KernelTestCase
{
    private ObjectManager $entityManager;

    public function testAjoutSuppSaison(): void
    {
        $nbSaison = count($this->entityManager->getRepository(Season::class)->findAll());
        $nouvelleSaison = (new Season())
            ->setSerie(new Serie())
            ->setNumber(42)
            ->setTmbdId(23)
            ->setDateCreated(new \DateTime());
        $this->entityManager->getRepository(Season::class)->save($nouvelleSaison, true);
        $this->assertSame($nbSaison + 1, count($this->entityManager->getRepository(Season::class)->findAll()));
        $this->entityManager->getRepository(Season::class)->remove($nouvelleSaison, true);
        $this->assertSame($nbSaison, count($this->entityManager->getRepository(Season::class)->findAll()));
    }

    protected function setUp(): void
    {
        parent::setUp();
        $kernel = self::bootKernel();
        $this->entityManager = $kernel->getContainer()->get('doctrine')->getManager();
    }
}
