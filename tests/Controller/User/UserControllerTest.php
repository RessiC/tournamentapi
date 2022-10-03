<?php

namespace App\Tests\Controller\User;

use App\Entity\User\User;
use App\Service\UserService;
use GuzzleHttp\Client;
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
        $email = 'testemail@gmail.com';
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

}