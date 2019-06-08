<?php

namespace Anax\View;

require "navbar.php";

?>

<div class="message">
</div>

<?php if ($type === "searchyear") { ?>
    <form class="movie-form" method="post" action="searchyear">
        <fieldset>
          <legend>Search</legend>
          <label for="movieyear">Year</label><br/>
          <input id="movieyear" type="text" name="movieyear" value="" required><br/>
<?php } else { ?>
    <form class="movie-form" method="post" action="searchtitle">
        <fieldset>
          <legend>Search</legend>
          <label for="movietitle">Title</label><br/>
          <input id="movietitle" type="text" name="movietitle" value="" required><br/>
<?php } ?>
    <input type="submit" name="search" value="Search">
    </fieldset>
    </form>
