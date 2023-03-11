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

    public function urlsAdmin(): Generator
    {
        yield "Page d'administration" => ['GET', '/admin'];
    }


    /**
     * On vérifie si un admin a accès a
     * /admin
     *
     * @dataProvider urlsAdmin
     *
     * @param string $methodeHttp méthode HTTP utilisée
     * @param string $url url de destination
     * @return void
     */
    public function testUrlsAAdmin(
        string $methodeHttp,
        string $url
    ): void
    {
        $this->client->request($methodeHttp, $url);
        $this->assertResponseRedirects('/login');
        $utilisateurs = $this->client->getContainer()->get(UserRepository::class);
        $admin = $utilisateurs->findOneBy(['email' => 'admin@eni.fr']);
        $this->client->loginUser($admin);
        $this->client->request($methodeHttp, $url);
        $this->assertResponseIsSuccessful();
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
        $utilisateurs = $this->client->getContainer()->get(UserRepository::class);
        $admin = $utilisateurs->findOneBy(['email' => 'admin@eni.fr']);
        $this->client->loginUser($admin);
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
        $utilisateur = $utilisateurs->findOneBy(['email' => 'caliendo@eni.fr']);
        $this->client->loginUser($utilisateur);
        $this->client->request($methodeHttp, $url);
        $this->assertResponseIsSuccessful();
    }

    public function testLogout(): void
    {
        $this->client->request('GET', '/logout');
        $this->assertResponseRedirects('');
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
