<?php

namespace Anax\View;

?>

<div class="movie-navbar">
    <navbar class="navbar">
        <a href="<?= url("moviedb/displaymovies") ?>">Show all movies</a> |
        <a href="<?= url("moviedb/searchtitle") ?>">Search title</a> |
        <a href="<?= url("moviedb/searchyear") ?>">Search year</a> |
        <a href="<?= url("moviedb/addmovie") ?>">Add movie</a> |
        <a href="<?= url("moviedb/resetdb") ?>">Reset database</a>
    </navbar>
</div>
