<?php

namespace Anax\View;

if (!$resultset) {
    return;
}

require "navbar.php";

?>

<div class="message">
    Är du säker på att du vill radera följande film?
    <form class="movie-form" method="post" action="../deletemovie">
        <input id="id" type="hidden" name="id" value="<?= $resultset->id ?>" required hidden><br/>
        <input type="submit" name="admovie" value="Yes, remove">
    </form>
</div>

<table class="movie-table">
    <tr class="first">
        <th>Id</th>
        <th>Bild</th>
        <th>Titel</th>
        <th>År</th>
        <th>Hantera</th>
    </tr>
    <tr>
        <td><?= $resultset->id ?></td>
        <td><img class="thumb" src="<?= url($resultset->image) ?>"></td>
        <td><a href="<?= url("displaysinglemovie/".$resultset->id) ?>"><?= $resultset->title ?></a></td>
        <td><?= $resultset->year ?></td>
        <td>
            <a href="<?= url("moviedb/editmovie/".$resultset->id) ?>"><i class="fas fa-edit"></i></a>
            <a href="<?= url("moviedb/deletemovie/".$resultset->id) ?>"><i class="fas fa-trash-alt"></i></a>
        </td>
    </tr>
</table>
