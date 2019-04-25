<?php

namespace Chsv\Dice;

 /**
 * Render form for user specified startvalues such player name, number of dices
 * in game and number of computerized opponents.
 */
 $app->router->get("dicegame/setup", function () use ($app) {
     if (isset($_SESSION['dicegame'])) {
         unset($_SESSION['dicegame']);
     }
     session_destroy();
     $app->page->add("dicegame/setup");
     return $app->page->render();
 });


/**
* Init the dice game using posted user specs. Initiates instance of game object
* and redirects to route for handling player turns.
*/
$app->router->post("dicegame/init", function () use ($app) {

    if ($_POST['playername'] && $_POST['noofdice'] && $_POST['noofcomp']) {

        // Typecast and save postvariables
        $playerName = $_POST['playername'];
        $noOfDice = (int)$_POST['noofdice'];
        $noOfOpponents = (int)$_POST['noofcomp'];

        // Create new instance of game object and store in session.
        $_SESSION['dicegame'] = new DiceGame($playerName, $noOfDice, $noOfOpponents);

        return $app->response->redirect("dicegame/handleturn");

    } else {
        return $app->response->redirect("dicegame/setup");
    }
});


/**
* Handle player turn. Sets next player's turn each time route is called.
*/
$app->router->get("dicegame/handleturn", function () use ($app) {

    $_SESSION['dicegame']->nextGameTurn();
    $currentPlayer = $_SESSION['dicegame']->getCurrentPlayerNo();

    if ($currentPlayer === 0) {
        return $app->response->redirect("dicegame/playersturn");
    } else {
        return $app->response->redirect("dicegame/computersturn");
    }
});



/**
* Computers turn.
*/
$app->router->get("dicegame/computersturn", function () use ($app) {
    $results = $_SESSION['dicegame']->computerPlays();
    $turnScore = $_SESSION['dicegame']->getLastScore();
    $data = getBaseData();
    $data['results'] = $results;
    $data['turnscore'] = $turnScore;
    $app->page->add("dicegame/computerplay", $data);
    return $app->page->render();
});


/**
* players turn. Render view
*/
$app->router->get("dicegame/playersturn", function () use ($app) {
        $data = getBaseData();
        $app->page->add("dicegame/playerplay", $data);
        $app->page->add("dicegame/debug", $data);
        return $app->page->render();
});


/**
* Handle dice roll. Player chose to roll die
*/
$app->router->post("dicegame/roll", function () use ($app) {
    $rollOne = $_SESSION['dicegame']->playerPlays();
    $data = getBaseData();
    $data['results'] = $_SESSION['dicegame']->getLastHand();
    $data['turnscore'] = $_SESSION['dicegame']->getLastScore();

    if ($rollOne === true) {
        $app->page->add("dicegame/playerfail", $data);
        $app->page->add("dicegame/debug", $data);
    } else {
        $app->page->add("dicegame/playerplay", $data);
        $app->page->add("dicegame/debug", $data);
    }

    return $app->page->render();
});


/**
* Handle player stands = collecting points
*/
$app->router->get("dicegame/stand", function () use ($app) {
    $_SESSION['dicegame']->addPlayerScore();
    return $app->response->redirect("dicegame/handleturn");
});


/**
* Function for setting up basic data for view rendering
*/
function getBaseData() {
    $turn = $_SESSION["dicegame"]->getCurrentPlayerNo();
    $currentPlayerName = $_SESSION["dicegame"]->getCurrentPlayerName();
    $standings = $_SESSION["dicegame"]->getCurrentStandings();

    $data = [
     'title' => "100 Dice",
     'playerTurn' => $currentPlayerName,
     'standings' => $standings
    ];

    return $data;
}
