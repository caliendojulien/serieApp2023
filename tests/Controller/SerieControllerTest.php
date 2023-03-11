<?php

namespace App\Tests\Controller;

use App\Repository\SerieRepository;
use App\Repository\UserRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SerieControllerTest extends WebTestCase
{

    private KernelBrowser $client;

    public function testDetailSerie(): void
    {
        $this->client->request('GET', '/serie/details/1');
        $this->assertResponseIsSuccessful();
    }

    public function testCreationSerie(): void
    {
        $utilisateurs = $this->client->getContainer()->get(UserRepository::class);
        $utilisateur = $utilisateurs->findOneBy(['email' => 'caliendo@hotmail.fr']);
        $series = $this->client->getContainer()->get(SerieRepository::class);
        $nbSeries = $series->count([]);
        $this->client->loginUser($utilisateur);
        $this->client->request('GET', '/serie/create');
        $this->client->submitForm('Create', [
            'serie[name]' => 'abc',
            'serie[overview]' => 'abc',
            'serie[status]' => 'Ended',
            'serie[vote]' => 5,
            'serie[popularity]' => 4,
            'serie[genres]' => 'Science Fiction',
            'serie[firstAirDate]' => '2023-03-11 12:00:00',
            'serie[lastAirDate]' => '2023-03-11 12:00:00',
            'serie[backdrop]' => 'abc',
            'serie[poster]' => 'xyz',
            'serie[tmdbId]' => 42
        ]);
        $this->assertEquals($nbSeries + 1, $series->count([]));
        $this->assertResponseRedirects('/serie/');
    }

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
    }

}
