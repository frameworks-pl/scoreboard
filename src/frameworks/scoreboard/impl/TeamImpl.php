<?php
namespace frameworks\scoreboard\impl;

use frameworks\scoreboard\api\Team;

class TeamImpl implements Team {

    /** @var string */
    protected $teamName;

    public function __construct(string $teamName) {
        if ($teamName === '') {
            throw new \InvalidArgumentException("Team must have non-empty name.");
        }
        $this->teamName = $teamName;
    }

    public function getName() : string {
        return $this->teamName;
    }
}