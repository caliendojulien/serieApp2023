<?php

namespace App\Tests\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ResetPasswordTest extends WebTestCase
{
    private KernelBrowser $client;

    public function testResetPasswordVraiUtilisateur(): void
    {
        $this->client->request('GET', '/reset-password');
        $this->client->submitForm('Send password reset email', [
            'reset_password_request_form[email]' => 'caliendo@eni.fr'
        ]);
        $this->assertResponseRedirects('/reset-password/check-email');
    }

    public function testResetUrlAvecToken(): void
    {
        $this->client->request('GET', '/reset-password/reset/abc123');
        $this->assertResponseRedirects('/reset-password/reset');
    }

    public function testResetUrlSansToken(): void
    {
        $this->client->request('GET', '/reset-password/reset');
        $this->assertResponseStatusCodeSame(404);
    }

    public function testCheckUrl(): void
    {
        $this->client->request('GET', '/reset-password/check-email');
        $this->assertResponseIsSuccessful();
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
