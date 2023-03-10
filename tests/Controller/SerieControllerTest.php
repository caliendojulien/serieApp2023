<?php

namespace App\Tests\Controller;

use Exception;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SerieControllerTest extends WebTestCase
{

    private KernelBrowser $client;
    private AbstractDatabaseTool $databaseTool;

    public function testDetailSerie(): void
    {
        $this->databaseTool->loadAllFixtures();
        $this->client->request('GET', '/serie/details/1');
        $this->assertResponseIsSuccessful();
    }

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

}
