<?php
/**
 * Create routes using $app programming style.
 */


 /**
 * Render form for user specified startvalues
 */
 $app->router->get("dicegame/setup", function () use ($app) {
     if (isset($_SESSION['dicegame'])) {
         unset($_SESSION['dicegame']);
     }
     $app->page->add("dicegame/setup");
     $app->page->add("dicegame/debug");
     return $app->page->render();
 });


/**
* Init the dice game and redirect to play view
*/
$app->router->post("dicegame/init", function () use ($app) {

    if ($_POST['playername'] && $_POST['noofdice']) {
        $players = [$_POST['playername'], 'Computer'];
        $_SESSION['dicegame'] = new Chsv\Dice\DiceGame($players, $_POST['noofdice']);

        return $app->response->redirect("dicegame/start");

    } else {
        return $app->response->redirect("dicegame/setup");
    }
});


/**
* Game started
*/
$app->router->get("dicegame/start", function () use ($app) {
    $data = [
     'title' => "100 Dice",
     'playerTurn' => $_SESSION["dicegame"]->getPlayerTurn(),
     'standings' => $_SESSION['dicegame']->getCurrentStandings(),
     'results' => null
    ];

    $app->page->add("dicegame/play", $data);
    $app->page->add("dicegame/debug", $data);

    return $app->page->render();
});

/**
* Handle dice roll
*/
$app->router->post("dicegame/roll", function () use ($app) {

    // Check turn

    $dicehand = new Chsv\Dice\DiceHand();
    // check
    $results = $dicehand->graphic(); // Get from "last hand"

    $data = [
     'title' => "100 Dice",
     'playerTurn' => $_SESSION["dicegame"]->getPlayerTurn(),
     'standings' => $_SESSION['dicegame']->getCurrentStandings(),
     'results' => $results
    ];

    $app->page->add("dicegame/play", $data);
    $app->page->add("dicegame/debug", $data);

    return $app->page->render();

});

/**
* Handle stand
*/
$app->router->post("dicegame/stand", function () use ($app) {

    // Collect points

});
