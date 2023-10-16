<?php
namespace frameworks\scoreboard\api;
use frameworks\scoreboard\DTO\GameScore;

interface ScoreBoard {

    /**
     * Starts new game between both two teams
     *
     * @param Team $homeTeam
     * @param Team $guestTeam
     * @return void
     */
    public function startGame(Team $homeTeam, Team $guestTeam) : void;

    /**
     * Finishes game between two specified teams
     *
     * @param Team $homeTeam
     * @param Team $guestTeam
     * @return void
     */
    public function finishGame(Team $homeTeam, Team $guestTeam) : void;

    /**
     * Updates score for given game, specified by GameScore object
     *
     * @param GameScore $gameScore
     * @return void
     */
    public function updateScore(GameScore $gameScore) : void;

    /**
     * Returns current score for a game between two specified teams
     *
     * @param Team $homeTeam
     * @param Team $guestTeam
     * @return GameScore
     */
    public function getScore(Team $homeTeam, Team $guestTeam) : GameScore;

    /**
     * Returns games ordered by total game score, starting from biggest ones
     * For same total scores newer games are reported first
     *
     * @return array<Game>
     */
    public function getScores() : array;
}