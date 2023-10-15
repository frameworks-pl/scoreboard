# ScoreBoard
Library that allows adding, updating and removing games from a score board.
Games on the board can be collected in sorted order, with those having biggest scores coming first.

**Requires PHP 7.2 or later**

## Installation
Add following to your composer.json and run `composer install`:


<pre>
{
    "require": {
        "php": ">=7.2",
	    "frameworks/scoreboard": "dev-master"
    },
    "repositories": [
        {
          "type": "vcs",
          "url": "https://github.com/frameworks-pl/scoreboard.git"
        }    
        	
    ]
}
</pre>

## Usage

### Creating board
<pre>
use frameworks\scoreboard\impl\ScoreBoardImpl;
$scoreBoard = new ScoreBoardImpl();
</pre>

### Creating a team
<pre>
use frameworks\scoreboard\impl\TeamImpl;
$polandTeam = new TeamImpl("Poland");
$germanyTeam = new TeamImpl("Germany");
</pre>

### Starting a game
<pre>
$scoreBoard->startGame($polandTeam, $germanyTeam);
</pre>

### Updating a game
<pre>
use frameworks\scoreboard\DTO\GameScore;
$scoreBoard->updateScore(new GameScore("Poland", 1, "Germany", 0));
</pre>

### Getting list of scores
<pre>
$scores = $scoreBoard->getScores();
foreach ($scores as $score) {
    echo $score->getHomeTeam()->getName() . ": " . $score->getHomeTeamScore() . " --- " . $score->getGuestTeam()->getName() . ": " . $score->getGuestTeamScore() . "\n";
}
</pre>

### Finishing a game
<pre>
$scoreBoard->startGame($polandTeam, $germanyTeam);
</pre>


