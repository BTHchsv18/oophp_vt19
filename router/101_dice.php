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

        $playerName = $_POST['playername'];
        $noOfDice = (int)$_POST['noofdice'];
        $noOfOpponents = (int)$_POST['noofcomp'];

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
    $_SESSION['dicegame']->nextPlayer();
    $currentPlayer = $_SESSION['dicegame']->getCurrentPlayerNo();
    if ($currentPlayer > 0) {
        return $app->response->redirect("dicegame/computersturn");
    } else {
        return $app->response->redirect("dicegame/playersturn");
    }
});



/**
* Computers turn. Called when it's any of computerized players turn
*/
$app->router->get("dicegame/computersturn", function () use ($app) {
    $won = $_SESSION['dicegame']->computerPlays();
    $data = $_SESSION['dicegame']->gameData();
    if ($won === true) {
        $app->page->add("dicegame/endgame", $data);
    } else {
        $app->page->add("dicegame/showresult", $data);
    }
    return $app->page->render();
});



/**
* Players turn. Rolls dice and renders view to show gme buttons.
*/
$app->router->get("dicegame/playersturn", function () use ($app) {
    $data = $_SESSION['dicegame']->gameData();
    $app->page->add("dicegame/playerplay", $data);
    return $app->page->render();
});



/**
* Handle dice roll. Player chose to roll die
*/
$app->router->get("dicegame/roll", function () use ($app) {

    $rolledOne = $_SESSION['dicegame']->playerPlays();

    if ($rolledOne === true) {
        $data = $_SESSION['dicegame']->gameData();
        $app->page->add("dicegame/showresult", $data);
    } else {
        $data = $_SESSION['dicegame']->gameData();
        $app->page->add("dicegame/playerplay", $data);
    }
    return $app->page->render();
});


/**
* Handle player stands = collecting points
*/
$app->router->get("dicegame/stand", function () use ($app) {
    $won = $_SESSION['dicegame']->updateStandings();
    $data = $_SESSION['dicegame']->gameData();
    if ($won === true) {
        $app->page->add("dicegame/endgame", $data);
    } else {
        $app->page->add("dicegame/showresult", $data);
    }
    return $app->page->render();
});


/**
* Function for setting up basic data for view rendering
*/
function getGameData() {
    $data = $_SESSION['dicegame']->gameData();
    return $data;
    // $turn = $_SESSION["dicegame"]->getCurrentPlayerNo();
    // if ($turn === 0) {
    //     $currentPlayerName = "du";
    // } else {
    //     $currentPlayerName = $_SESSION["dicegame"]->getCurrentPlayerName();
    // }
    // $resultsFromLastTurn = $_SESSION["dicegame"]->getResultsFomLastTurn();
    // $scoreFromLastTurn = $_SESSION["dicegame"]->getScoreFromLastTurn();
    // $standings = $_SESSION["dicegame"]->getCurrentStandings();
    //
    // $data = [
    //  'title' => "100 Dice",
    //  'turn' => $turn,
    //  'lastPlayer' => $currentPlayerName,
    //  'lastTurnResults' => $resultsFromLastTurn,
    //  'lastTurnScore' => $scoreFromLastTurn,
    //  'standings' => $standings
    // ];
    //
    // return $data;
}
