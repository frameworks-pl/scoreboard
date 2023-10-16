<?php
namespace frameworks\scoreboard\DTO;

class GameScore {

    /** @var string */
    protected $homeTeamName;

    /** @var int */
    protected $homeTeamScore;

    /** @var string */
    protected $guestTeamName;

    /** @var int */
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

    public function getHomeTeamName() : string {
        return $this->homeTeamName;
    }

    public function getHomeTeamScore() : int {
        return $this->homeTeamScore;
    }

    public function getGuestTeamName() : string {
        return $this->guestTeamName;
    }

    public function getGuestTeamScore() : int {
        return $this->guestTeamScore;
    }

    public function equalsTo(GameScore $gameScore) : bool {
        return ($this->homeTeamName === $gameScore->getHomeTeamName()
            && $this->homeTeamScore === $gameScore->getHomeTeamScore()
            && $this->guestTeamName === $gameScore->getGuestTeamName()
            && $this->guestTeamName === $gameScore->getGuestTeamName()
        );
    }
}
