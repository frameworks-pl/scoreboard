<?php
namespace frameworks\scoreboard\impl;

use frameworks\scoreboard\api\Team;
use http\Exception\InvalidArgumentException;

class TeamImpl implements Team {

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