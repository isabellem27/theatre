<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityAccessTest extends WebTestCase
{
    public function testAccessNewEvent(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/evenement/new');

        $this->assertResponseRedirects('/login');
    }

    public function testAccessNewCateg(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/categorie/new');

        $this->assertResponseRedirects('/login');
    }
}
