<?php
namespace frameworks\scoreboard\api;

interface Team {

    /**
     * Returns name of the team
     *
     * @return string
     */
    public function getName() : string;
}
