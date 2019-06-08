<?php

namespace Anax\View;

require "navbar.php";

?>

<form class="movie-form" method="post" action="addmovie">
    <fieldset>
      <legend>Add movie</legend>

      <label for="movietitle">Movie title:</label><br/>
      <input id="movietitle" type="text" name="movietitle" value="" required><br/>

      <label for="moviedirector">Director:</label><br/>
      <input id="moviedirector" type="text" name="moviedirector" value=""><br/>

      <label for="movielength">Length:</label><br/>
      <input id="movielength" type="number" name="movielength" value="" ><br/>

      <label for="movieyear">Year:</label><br/>
      <input id="movieyear" type="number" name="movieyear" value="" ><br/>

      <label for="movieplot">Plot:</label><br/>
      <input id="movieplot" type="text" name="movieplot" value="" ><br/>

      <label for="movieimage">Image URL:</label><br/>
      <input id="movieimage" type="text" name="movieimage" value="" ><br/>

      <label for="moviesub">Subtext:</label><br/>
      <input id="moviesub" type="text" name="moviesub" value="" ><br/>

      <label for="moviespeech">Speech:</label><br/>
      <input id="moviespeech" type="text" name="moviespeech" value="" ><br/>

      <label for="moviequality">Quality:</label><br/>
      <input id="moviequality" type="text" name="moviequality" value="" ><br/>

      <label for="movieformat">Format:</label><br/>
      <input id="movieformat" type="text" name="movieformat" value="" ><br/>

      <input type="submit" name="admovie" value="Add movie">
    </fieldset>
</form>
