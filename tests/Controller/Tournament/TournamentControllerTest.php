<?php

namespace App\Tests\Controller\Tournament;

use App\Entity\Tournament\Bracket;
use App\Entity\Tournament\Tournament;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;

class TournamentControllerTest extends WebTestCase
{
    private KernelBrowser $client;

    public function setup(): void
    {
        $this->client = static::createClient();
    }

    public function testPostTournament(): void
    {
        $tournament = new Tournament();

        $tournament->setName('t4');
        $tournament->setPoints(1000);
        $tournament->setTeamsNeeded(12);
        $tournament->setBracketLooser(false);
        $tournament->addBracket(new Bracket());

        $this->client->jsonRequest('POST', '/api/tournaments',
        [
            'name' => $tournament->getName(),
            'points' => $tournament->getPoints(),
            'teams_needed' => $tournament->getTeamsNeeded(),
            'bracket_looser' => $tournament->hasBracketLooser(),
            'start_at' => "2022-10-10T14:10:12+00:00",
        ]);
        $data = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(200);
        $this->tournamentHasKey($data);
    }

    public function testGetTournament(): void
    {
        $tournamentId = 1;
        $this->client->request('GET', 'api/tournaments/' . $tournamentId );
        $tournament = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(200);
        $this->tournamentHasKey($tournament);
    }

    public function testGetTournaments(): void
    {
        $this->client->request('GET', 'api/tournaments');

        $this->assertResponseStatusCodeSame(200);
    }

    public function testPutTournament(): void
    {
        $tournamentId = 1;
        $name = 'new';
        $startAt = '2022-10-09T14:22:06+00:00';
        $points = 12;

        $this->client->jsonRequest('PUT', 'api/tournaments/' . $tournamentId, [
            'name' => $name,
            'start_at' => $startAt,
            'points' => $points,
        ] );
        $tournament = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(200);
        $this->assertEquals($name, $tournament["name"]);
        $this->assertEquals($startAt, $tournament["start_at"]);
        $this->assertEquals($points, $tournament["points"]);
    }

    public function testDeleteTournament(): void
    {
        $tournamentId = 9;
        $this->client->request('DELETE', '/api/tournaments/' . $tournamentId);

        $this->assertResponseStatusCodeSame(204);
    }

     public function testPostGame(): void
    {
        $tournamentId = 1;
        $name = "gam";

        $this->client->jsonRequest('POST', '/api/tournaments/' . $tournamentId . '/games',
            [
                'name' => $name,
            ]);
        $game = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(200);
        $this->gameHasKey($game);
    }


    public function testGetTournamentGame(): void
    {
        $tournamentId = 1;
        $gameId = 3;
        $this->client->request('GET', '/api/tournaments/' . $tournamentId . '/games/' . $gameId);
        $game = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(200);
        $this->gameHasKey($game);
    }

    public function testGetTournamentGames(): void
    {
        $tournamentId = 1;
        $this->client->request('GET', '/api/tournaments/' . $tournamentId . '/games');
        $games = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertResponseStatusCodeSame(200);
        foreach ($games as $game)
        {
            $this->gameHasKey($game);
        }
    }

    public function testPutTournamentGame(): void
    {
        $tournamentId = 6;
        $gameId = 1;
        $name = '122';
        $scoreTeam1 = 3;
        $scoreTeam2 = 1;

        $this->client->jsonRequest('PUT', '/api/tournaments/' . $tournamentId . '/games/' . $gameId,
            [
                'name' => $name,
                'is_finished' => true,
                'score_team1' => $scoreTeam1,
                'score_team2' => $scoreTeam2
            ]);
        $game = json_decode($this->client->getResponse()->getContent(), true);
        $this->assertResponseStatusCodeSame(200);
        $this->gameHasKey($game);

    }

    public function testReturn404NotFoundOnUnknownTournamentId(): void
    {
        $unknownId = 10000;
        $this->client->request('GET', 'api/tournaments/' . $unknownId );

        $this->assertResponseStatusCodeSame(404);
    }

    public function testReturn200OKOnExistingTournamentId(): void
    {
        $knownId = 1;
        $this->client->request('GET', '/api/tournaments/' . $knownId);

        $this->assertResponseStatusCodeSame(200);
    }

    public function testReturn404NotFoundOnUnknownGameId(): void
    {
        $tournamentId = 1;
        $unknownId = 1000;
        $this->client->request('GET', '/api/tournaments/' . $tournamentId . '/games/' . $unknownId);

        $this->assertResponseStatusCodeSame(404);
    }

    public function testReturn200OKOnExistingGameId(): void
    {
        $tournamentId = 1;
        $knownId = 3;
        $this->client->request('GET', '/api/tournaments/' . $tournamentId . '/games/' . $knownId);

        $this->assertResponseStatusCodeSame(200);
    }

    public function tournamentHasKey(Array $tournament)
    {
        $this->assertArrayHasKey("id", $tournament);
        $this->assertArrayHasKey("name", $tournament);
        $this->assertArrayHasKey("cash_price", $tournament);
        $this->assertArrayHasKey("link_twitch", $tournament);
        $this->assertArrayHasKey("created_at", $tournament);
        $this->assertArrayHasKey("start_at", $tournament);
        $this->assertArrayHasKey("points", $tournament);
    }

    public function gameHasKey(Array $game)
    {
        $this->assertArrayHasKey('id', $game);
        $this->assertArrayHasKey('name', $game);
        $this->assertArrayHasKey('team1', $game);
        $this->assertArrayHasKey('team2', $game);
        $this->assertArrayHasKey('is_finished', $game);
        $this->assertArrayHasKey('score_team1', $game);
        $this->assertArrayHasKey('score_team2', $game);
        $this->assertArrayHasKey('tournament', $game);
    }

}