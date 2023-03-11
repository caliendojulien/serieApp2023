<?php

namespace App\Tests\Entity;

use App\Entity\Season;
use App\Entity\Serie;
use PHPUnit\Framework\TestCase;

class SeasonTest extends TestCase
{

    private Season $saison;

    public function testGettersEtSetters(): void
    {
        $this->assertNotNull($this->saison->getSerie());
        $this->assertNull($this->saison->getId());
        $this->assertNotNull($this->saison->getDateCreated());
        $this->assertNotNull($this->saison->getOverview());
        $this->assertNotNull($this->saison->getDateModified());
        $this->assertNotNull($this->saison->getPoster());
        $this->assertNotNull($this->saison->getFirstAirDate());
        $this->assertNotNull($this->saison->getNumber());
        $this->assertNotNull($this->saison->getTmbdId());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->saison = (new Season())
            ->setSerie(new Serie())
            ->setDateCreated(new \DateTime())
            ->setOverview('lorem ipsum')
            ->setDateModified(new \DateTime())
            ->setPoster('')
            ->setFirstAirDate(new \DateTime())
            ->setNumber(42)
            ->setTmbdId(23);
    }
}
