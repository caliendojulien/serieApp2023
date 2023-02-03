<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MainControllerTest extends WebTestCase
{
    /**
     * On teste la présence des 4 liens sur la page d'accueil
     */
    public function testLinksOnNavbar(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $this->assertCount(7, $crawler->filter('a'));
    }

    /**
     * On teste le fait d'arriver sur la page des series en cliquant sur le lien "Series"
     */
    public function testSeriesLink(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $this->assertResponseIsSuccessful();
        $client->clickLink('Series');
        $this->assertPageTitleSame('Series > All');
    }
}
