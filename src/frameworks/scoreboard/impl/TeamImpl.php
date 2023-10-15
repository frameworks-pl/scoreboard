<?php
namespace frameworks\scoreboard\impl;

use frameworks\scoreboard\api\Team;

class TeamImpl implements Team {

    protected $teamName;

    public function __construct(string $teamName) {
        $this->teamName = $teamName;
    }

    public function getName() : string {
        return $this->teamName;
    }
}