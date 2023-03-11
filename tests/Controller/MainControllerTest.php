<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Exception;
use Generator;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainControllerTest extends WebTestCase
{

    private KernelBrowser $client;

//    private AbstractDatabaseTool $databaseTool;

    public function urlsAnonymes(): Generator
    {
        yield "Page d'accueil" => ['GET', '/'];
        yield "Page de la liste des séries" => ['GET', '/serie/'];
        yield "Page de login" => ['GET', '/login'];
        yield "Page d'inscription" => ['GET', '/register'];
    }

    public function urlsUtilisateur(): Generator
    {
        yield "Page de création des séries" => ['GET', '/serie/create'];
    }

    /**
     * On vérifie si un utilisateur anonyme a accès a
     * toutes les pages auquelles il devrait avoir accès
     *
     * @dataProvider urlsAnonymes
     *
     * @param string $methodeHttp méthode HTTP utilisée
     * @param string $url url de destination
     * @return void
     */
    public function testUrlsAnonymes(
        string $methodeHttp,
        string $url
    ): void
    {
        $this->client->request($methodeHttp, $url);
        $this->assertResponseIsSuccessful();
    }

    /**
     * On vérifie si un utilisateur anonyme est bien
     * redirigé vers la page de login s'il tente
     * d'accéder à la création de série
     *
     * @dataProvider urlsUtilisateur
     *
     * @param string $methodeHttp
     * @param string $url
     * @return void
     */
    public function testAccesInterdit(
        string $methodeHttp,
        string $url
    ): void
    {
        $this->client->request($methodeHttp, $url);
        $this->assertResponseRedirects('/login');
    }

    /**
     * @dataProvider urlsUtilisateur
     *
     */
    public function testAccesAutoriseApresLogin(
        string $methodeHttp,
        string $url
    ): void
    {
        $utilisateurs = $this->client->getContainer()->get(UserRepository::class);
//        $this->databaseTool->loadAllFixtures();
        $utilisateur = $utilisateurs->findOneBy(['email' => 'caliendo@hotmail.fr']);
        $this->client->loginUser($utilisateur);
        $this->client->request($methodeHttp, $url);
        $this->assertResponseIsSuccessful();
    }

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->client = static::createClient();
//        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }
}
