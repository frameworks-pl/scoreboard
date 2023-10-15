<?php
namespace frameworks\scoreboard\api;

interface Game {

    function getId() : string;

    function getHomeTeam() : Team;

    function getGuestTeam() : Team;

    function getHomeTeamScore() : int;

    function getGuestTeamScore() : int;

    function setScore(int $homeTeamScore, int $guestTeamScore) : void;

    function getTotalScore() : int;

    function getCreationDateTime() : \DateTime;
}