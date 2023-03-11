<?php

namespace App\Tests\Controller;

use App\Repository\UserRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityTest extends WebTestCase
{

    private KernelBrowser $client;

    public function testRegisterUtilisateur(): void
    {
        $utilisateurs = $this->client->getContainer()->get(UserRepository::class);
        $utilisateur = $utilisateurs->findOneBy(['email' => 'caliendo@eni.fr']);
        $nbUtilisateurs = count($utilisateurs->findAll());
        $this->client->loginUser($utilisateur);
        $this->client->request('GET', '/register');
        $this->client->submitForm('Register', [
            'registration_form[email]' => 'nouveau@eni.fr',
            'registration_form[plainPassword]' => '123456',
            'registration_form[agreeTerms]' => true
        ]);
        $this->assertSame($nbUtilisateurs + 1, count($utilisateurs->findAll()));
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
