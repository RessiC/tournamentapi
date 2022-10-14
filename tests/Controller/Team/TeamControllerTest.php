<?php

namespace App\Tests\Controller\Team;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TeamControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    public function setup(): void
    {
        $this->client = static::createClient();
    }

    public function testPostTeam(): void
    {
        $name = 'testPostName';
        $this->client->jsonRequest('POST', '/api/teams', [
            'name' => $name
        ]);
        $team = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(200);
        $this->assertArrayHasKey('name', $team);
    }

    public function testGetTeams(): void
    {
        $this->client->request('GET', '/api/teams');
        $teams = json_decode($this->client->getResponse()->getContent(), true);

        foreach ($teams as $team) {
            $this->assertArrayHasKey('id', $team);
            $this->assertArrayHasKey('name', $team);
            $this->assertArrayHasKey('players', $team);
        }
    }

    public function testGetTeam(): void
    {
        $teamId = 1;
        $this->client->request('GET', '/api/teams/' . $teamId);
        $team = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(200);
        $this->assertArrayHasKey('id', $team);
        $this->assertArrayHasKey('name', $team);
        $this->assertArrayHasKey('players', $team);
    }

    public function testPutTeam(): void
    {
        $this->client->jsonRequest('PUT', '/api/teams/11', [
            'name' => 'putNameHERE'
        ]);
        $team = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals('putNameHERE', $team['name']);
    }

    public function testDeleteTeam(): void
    {
        $this->client->request('DELETE', '/api/teams/11');

        $this->assertResponseStatusCodeSame(204);
    }

    public function testJoinTournament(): void
    {
        $tournamentId = 4;
        $this->client->request("PUT", "/api/teams/1/tournaments/" . $tournamentId);
        $team = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(200);
        $this->assertNotNull($team["tournaments"]);
    }

    public function testLeaveTournament(): void
    {
        $tournamentId = 4;
        $this->client->request("DELETE", "/api/teams/1/tournaments/" . $tournamentId);
        $team = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(200);
        $this->assertEmpty($team["tournaments"]);
    }

    public function testReturn404NotFoundOnUnknownTeamId(): void
    {
        $unknownId = 10000;
        $this->client->request('GET', 'api/teams/' . $unknownId );

        $this->assertResponseStatusCodeSame(404);
    }

    public function testReturn200OKOnExistingTeamId(): void
    {
        $knownId = 1;
        $this->client->request('GET', '/api/teams/' . $knownId);

        $this->assertResponseStatusCodeSame(200);
    }
}