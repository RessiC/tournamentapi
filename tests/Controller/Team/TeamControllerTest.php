<?php

namespace App\Tests\Controller\Team;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeamControllerTest extends WebTestCase
{
    public function testRouteSuccessful(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/teams');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testPostTeam(): void
    {
        $client = static::createClient();
        $name = 'testPostName';

        $response = $client->jsonRequest('POST', '/api/teams', [
            'name' => $name
        ]);
        $team = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(200);
        $this->assertArrayHasKey('name', $team);
    }

    public function testGetTeams(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/teams');

        $teams = json_decode($client->getResponse()->getContent(), true);
        foreach ($teams as $team) {
            $this->assertArrayHasKey('id', $team);
            $this->assertArrayHasKey('name', $team);
            $this->assertArrayHasKey('players', $team);
        }
    }

    public function testPutTeam(): void
    {
        $client = static::createClient();
        $response = $client->jsonRequest('PUT', '/api/teams/11', [
            'name' => 'putNameHERE'
        ]);
        $team = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals('putNameHERE', $team['name']);
    }

    public function testDeleteTeam(): void
    {
        $client = static::createClient();
        $client->request('DELETE', '/api/teams/11');

        $this->assertResponseStatusCodeSame(204);
    }
}