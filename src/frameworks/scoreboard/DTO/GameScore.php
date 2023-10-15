<?php
namespace frameworks\scoreboard\DTO;

class GameScore {

    protected $homeTeamName;

    protected $homeTeamScore;

    protected $guestTeamName;

    protected $guestTeamScore;

    public function __construct(string $homeTeamName, int $homeTeamScore, string $guestTeamName, int $guestTeamScore)
    {
        if ($homeTeamScore < 0 || $guestTeamScore < 0) {
            throw new \InvalidArgumentException("Score value must be greater or equal zero");
        }
        $this->homeTeamName = $homeTeamName;
        $this->homeTeamScore = $homeTeamScore;
        $this->guestTeamName = $guestTeamName;
        $this->guestTeamScore = $guestTeamScore;
    }

    public function getHomeTeamName() {
        return $this->homeTeamName;
    }

    public function getHomeTeamScore() {
        return $this->homeTeamScore;
    }

    public function getGuestTeamName() {
        return $this->guestTeamName;
    }

    public function getGuestTeamScore() {
        return $this->guestTeamScore;
    }

    public function equalsTo(GameScore $gameScore) {
        return ($this->homeTeamName === $gameScore->getHomeTeamName()
            && $this->homeTeamScore === $gameScore->getHomeTeamScore()
            && $this->guestTeamName === $gameScore->getGuestTeamName()
            && $this->guestTeamName === $gameScore->getGuestTeamName()
        );
    }
}
