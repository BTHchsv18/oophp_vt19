<?php

namespace Anax\View;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());


?>
<h1>Dice 100</h1>
<p><?= $playerTurn ?>'s turn </p>

<?php if($results) { ?>
<p>
<?php foreach ($results as $value) : ?>
    <i class="dice-sprite <?= $value ?>"></i>
<?php endforeach; ?>
</p>
<?php } ?>

<p>
<form method="post" action="roll">
    <input type="submit" name="gameaction" value="Roll">
</form>
</p>
<p>
<form method="post" action="stand">
    <input type="submit" name="gameaction" value="Stand">
</form>
</p>
<p>
<form method="get" action="setup">
    <input type="submit" name="gameaction" value="Restart">
</form>
</p>

<p><b>Standings</b></p>
<?php foreach ($standings as $row) : ?>
    <p><?= $row ?></p>
<?php endforeach; ?>
