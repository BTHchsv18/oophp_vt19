<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>
<h1>Dice 100. Start a new game!</h1>
<p>Select game preferences: </p>

<form method="post" action="init">
    <p>
        <label for="playername">Ditt namn: </label>
        <br>
        <input type="text" name="playername"></input>
    </p>
    <p>
        <label for="playername">Antal tärningar att spela med: </label>
        <br>
        <input type="number" name="noofdice" min="1" max="5"></input>
    </p>
    <p>
        <input type="submit" name="gameaction" value="Starta"></input>
    </p>
</form>
