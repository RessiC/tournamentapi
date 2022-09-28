<?php

namespace App\Tests\Controller\User;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PlayerUserControllerTest extends WebTestCase
{
    public function testRouteSuccessful(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/players');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testHasProperties(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/players');

        $playerUsers = json_decode($client->getResponse()->getContent(), true);

        foreach ($playerUsers as $player) {
            $this->assertArrayHasKey('id', $player);
            $this->assertArrayHasKey('email', $player);
            $this->assertArrayHasKey('roles', $player);
            $this->assertArrayHasKey('is_confirmed', $player);
            $this->assertArrayHasKey('is_player', $player);
            $this->assertArrayHasKey('gamer_tag', $player);
            $this->assertArrayHasKey('is_captain', $player);
        }
    }
}