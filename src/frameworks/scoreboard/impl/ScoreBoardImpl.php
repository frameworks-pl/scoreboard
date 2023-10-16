<?php
namespace frameworks\scoreboard\impl;

use frameworks\scoreboard\api\ScoreBoard;
use frameworks\scoreboard\api\Team;
use frameworks\scoreboard\DTO\GameScore;

class ScoreBoardImpl implements ScoreBoard {

    /** @var array array<string, Game> */
    protected $games = [];

    public function startGame(Team $homeTeam, Team $guestTeam) : void {
        if ($homeTeam->getName() === $guestTeam->getName()) {
            throw new \InvalidArgumentException("Team cannot play with itself.");
        }
        $game = new GameImpl($homeTeam, $guestTeam);
        $this->games[$game->getId()] = $game;
    }

    public function finishGame(Team $homeTeam, Team $guestTeam) : void {
        $id = GameImpl::buildId($homeTeam->getName(), $guestTeam->getName());
        if (array_key_exists($id, $this->games)) {
            unset($this->games[$id]);
        } else {
            throw new \InvalidArgumentException("Attempting to finish game that is not on the board");
        }
    }

    public function getScore(Team $homeTeam, Team $guestTeam): GameScore {

        $id = GameImpl::buildId($homeTeam->getName(), $guestTeam->getName());
        $game = $this->games[$id];
        return new GameScore($game->getHomeTeam()->getName(),
            $game->getHomeTeamScore(),
            $game->getGuestTeam()->getName(),
            $game->getGuestTeamScore()
        );
    }

    public function updateScore(GameScore $gameScore) : void {
        $id = GameImpl::buildId($gameScore->getHomeTeamName(), $gameScore->getGuestTeamName());

        if (!array_key_exists($id, $this->games)) {
            throw new \InvalidArgumentException("The game does not exist.");
        }

        $this->games[$id]->setScore($gameScore->getHomeTeamScore(),
            $gameScore->getGuestTeamScore());
    }

    public function getScores() : array {

        $gameObjects = array_values($this->games);
        usort($gameObjects, function($a, $b) {
            $scoreDiff = $b->getTotalScore() - $a->getTotalScore();
            if ($scoreDiff !== 0) {
                return $scoreDiff;
            }
            if ($b->getCreationDateTime() > $a->getCreationDateTime()) {
                return 1;
            } if ($b->getCreationDateTime() < $a->getCreationDateTime()) {
                return -1;
            }

            return 0;
        });

        return $gameObjects;
    }
}