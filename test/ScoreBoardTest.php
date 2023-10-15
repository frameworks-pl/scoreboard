<?php

use frameworks\scoreboard\DTO\GameScore;
use frameworks\scoreboard\impl\GameImpl;
use frameworks\scoreboard\impl\ScoreBoardImpl;
use frameworks\scoreboard\impl\TeamImpl;
use PHPUnit\Framework\TestCase;


class ScoreBoardTest extends TestCase {

    public function testGameId() {
        $homeTeam = new TeamImpl("Poland");
        $guestTeam = new TeamImpl("Germany");
        $game = new GameImpl($homeTeam, $guestTeam);
        $this->assertEquals("Poland_Germany", $game->getId());
    }

    public function testBeginGame() {

        $scoreBoard = new ScoreBoardImpl();
        $homeTeam = new TeamImpl("Mexico");
        $guestTeam = new TeamImpl("Canada");
        $scoreBoard->startGame($homeTeam, $guestTeam);
        $this->assertTrue($scoreBoard->getScore($homeTeam, $guestTeam)->equalsTo(
            new GameScore("Mexico", 0, "Canada", 0)));
    }

    public function testFinishGame() {

        $scoreBoard = new ScoreBoardImpl();
        $scoreBoard->startGame(new TeamImpl("Poland"), new TeamImpl("Germany"));
        $scoreBoard->startGame(new TeamImpl("Canada"), new TeamImpl("Mexico"));
        $scoreBoard->startGame(new TeamImpl("Poland"), new TeamImpl("Australia"));

        $scoreBoard->finishGame(new TeamImpl("Canada"), new TeamImpl("Mexico"));

        $games = $scoreBoard->getScores();
        $this->assertEquals("Poland", $games[0]->getHomeTeam()->getName());
        $this->assertEquals("Australia", $games[0]->getGuestTeam()->getName());
        $this->assertEquals("Poland", $games[1]->getHomeTeam()->getName());
        $this->assertEquals("Germany", $games[1]->getGuestTeam()->getName());
    }

    public function testFinishGameNotStarted() {

        $this->expectException(InvalidArgumentException::class);
        $scoreBoard = new ScoreBoardImpl();
        $scoreBoard->startGame(new TeamImpl("Poland"), new TeamImpl("Germany"));
        $scoreBoard->startGame(new TeamImpl("Canada"), new TeamImpl("Mexico"));
        $scoreBoard->startGame(new TeamImpl("Poland"), new TeamImpl("Australia"));

        $scoreBoard->finishGame(new TeamImpl("USA"), new TeamImpl("Canada"));
    }

    public function testGameSameHomeAndGuestTeam() {

        $this->expectException(InvalidArgumentException::class);
        $scoreBoard = new ScoreBoardImpl();
        $homeTeam = new TeamImpl("Mexico");
        $guestTeam = new TeamImpl("Mexico");
        $scoreBoard->startGame($homeTeam, $guestTeam);
    }

    public function testTeamWithoutName() {

        $this->expectException(InvalidArgumentException::class);
        $team = new TeamImpl("");
    }

    public function testMultipleGames() {

        $scoreBoard = new ScoreBoardImpl();
        $scoreBoard->startGame(new TeamImpl("Poland"), new TeamImpl("Germany"));
        $scoreBoard->startGame(new TeamImpl("Canada"), new TeamImpl("Mexico"));
        $scoreBoard->startGame(new TeamImpl("Poland"), new TeamImpl("Australia"));
        $this->assertTrue($scoreBoard->getScore(new TeamImpl("Canada"), new TeamImpl("Mexico"))->equalsTo(
            new GameScore("Canada", 0, "Mexico", 0)));
    }

    public function testUpdateGame() {

        $scoreBoard = new ScoreBoardImpl();
        $scoreBoard->startGame(new TeamImpl("Poland"), new TeamImpl("Germany"));
        $scoreBoard->startGame(new TeamImpl("Canada"), new TeamImpl("Mexico"));
        $scoreBoard->startGame(new TeamImpl("Poland"), new TeamImpl("Australia"));
        $scoreBoard->updateScore(new GameScore("Canada", 2, "Mexico", 3));
        $this->assertTrue($scoreBoard->getScore(new TeamImpl("Canada"), new TeamImpl("Mexico"))->equalsTo(
            new GameScore("Canada", 2, "Mexico", 3)));
    }

    public function testUpdateNonExistingGame() {
        $this->expectException(InvalidArgumentException::class);
        $scoreBoard = new ScoreBoardImpl();
        $scoreBoard->updateScore(new GameScore("Canada", 2, "Mexico", 3));
    }

    public function testUpdateGameInvalidScoreHome() {
        $this->expectException(InvalidArgumentException::class);
        $gameScore = new GameScore("Poland", -1, "Germany", 0);
    }

    public function testGetScores() {
        $scoreBoard = new ScoreBoardImpl();
        $scoreBoard->startGame(new TeamImpl("Mexico"), new TeamImpl("Canada"));
        $scoreBoard->updateScore(new GameScore("Mexico", 0, "Canada", 5));

        $scoreBoard->startGame(new TeamImpl("Spain"), new TeamImpl("Brazil"));
        $scoreBoard->updateScore(new GameScore("Spain", 10, "Brazil", 2));

        $scoreBoard->startGame(new TeamImpl("Germany"), new TeamImpl("France"));
        $scoreBoard->updateScore(new GameScore("Germany", 2, "France", 2));

        $scoreBoard->startGame(new TeamImpl("Uruguay"), new TeamImpl("Italy"));
        $scoreBoard->updateScore(new GameScore("Uruguay", 6, "Italy", 6));

        $scoreBoard->startGame(new TeamImpl("Argentina"), new TeamImpl("Australia"));
        $scoreBoard->updateScore(new GameScore("Argentina", 3, "Australia", 1));

        $games = $scoreBoard->getScores();
        $this->assertEquals("Uruguay", $games[0]->getHomeTeam()->getName());
        $this->assertEquals("Italy", $games[0]->getGuestTeam()->getName());
        $this->assertEquals("Spain", $games[1]->getHomeTeam()->getName());
        $this->assertEquals("Brazil", $games[1]->getGuestTeam()->getName());
        $this->assertEquals("Mexico", $games[2]->getHomeTeam()->getName());
        $this->assertEquals("Canada", $games[2]->getGuestTeam()->getName());
        $this->assertEquals("Argentina", $games[3]->getHomeTeam()->getName());
        $this->assertEquals("Australia", $games[3]->getGuestTeam()->getName());
        $this->assertEquals("Germany", $games[4]->getHomeTeam()->getName());
        $this->assertEquals("France", $games[4]->getGuestTeam()->getName());
    }

    public function testGetScoresAllTheSame() {
        $scoreBoard = new ScoreBoardImpl();
        $scoreBoard->startGame(new TeamImpl("Mexico"), new TeamImpl("Canada"));
        $scoreBoard->startGame(new TeamImpl("Spain"), new TeamImpl("Brazil"));
        $scoreBoard->startGame(new TeamImpl("Germany"), new TeamImpl("France"));
        $scoreBoard->startGame(new TeamImpl("Uruguay"), new TeamImpl("Italy"));
        $scoreBoard->startGame(new TeamImpl("Argentina"), new TeamImpl("Australia"));

        $games = $scoreBoard->getScores();
        $this->assertEquals("Argentina", $games[0]->getHomeTeam()->getName());
        $this->assertEquals("Australia", $games[0]->getGuestTeam()->getName());
        $this->assertEquals("Uruguay", $games[1]->getHomeTeam()->getName());
        $this->assertEquals("Italy", $games[1]->getGuestTeam()->getName());
        $this->assertEquals("Germany", $games[2]->getHomeTeam()->getName());
        $this->assertEquals("France", $games[2]->getGuestTeam()->getName());
        $this->assertEquals("Spain", $games[3]->getHomeTeam()->getName());
        $this->assertEquals("Brazil", $games[3]->getGuestTeam()->getName());
        $this->assertEquals("Mexico", $games[4]->getHomeTeam()->getName());
        $this->assertEquals("Canada", $games[4]->getGuestTeam()->getName());
    }
}