<?php

// Include config and autoloader
include(__DIR__ . "/config.php");
include(__DIR__ . "/autoload.php");

// initiate incoming POST-variables
$userguessvalue = $_POST["userguessvalue"] ?? null;
$makeguess = $_POST["makeguess"] ?? null;
$restart = $_POST["restart"] ?? null;
$cheat = $_POST["cheat"] ?? null;

// Start session
session_name("guessnumber");
session_start();

// If instance of object is not stored in session, create instance and store
if (!isset($_SESSION['guess'])) {
    $_SESSION["guess"] = new Guess();
}

// Check what button has been clicked
if ($restart) {
    Header("Location: session_destroy.php");
} elseif ($makeguess != null && is_numeric($userguessvalue)) {
    $result = $_SESSION["guess"]->checkguess($userguessvalue);
} else if ($cheat) {
    $number = $_SESSION["guess"]->getnumber();
}

// Get number of tries left
$triesleft = $_SESSION["guess"]->gettriesleft();

// Render page
require __DIR__ . "/view/guess_my_number.php";

// Debug
require __DIR__ . "/view/debug_session_post_get.php";
