<?php

namespace App\Tests\Controller\Tournament;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class TournamentControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    public function setup(): void
    {
        $this->client = static::createClient();
    }
    public function testRouteSuccessful(): void
    {
        $this->client->request('GET', '/api/tournaments');
        $this->assertResponseStatusCodeSame(200);
    }

    public function testPostTournament(): void
    {
        $name = "tournamentNamePost";
        $points = 1;
        $type = '2s';

        $this->client->jsonRequest('POST', '/api/tournaments',
        [
            'name' => $name,
            'points' => $points,
            'type' => $type,
        ]);
        $tournament = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(200);
        $this->assertArrayHasKey('id', $tournament);
        $this->assertArrayHasKey('name', $tournament);
        $this->assertArrayHasKey('teams', $tournament);
        $this->assertArrayHasKey('cash_price', $tournament);
        $this->assertArrayHasKey('link_twitch', $tournament);
        $this->assertArrayHasKey('created_at', $tournament);
        $this->assertArrayHasKey('start_at', $tournament);
        $this->assertArrayHasKey('points', $tournament);
        $this->assertArrayHasKey('type', $tournament);
    }

    public function testGetTournament(): void
    {
        $tournamentId = 1;
        $this->client->request('GET', 'api/tournaments/' . $tournamentId );
        $tournament = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(200);
        $this->assertArrayHasKey("id", $tournament);
        $this->assertArrayHasKey("name", $tournament);
        $this->assertArrayHasKey("teams", $tournament);
        $this->assertArrayHasKey("cash_price", $tournament);
        $this->assertArrayHasKey("link_twitch", $tournament);
        $this->assertArrayHasKey("created_at", $tournament);
        $this->assertArrayHasKey("start_at", $tournament);
        $this->assertArrayHasKey("points", $tournament);
        $this->assertArrayHasKey("type", $tournament);
    }

    public function testGetTournaments(): void
    {
        $this->client->request('GET', 'api/tournaments');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPutTournament(): void
    {
        $tournamentId = 4;
        $name = 'newName';
        $startAt = '2022-10-09T14:22:06+00:00';
        $points = 12;
        $type = '2s';

        $this->client->jsonRequest('PUT', 'api/tournaments/' . $tournamentId, [
            'name' => $name,
            'start_at' => $startAt,
            'points' => $points,
            'type' => $type
        ] );
        $tournament = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals($name, $tournament["name"]);
        $this->assertEquals($startAt, $tournament["start_at"]);
        $this->assertEquals($points, $tournament["points"]);
        $this->assertEquals($type, $tournament["type"]);
    }

    public function testDeleteTournament(): void
    {
        $tournamentId = 9;
        $this->client->request('DELETE', '/api/tournaments/' . $tournamentId);

        $this->assertResponseStatusCodeSame(204);
    }
}