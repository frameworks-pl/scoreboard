<?php
namespace frameworks\scoreboard\impl;

use frameworks\scoreboard\api\Game;
use frameworks\scoreboard\api\Team;

class GameImpl implements Game
{
    protected $homeTeam;

    protected $homeTeamScore;

    protected $guestTeam;

    protected $guestTeamScore;

    protected $id;

    public function __construct(Team $homeTeam, Team $guestTeam) {
        $this->homeTeam = $homeTeam;
        $this->guestTeam = $guestTeam;

        $this->homeTeamScore = 0;
        $this->guestTeamScore = 0;
    }

    function getHomeTeam() : Team {
        return $this->homeTeam;
    }

    function getGuestTeam() : Team {
        return $this->guestTeam;
    }

    function getHomeTeamScore() : int {
        return $this->homeTeamScore;
    }

    function getGuestTeamScore() : int {
        return $this->guestTeamScore;
    }

    public function setScore(int $homeTeamScore, int $guestTeamScore) : void {
        $this->homeTeamScore = $homeTeamScore;
        $this->guestTeamScore = $guestTeamScore;
    }

    public function getId() : string {
        return self::buildId($this->homeTeam->getName(),$this->guestTeam->getName());
    }

    public static function buildId(string $homeTeamName, string $guestTeamName) {
        return $homeTeamName . "_" . $guestTeamName;
    }

}