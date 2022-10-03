<?php

namespace App\Tests\Controller\User;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{
    public function testRouteSuccessful(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/players');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testPostUser()
    {
        $client = static::createClient();
        $email = 'testssemail@gmail.com';
        $gamerTag = 'testgamertag';

        $response = $client->jsonRequest('POST', '/api/players', [
            'password' => '122222',
            'email' => $email,
            'gamer_tag' => $gamerTag,
        ]);

        $this->assertResponseStatusCodeSame(200);
        $player = json_decode($client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('email', $player);
        $this->assertArrayHasKey('gamer_tag', $player);
    }


    public function testGetUsers(): void
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
            $this->assertArrayHasKey('points', $player);
        }
    }

    public function testPutUser(): void
    {
        $client = static::createClient();
        $response = $client->jsonRequest('PUT', '/api/players/44', [
            'email' => 'newmail1@test.fr',
            'gamer_tag' => 'newgt1',
        ]);
        $this->assertResponseStatusCodeSame(200);
        $player = json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals('newmail1@test.fr', $player['email']);
        $this->assertEquals('newgt1', $player['gamer_tag']);
    }



    public function testDeleteUser(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/api/players/47');

        $this->assertResponseStatusCodeSame(204);
    }


}