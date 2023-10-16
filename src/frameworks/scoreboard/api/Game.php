<?php
namespace frameworks\scoreboard\api;

interface Game {

    /**
     * Returns string that allows uniquely identify game, constructed from names of both teams
     *
     * @return string
     */
    function getId() : string;

    /**
     * Returns guest team of the game
     *
     * @return Team
     */
    function getHomeTeam() : Team;

    /**
     * Returns home team of the game
     *
     * @return Team
     */
    function getGuestTeam() : Team;

    /**
     * Returns current score in the game for home team
     *
     * @return int
     */
    function getHomeTeamScore() : int;

    /**
     * Returns current score in the game for guest team
     *
     * @return int
     */
    function getGuestTeamScore() : int;

    /**
     * Updates score for the game
     *
     * @param int $homeTeamScore
     * @param int $guestTeamScore
     * @return void
     */
    function setScore(int $homeTeamScore, int $guestTeamScore) : void;

    /**
     * Returns sum of both team scores
     *
     * @return int
     */
    function getTotalScore() : int;

    /**
     * Returns exact timestamp of when game was started (created)
     *
     * @return \DateTime
     */
    function getCreationDateTime() : \DateTime;
}