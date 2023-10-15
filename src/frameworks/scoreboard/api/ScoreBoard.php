<?php
namespace frameworks\scoreboard\api;
use frameworks\scoreboard\DTO\GameScore;

interface ScoreBoard {

    public function startGame(Team $homeTeam, Team $guestTeam) : void;

    public function finishGame(Team $homeTeam, Team $guestTeam) : void;

    public function updateScore(GameScore $gameScore) : void;

    public function getScore(Team $homeTeam, Team $guestTeam) : GameScore;

    /**
     * @return array<Game>
     */
    public function getScores() : array;
}