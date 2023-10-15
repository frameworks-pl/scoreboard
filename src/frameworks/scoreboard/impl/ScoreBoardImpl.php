<?php
namespace frameworks\scoreboard\impl;


use frameworks\scoreboard\api\Game;
use frameworks\scoreboard\api\ScoreBoard;
use frameworks\scoreboard\api\Team;
use frameworks\scoreboard\DTO\GameScore;

class ScoreBoardImpl implements ScoreBoard {

    /** @var array array<string, Game> */
    protected $games = [];

    public function startGame(Team $homeTeam, Team $guestTeam) : void {
        $game = new GameImpl($homeTeam, $guestTeam);
        $this->games[$game->getId()] = $game;
    }

    public function finishGame() : void {
        echo "Game finished";
    }

    public function getScore(Team $homeTeam, Team $guestTeam): GameScore {

        //TODO: change to static method as it is used in two places at least
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