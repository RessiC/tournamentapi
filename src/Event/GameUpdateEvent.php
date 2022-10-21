<?php

namespace App\Event;

use App\Entity\Team\Team;
use App\Entity\Tournament\Game;
use Exception;
use Symfony\Contracts\EventDispatcher\Event;

class GameUpdateEvent extends Event
{
    public const NAME = 'game.update';

    public Team $winner;

    public Team $looser;

    public Game $game;

    /**
     * @throws Exception
     */
    public function __construct( Game $game)
    {
        $this->game = $game;
        $this->setNextgame();
    }

    /**
     * @throws Exception
     */
    public function setNextGame()
    {
        if ($this->game->isFinished()) {
            $this->setWinnerAndLooser();
                echo "event is ok, work todo";
        }
    }

    /**
     * @throws \Exception
     */
    public function setWinnerAndLooser()
    {
        if ($this->game->getScoreTeam1() > $this->game->getScoreTeam2()) {
            $this->winner = $this->game->getTeam1();
            $this->looser = $this->game->getTeam2();
        } elseif ($this->game->getScoreTeam1() < $this->game->getScoreTeam2()) {
            $this->winner = $this->game->getTeam2();
            $this->looser = $this->game->getTeam1();
        } elseif ($this->game->getScoreTeam1() === $this->game->getScoreTeam2()) {
            throw new Exception("score can't be null");
        }
    }

    /**
     * @throws Exception
     */
    public function setWinner(Team $winner)
    {
        $this->setWinnerAndLooser();
    }

    /**
     * @throws Exception
     */
    public function setLooser(Team $looser)
    {
        $this->setWinnerAndLooser();
    }

    public function getGame(): Game
    {
        return $this->game;
    }

    public function getWinner(): Team
    {
        return $this->winner;
    }

    public function getLooser(): Team
    {
        return $this->looser;
    }

}