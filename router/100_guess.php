<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the guess game and redirect to play the game
 */
$app->router->get("guess/init", function () use ($app) {
    $_SESSION["guess"] = new Chsv\Guess\Guess();
    return $app->response->redirect("guess/play");
});



/**
 * Show game status
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    $data = [
        "triesleft" => $triesleft ?? 5,
        "cheat" => $cheat ?? null,
        "number" => $number ?? null,
        "userguessvalue" => $userguessvalue ?? null,
        "result" => $result ?? null
    ];

    $app->page->add("guess/play", $data);

    return $app->page->render([
        "title" => $title,
    ]);
});


/**
 * Handle guess
 */
 $app->router->post("guess/play", function () use ($app) {
     $title = "Play the game";

     // initiate incoming POST-variables
     $userguessvalue = $_POST["userguessvalue"] ?? null;
     $makeguess = $_POST["makeguess"] ?? null;
     $restart = $_POST["restart"] ?? null;
     $cheat = $_POST["cheat"] ?? null;

     $number = null;

    // Check what button has been clicked
    if ($restart) {
        return $app->response->redirect("guess/init");
    } elseif ($makeguess != null && is_numeric($userguessvalue)) {
        $result = $_SESSION["guess"]->checkguess($userguessvalue);
    } else if ($cheat) {
        $number = $_SESSION["guess"]->getnumber();
    }

     // Get number of tries left
     $triesleft = $_SESSION["guess"]->gettriesleft();

     $data = [
         "triesleft" => $triesleft,
         "cheat" => $cheat,
         "number" => $number,
         "userguessvalue" => $userguessvalue,
         "result" => $result ?? ""
     ];

     $app->page->add("guess/play", $data);

     return $app->page->render([
         "title" => $title,
     ]);
 });
