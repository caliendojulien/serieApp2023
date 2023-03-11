<?php

namespace App\Tests\Entity;

use App\Entity\Season;
use App\Entity\Serie;
use PHPUnit\Framework\TestCase;

class SerieTest extends TestCase
{
    private Serie $serie;

    public function testGettersEtSetters(): void
    {
        $this->assertNull($this->serie->getId());
        $this->assertNotNull($this->serie->getDateModified());
        $this->assertNotNull($this->serie->getPoster());
        $this->assertNotNull($this->serie->getOverview());
        $this->assertNotNull($this->serie->getDateCreated());
        $this->assertNotNull($this->serie->getFirstAirDate());
        $this->assertNotNull($this->serie->getBackdrop());
        $this->assertNotNull($this->serie->getGenres());
        $this->assertNotNull($this->serie->getLastAirDate());
        $this->assertNotNull($this->serie->getName());
        $this->assertNotNull($this->serie->getPopularity());
        $this->assertNotNull($this->serie->getStatus());
        $this->assertNotNull($this->serie->getVote());
        $saison = new Season();
        $this->serie->addSeason($saison);
        $this->assertEquals(1, $this->serie->getSeasons()->count());
        $this->serie->removeSeason($saison);
        $this->assertEquals(0, $this->serie->getSeasons()->count());
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->serie = (new Serie())
            ->setFirstAirDate(new \DateTime())
            ->setPoster('')
            ->setOverview('Lorem ipsum')
            ->setLastAirDate(new \DateTime())
            ->setDateCreated(new \DateTime())
            ->setDateModified(new \DateTime())
            ->setBackdrop('')
            ->setGenres('')
            ->setName('Game of thrones')
            ->setPopularity(5)
            ->setVote(5)
            ->setStatus('En cours');
    }

}
