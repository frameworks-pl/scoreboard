<?php
namespace frameworks\scoreboard\impl;

use frameworks\scoreboard\api\Game;
use frameworks\scoreboard\api\Team;

class GameImpl implements Game
{
    /** @var Team */
    protected $homeTeam;

    /** @var int */
    protected $homeTeamScore;

    /** @var Team */
    protected $guestTeam;

    /** @var int */
    protected $guestTeamScore;

    /** @var \DateTime */
    protected $dateCreated;

    public function __construct(Team $homeTeam, Team $guestTeam) {
        $this->homeTeam = $homeTeam;
        $this->guestTeam = $guestTeam;

        $this->homeTeamScore = 0;
        $this->guestTeamScore = 0;

        $this->dateCreated = new \DateTime();
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

    function getTotalScore(): int {
        return $this->homeTeamScore + $this->getGuestTeamScore();
    }

    public function setScore(int $homeTeamScore, int $guestTeamScore) : void {
        $this->homeTeamScore = $homeTeamScore;
        $this->guestTeamScore = $guestTeamScore;
    }

    public function getId() : string {
        return self::buildId($this->homeTeam->getName(),$this->guestTeam->getName());
    }

    public static function buildId(string $homeTeamName, string $guestTeamName) : string {
        return $homeTeamName . "_" . $guestTeamName;
    }

    public function getCreationDateTime() : \DateTime {
        return $this->dateCreated;
    }

}