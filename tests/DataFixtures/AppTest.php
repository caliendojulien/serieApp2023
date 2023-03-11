<?php

namespace App\Tests\DataFixtures;

use App\Repository\UserRepository;
use Exception;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppTest extends WebTestCase
{
    private AbstractDatabaseTool $databaseTool;
    private KernelBrowser $client;

    public function testSomething(): void
    {
        $this->databaseTool->loadAllFixtures();
        $utilisateurs = $this->client->getContainer()->get(UserRepository::class);
        $utilisateur = $utilisateurs->findOneBy(['email' => 'caliendo@hotmail.fr']);
        $this->assertNotNull($utilisateur);
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
