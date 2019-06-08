<?php

namespace Anax\View;

if (!$resultset) {
    return;
}

require "navbar.php";

?>

<form class="movie-form" method="post" action="../editmovie">
    <fieldset>
      <legend>Edit movie</legend>

      <img class="thumb" src="<?= url($resultset->image) ?>">

      <input id="id" type="hidden" name="id" value="<?= $resultset->id ?>" required hidden><br/>

      <label for="movietitle">Movie title:</label><br/>
      <input id="movietitle" type="text" name="movietitle" value="<?= $resultset->title ?>" required><br/>

      <label for="moviedirector">Director:</label><br/>
      <input id="moviedirector" type="text" name="moviedirector" value="<?= $resultset->director ?>"><br/>

      <label for="movielength">Length:</label><br/>
      <input id="movielength" type="number" name="movielength" value="<?= $resultset->length ?>" ><br/>

      <label for="movieyear">Year:</label><br/>
      <input id="movieyear" type="number" name="movieyear" value="<?= $resultset->year ?>" ><br/>

      <label for="movieplot">Plot:</label><br/>
      <input id="movieplot" type="text" name="movieplot" value="<?= $resultset->plot ?>" ><br/>

      <label for="movieimage">Image URL:</label><br/>
      <input id="movieimage" type="text" name="movieimage" value="<?= $resultset->image ?>" ><br/>

      <label for="moviesub">Subtext:</label><br/>
      <input id="moviesub" type="text" name="moviesub" value="<?= $resultset->subtext ?>" ><br/>

      <label for="moviespeech">Speech:</label><br/>
      <input id="moviespeech" type="text" name="moviespeech" value="<?= $resultset->speech ?>" ><br/>

      <label for="moviequality">Quality:</label><br/>
      <input id="moviequality" type="text" name="moviequality" value="<?= $resultset->quality ?>" ><br/>

      <label for="movieformat">Format:</label><br/>
      <input id="movieformat" type="text" name="movieformat" value="<?= $resultset->format ?>" ><br/>

      <input type="submit" name="uypdatemovie" value="Update movie">
    </fieldset>
</form>
